<?php
declare(strict_types=1);

namespace App\Controllers\Site;

use App\Core\Controller;
use App\Core\Database;
use App\Core\View;
use App\Core\Cache;

/**
 * Renders the public website from CMS data using the approved markup.
 * - Table-driven templates for content-rich pages (home, programs,
 *   leadership, about, contact + notices/downloads/gallery/reviews).
 * - All other pages render their editable body_html from the pages table.
 */
final class PageController extends Controller
{
    /** Slugs that use a dedicated dynamic template (site/pages/<slug>.php). */
    private const DYNAMIC = [
        'index', 'about', 'programs', 'president-desk', 'principal-desk',
        'contact', 'notices', 'downloads', 'gallery', 'reviews',
        'admissions', 'engage', 'careers', 'support-us', 'curriculum', 'academic-calendar',
    ];

    public function show(string $slug): void
    {
        $db = Database::instance();
        $page = $db->first(
            'SELECT * FROM ' . DB_PREFIX . 'pages WHERE slug = ? AND is_published = 1 AND deleted_at IS NULL',
            [$slug]
        );

        if (!$page) {
            http_response_code($slug === '404' ? 200 : 404);
            $page = $db->first('SELECT * FROM ' . DB_PREFIX . 'pages WHERE slug = "404"');
            if (!$page) { echo 'Page not found.'; return; }
            $slug = '404';
        }

        $data = ['page' => $page, 'slug' => $slug];

        if (in_array($slug, self::DYNAMIC, true)) {
            $data += $this->dynamicData($slug);
            $body = View::render('site/pages/' . $slug, $data);
        } else {
            $body = $this->banner($page) . ($page['body_html'] ?? '');
        }

        $data['bodyContent'] = $body;
        View::output('site/layout', $data);
    }

    private function banner(array $page): string
    {
        if (empty($page['banner_title'])) return '';
        return View::render('site/partials/banner', [
            'title' => $page['banner_title'],
            'image' => $page['banner_image'] ?: '',
            'pageTitle' => $page['title'],
        ]);
    }

    private function dynamicData(string $slug): array
    {
        $db = Database::instance();
        $p = DB_PREFIX;

        switch ($slug) {
            case 'index':
                return Cache::remember('home_data', 300, static function () use ($db, $p) {
                    return [
                        'slides'      => $db->all("SELECT * FROM {$p}sliders WHERE is_active=1 ORDER BY sort_order ASC"),
                        'statistics'  => $db->all("SELECT * FROM {$p}statistics WHERE is_active=1 ORDER BY sort_order ASC"),
                        'programs'    => $db->all("SELECT * FROM {$p}programs WHERE is_active=1 AND deleted_at IS NULL ORDER BY sort_order ASC LIMIT 4"),
                        'testimonials'=> $db->all("SELECT * FROM {$p}testimonials WHERE is_active=1 AND deleted_at IS NULL ORDER BY sort_order ASC"),
                        'teachers'    => $db->all("SELECT * FROM {$p}staff WHERE is_active=1 AND deleted_at IS NULL AND category='Teacher' ORDER BY sort_order ASC LIMIT 4"),
                        'notices'     => $db->all("SELECT * FROM {$p}notices WHERE deleted_at IS NULL ORDER BY is_pinned DESC, publish_date DESC LIMIT 3"),
                        'gallery'     => $db->all("SELECT * FROM {$p}gallery_images WHERE deleted_at IS NULL ORDER BY is_featured DESC, sort_order ASC LIMIT 4"),
                        'cta'         => $db->first("SELECT * FROM {$p}cta_blocks WHERE identifier='home_cta' AND is_active=1"),
                    ];
                });

            case 'about':
                return [
                    'statistics' => $db->all("SELECT * FROM {$p}statistics WHERE is_active=1 ORDER BY sort_order ASC LIMIT 4"),
                    'board'      => $db->all("SELECT * FROM {$p}staff WHERE is_active=1 AND deleted_at IS NULL AND category='Leadership' ORDER BY sort_order ASC"),
                ];

            case 'programs':
                return ['programs' => $db->all("SELECT * FROM {$p}programs WHERE is_active=1 AND deleted_at IS NULL ORDER BY sort_order ASC")];

            case 'president-desk':
                return ['leader' => $this->leader('President')];
            case 'principal-desk':
                return ['leader' => $this->leader('Principal')];

            case 'notices':
                return ['notices' => $db->all("SELECT * FROM {$p}notices WHERE deleted_at IS NULL AND (expiry_date IS NULL OR expiry_date >= CURDATE()) ORDER BY is_pinned DESC, publish_date DESC")];
            case 'downloads':
                return ['downloads' => $db->all("SELECT * FROM {$p}downloads WHERE deleted_at IS NULL ORDER BY is_featured DESC, sort_order ASC, id DESC")];
            case 'gallery':
                return ['images' => $db->all("SELECT * FROM {$p}gallery_images WHERE deleted_at IS NULL ORDER BY sort_order ASC, id DESC")];
            case 'reviews':
                return ['reviews' => $db->all("SELECT * FROM {$p}reviews WHERE deleted_at IS NULL AND is_approved=1 ORDER BY created_at DESC")];
            case 'careers':
                return ['positions' => $db->all("SELECT * FROM {$p}job_openings WHERE is_active=1 AND deleted_at IS NULL ORDER BY sort_order ASC, id ASC")];
            case 'curriculum':
                return ['documents' => $db->all("SELECT * FROM {$p}documents WHERE is_published=1 AND deleted_at IS NULL ORDER BY category ASC, is_featured DESC, sort_order ASC, id ASC")];
            case 'academic-calendar':
                return ['calendarPages' => $db->all("SELECT * FROM {$p}calendar_pages WHERE is_published=1 AND is_active=1 AND deleted_at IS NULL ORDER BY sort_order ASC, id ASC")];
        }
        return [];
    }

