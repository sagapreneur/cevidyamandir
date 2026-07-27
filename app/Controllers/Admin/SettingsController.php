<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Flash;
use App\Core\Upload;
use App\Core\Cache;
use App\Models\Setting;
use App\Core\ActivityLog;

/**
 * Website settings — grouped key/value editor.
 * Groups: general, contact, social, seo, appearance, analytics.
 */
final class SettingsController extends Controller
{
    /** Field definitions grouped for the settings form. */
    private function schema(): array
    {
        return [
            'general' => [
                'site_name' => ['label' => 'School Name', 'type' => 'text'],
                'tagline' => ['label' => 'Tagline', 'type' => 'text'],
                'footer_blurb' => ['label' => 'Footer Description', 'type' => 'textarea'],
                'newsletter_blurb' => ['label' => 'Newsletter Blurb', 'type' => 'textarea'],
                'copyright_year' => ['label' => 'Copyright Year', 'type' => 'text'],
                'logo' => ['label' => 'Logo', 'type' => 'image'],
                'favicon' => ['label' => 'Favicon', 'type' => 'image'],
            ],
            'contact' => [
                'contact_email' => ['label' => 'Email', 'type' => 'email'],
                'contact_phone' => ['label' => 'Primary Phone (display)', 'type' => 'text'],
                'contact_phone_href' => ['label' => 'Primary Phone (dial)', 'type' => 'text'],
                'contact_phone_secondary' => ['label' => 'Secondary Phone', 'type' => 'text'],
                'contact_whatsapp' => ['label' => 'WhatsApp Number', 'type' => 'text'],
                'contact_address' => ['label' => 'Address', 'type' => 'textarea'],
                'contact_hours' => ['label' => 'Office Hours', 'type' => 'text'],
                'google_map' => ['label' => 'Google Map Embed URL', 'type' => 'text'],
                'announcement_lead' => ['label' => 'Announcement Text', 'type' => 'text'],
                'announcement_strong' => ['label' => 'Announcement Highlight', 'type' => 'text'],
            ],
            'social' => [
                'social_facebook' => ['label' => 'Facebook URL', 'type' => 'text'],
                'social_twitter' => ['label' => 'Twitter/X URL', 'type' => 'text'],
                'social_linkedin' => ['label' => 'LinkedIn URL', 'type' => 'text'],
                'social_youtube' => ['label' => 'YouTube URL', 'type' => 'text'],
                'social_instagram' => ['label' => 'Instagram URL', 'type' => 'text'],
            ],
            'seo' => [
                'seo_title' => ['label' => 'Default Meta Title', 'type' => 'text'],
                'seo_description' => ['label' => 'Default Meta Description', 'type' => 'textarea'],
                'seo_keywords' => ['label' => 'Default Keywords', 'type' => 'text'],
                'seo_og_image' => ['label' => 'Default OG Image', 'type' => 'image'],
                'twitter_handle' => ['label' => 'Twitter Handle', 'type' => 'text'],
            ],
            'appearance' => [
                'primary_color' => ['label' => 'Primary Color', 'type' => 'color'],
                'secondary_color' => ['label' => 'Secondary Color', 'type' => 'color'],
                'accent_color' => ['label' => 'Accent Color', 'type' => 'color'],
            ],
            'analytics' => [
                'analytics_head' => ['label' => 'Head Code (Analytics/GTM)', 'type' => 'textarea'],
                'analytics_body' => ['label' => 'Body Code', 'type' => 'textarea'],
            ],
        ];
    }

    public function index(): void
    {
        Auth::requireRole('admin');
        $schema = $this->schema();

        if ($this->isPost()) {
            foreach ($schema as $group => $fields) {
                foreach ($fields as $key => $def) {
                    if (($def['type'] ?? '') === 'image') {
                        if (isset($_FILES[$key]) && $_FILES[$key]['error'] === UPLOAD_ERR_OK) {
                            $err = null;
                            $up = Upload::handle($_FILES[$key], $err);
                            if ($up) Setting::set($key, upload_url($up['path']), $group, 'image');
                        }
                        continue;
                    }
                    if (array_key_exists($key, $_POST)) {
                        Setting::set($key, trim((string) $_POST[$key]), $group, $def['type']);
                    }
                }
            }
            ActivityLog::record('update', 'settings', null, 'Settings saved');
            Cache::flush();
            Flash::success('Settings saved.');
            redirect(admin_url('settings'));
        }

        $this->view('admin/settings/index', [
            'title' => 'Website Settings',
            'schema' => $schema,
            'values' => Setting::all(),
        ], 'admin/layout');
    }
}
