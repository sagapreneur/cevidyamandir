<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Secure file upload handler with extension + MIME + size validation.
 * Stores to storage/uploads/YYYY/MM and returns the relative path.
 */
final class Upload
{
    /** @return array{path:string,mime:string,size:int,ext:string}|null */
    public static function handle(array $file, ?string &$error = null): ?array
    {
        if (!isset($file['error']) || is_array($file['error'])) {
            $error = 'Invalid upload.';
            return null;
        }
        if ($file['error'] === UPLOAD_ERR_NO_FILE) {
            return null; // nothing uploaded
        }
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $error = 'Upload failed (code ' . $file['error'] . ').';
            return null;
        }
        if ($file['size'] > MAX_UPLOAD_BYTES) {
            $error = 'File exceeds the maximum allowed size.';
            return null;
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ALLOWED_UPLOAD_EXT, true)) {
            $error = 'File type not allowed.';
            return null;
        }

        // Verify real MIME type
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime = (string) $finfo->file($file['tmp_name']);
        // SVG/ICO can report oddly; allow when extension matches known list
        if (!in_array($mime, ALLOWED_UPLOAD_MIME, true) && !in_array($ext, ['svg', 'ico'], true)) {
            $error = 'File content does not match an allowed type.';
            return null;
        }

        // Basic SVG sanitisation (strip scripts / on* handlers)
        if ($ext === 'svg') {
            $svg = (string) file_get_contents($file['tmp_name']);
            if (preg_match('/<script|on\w+\s*=|javascript:/i', $svg)) {
                $error = 'SVG contains disallowed active content.';
                return null;
            }
        }

        $subDir = date('Y') . '/' . date('m');
        $destDir = UPLOAD_PATH . '/' . $subDir;
        if (!is_dir($destDir) && !mkdir($destDir, 0755, true) && !is_dir($destDir)) {
            $error = 'Could not create upload directory.';
            return null;
        }

        $safe = self::safeName($file['name'], $ext);
        $relative = $subDir . '/' . $safe;
        $dest = UPLOAD_PATH . '/' . $relative;

        if (!move_uploaded_file($file['tmp_name'], $dest)) {
            $error = 'Could not save the uploaded file.';
            return null;
        }

        return ['path' => $relative, 'mime' => $mime, 'size' => (int) $file['size'], 'ext' => $ext];
    }

    private static function safeName(string $original, string $ext): string
    {
        $base = pathinfo($original, PATHINFO_FILENAME);
        $base = slugify($base) ?: 'file';
        return $base . '-' . substr(bin2hex(random_bytes(4)), 0, 8) . '.' . $ext;
    }
}