    private function leader(string $roleLike): ?array
    {
        $db = Database::instance();
        $p = DB_PREFIX;
        return $db->first(
            "SELECT * FROM {$p}staff WHERE deleted_at IS NULL AND is_active=1 AND (role LIKE ? OR name LIKE ?) ORDER BY sort_order ASC LIMIT 1",
            ["%{$roleLike}%", "%{$roleLike}%"]
        );
    }

    /** /download?id=N — increments the counter and streams/redirects to the file. */
    public function download(int $id): void
    {
        $db = Database::instance();
        $row = $db->first('SELECT * FROM ' . DB_PREFIX . 'downloads WHERE id = ? AND deleted_at IS NULL', [$id]);
        if (!$row || !$row['file']) {
            http_response_code(404);
            echo 'File not found.';
            return;
        }
        $db->run('UPDATE ' . DB_PREFIX . 'downloads SET download_count = download_count + 1 WHERE id = ?', [$id]);
        Cache::flush();
        redirect(upload_url($row['file']));
    }

    /** Store a public form submission (AJAX endpoint /submit). */
    public function submit(): void
    {
        $type = preg_replace('/[^a-z0-9_\-]/', '', (string) ($_POST['form_type'] ?? 'contact')) ?: 'contact';
        $name = trim((string) ($_POST['name'] ?? ''));
        $email = trim((string) ($_POST['email'] ?? ''));
        $phone = trim((string) ($_POST['phone'] ?? ''));
        $subject = trim((string) ($_POST['subject'] ?? ''));

        if (!empty($_POST['website'])) { $this->json(['ok' => true]); } // honeypot

        if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->json(['ok' => false, 'message' => 'Please enter a valid email address.'], 422);
        }

        // Public review submissions go into the reviews table (pending approval).
        if ($type === 'review') {
            Database::instance()->run(
                'INSERT INTO ' . DB_PREFIX . 'reviews (name, designation, rating, review, is_approved, created_at)
                 VALUES (?, ?, ?, ?, 0, NOW())',
                [$name ?: 'Anonymous', trim((string) ($_POST['designation'] ?? '')), (int) ($_POST['rating'] ?? 5), trim((string) ($_POST['message'] ?? $_POST['review'] ?? ''))]
            );
            $this->json(['ok' => true, 'message' => 'Thank you! Your review is awaiting approval.']);
        }

        $payload = [];
        foreach ($_POST as $k => $v) {
            if (in_array($k, ['_csrf', 'website'], true)) continue;
            $payload[$k] = is_array($v) ? implode(', ', $v) : $v;
        }

        Database::instance()->run(
            'INSERT INTO ' . DB_PREFIX . 'form_submissions (form_type, name, email, phone, subject, payload, ip_address, created_at)
             VALUES (?, ?, ?, ?, ?, ?, ?, NOW())',
            [$type, $name, $email, $phone, $subject, json_encode($payload), $_SERVER['REMOTE_ADDR'] ?? '']
        );

        // Notify the admin by email (safe no-op if no mail transport is configured).
        $this->notifyAdmin($type, $name, $email, $phone, $subject, $payload);

        $this->json(['ok' => true, 'message' => 'Thank you! Your message has been received.']);
    }

    /**
     * Email the configured admin address about a new form submission.
     * Wrapped so a mail failure never blocks the submission response.
     */
    private function notifyAdmin(string $type, string $name, string $email, string $phone, string $subject, array $payload): void
    {
        try {
            $to = \App\Models\Setting::get('contact_email', '');
            if (!$to || !filter_var($to, FILTER_VALIDATE_EMAIL)) {
                return;
            }
            $siteName = \App\Models\Setting::get('site_name', "Channawar's e Vidya Mandir");
            $formName = ucwords(str_replace(['_', '-'], ' ', $type)) . ' Form';
            $host     = $_SERVER['HTTP_HOST'] ?? 'localhost';
            $message  = (string) ($payload['message'] ?? $payload['msg'] ?? '');
            $lines = [
                'A new form submission was received on the ' . $siteName . ' website.',
                '',
                'Form:            ' . $formName,
                'Date & Time:     ' . date('d M Y, h:i A'),
                'Name:            ' . ($name !== '' ? $name : '—'),
                'Email:           ' . ($email !== '' ? $email : '—'),
                'Phone:           ' . ($phone !== '' ? $phone : '—'),
                'Subject:         ' . ($subject !== '' ? $subject : '—'),
                'Message:         ' . ($message !== '' ? $message : '—'),
                'Submitted Page:  ' . ($_SERVER['HTTP_REFERER'] ?? '—'),
                'IP Address:      ' . ($_SERVER['REMOTE_ADDR'] ?? '—'),
            ];
            $subjectLine = '[' . $siteName . '] New ' . $formName . ' submission';
            $headers  = 'From: ' . $siteName . ' <no-reply@' . $host . ">\r\n";
            $headers .= 'Content-Type: text/plain; charset=UTF-8' . "\r\n";
            if ($email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $headers .= 'Reply-To: ' . $email . "\r\n";
            }
            @mail($to, $subjectLine, implode("\n", $lines), $headers);
        } catch (\Throwable $e) {
            // Intentionally ignored — email is best-effort.
        }
    }
}
