# Channawar's e Vidya Mandir — School Website & CMS

A production-ready website for **Channawar's e Vidya Mandir** (CBSE, Nursery–Class X, Wardha) with a
custom, dependency-free PHP CMS admin panel. Every content-rich page (curriculum documents, notices,
academic calendar, gallery, programs, fees, staff, reviews) is fully database-driven and manageable
from the admin dashboard.

- **Live domain:** https://cevidyamandir.com
- **Stack:** PHP 8.1+, MySQL/MariaDB, vanilla JS (ES modules), custom CSS. No framework, no Composer
  dependencies (a lightweight PSR-4 autoloader is built in).

---

## Folder Structure

```
/
├── admin/            # Admin front controller (routes /admin/*)
├── app/
│   ├── Controllers/  # Site + Admin controllers
│   ├── Core/         # Framework core (Router, DB, Auth, View, Upload, Cache…)
│   ├── Models/       # Block, Setting, Navigation, GenericModel…
│   ├── Views/        # site/ and admin/ templates
│   ├── helpers.php   # Global helpers (asset, media_url, cms_image…)
│   └── modules.php   # Declarative CRUD module registry (drives the admin)
├── assets/           # css, js, fonts, icons, images (logo, recognition SVGs)
├── config/
│   ├── config.php    # App bootstrap (env, paths, base URL, autoloader)
│   └── database.php  # Reads DB credentials from .env
├── storage/
│   ├── uploads/      # CMS-managed media (calendar, gallery, documents, programs…)
│   ├── cache/        # Runtime cache (git-ignored)
│   ├── logs/         # Error logs (git-ignored)
│   └── backups/      # (git-ignored)
├── index.php         # Public front controller
├── .htaccess         # Routing, gzip, caching, security headers
├── database.sql      # Full schema + seed data (import into phpMyAdmin)
├── .env.example      # Environment template (copy to .env)
├── composer.json
└── README.md
```

> The repository root **is** the web root (`public_html`). Deploy the contents of this repo directly
> into `public_html/` so that `index.php` sits at the docroot.

---

## Installation (Local — XAMPP)

1. Clone into your web root, e.g. `c:\xampp\htdocs\cevidyamandir_live`.
2. Copy the environment template and adjust for local:
   ```
   copy .env.example .env
   ```
   For local XAMPP, set:
   ```
   APP_ENV=development
   DB_HOST=127.0.0.1
   DB_PORT=3306        # or 3307 if 3306 is taken by another MySQL/MariaDB
   DB_NAME=cevm_cms
   DB_USER=root
   DB_PASS=
   ```
3. Create the database (`cevm_cms`) in phpMyAdmin and **Import** `database.sql`.
4. Ensure `storage/` is writable (uploads, cache, logs).
5. Visit `http://localhost/cevidyamandir_live/`.

---

## Environment Configuration

Credentials are **never** hardcoded in tracked files. They are read from `.env` (git-ignored).
Use `.env.example` as the template.

| Key | Description |
|-----|-------------|
| `APP_ENV` | `production` or `development` (also auto-detected by host) |
| `APP_URL` | Public base URL, e.g. `https://cevidyamandir.com` |
| `DB_HOST` | Database host (`localhost` on Hostinger) |
| `DB_PORT` | `3306` (production) / `3307` (this dev machine) |
| `DB_NAME` | Database name |
| `DB_USER` | Database user |
| `DB_PASS` | Database password (server only — keep secret) |
| `DB_CHARSET` | `utf8mb4` |
| `DB_PREFIX` | `cevm_` |

If `.env` is missing, the app falls back to safe local-dev defaults (it will not expose any secret).

---

## Deployment (Production — Hostinger)

1. Upload the **contents** of this repo into `public_html/` (so `index.php` is at the docroot).
2. Create the MySQL database and user in hPanel, then **Import** `database.sql` via phpMyAdmin.
3. Create `public_html/.env` with the production values:
   ```
   APP_ENV=production
   APP_URL=https://cevidyamandir.com
   DB_HOST=localhost
   DB_PORT=3306
   DB_NAME=u937949366_cevm
   DB_USER=u937949366_cevm
   DB_PASS=********           # real password — server only
   DB_CHARSET=utf8mb4
   DB_PREFIX=cevm_
   ```
4. Set permissions: `storage/uploads`, `storage/cache`, `storage/logs` → `755` (or `775`).
5. Enable HTTPS (free SSL in hPanel). The app builds URLs from the request host automatically.
6. The app auto-switches to **production mode** on the live domain: errors hidden, HTML minified,
   caching on, errors logged to `storage/logs/`.

---

## Admin Panel

- URL: `https://cevidyamandir.com/admin`
- Default login (change immediately after first sign-in):
  - Email: `admin@cevidyamandir.com`
  - Password: `CEVM@admin2026`

Admin modules: Dashboard, Pages, Hero Slider, Statistics, Programs, **Document Management**,
**Academic Calendar**, Notices & Circulars, Downloads, Gallery, Reviews, Testimonials,
Staff & Leadership, FAQ, CTA sections, Section Content, Form Submissions, Media Library,
Settings (Contact / Social / Footer), Users. Every change reflects on the website immediately
(the cache is flushed on save).

---

## Troubleshooting

- **500 error / blank page:** confirm `.env` exists with correct DB credentials; check `storage/logs/`.
- **DB connection failed:** verify `DB_HOST`/`DB_PORT`/`DB_USER`/`DB_PASS`; on shared hosting use `localhost:3306`.
- **Site shows static fallback:** the CMS tables are missing — import `database.sql`.
- **Uploads fail / images missing:** ensure `storage/uploads` is writable (`755`/`775`).
- **Clean URLs 404:** confirm `mod_rewrite` is enabled and `.htaccess` is being read (`AllowOverride All`).
- **Emails not arriving:** form submissions are always stored in the admin (Form Submissions); email
  delivery requires a configured mail transport on the host.

---

© 2026 Channawar's e Vidya Mandir. All rights reserved.
