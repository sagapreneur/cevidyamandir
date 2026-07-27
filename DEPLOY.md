# Channawar''s e Vidya Mandir â€” Hostinger Deployment Guide

This folder is the complete, production-ready website. Upload everything inside
it to your Hostinger `public_html` and import the database. That is all.

--------------------------------------------------------------------
## 1. Upload the files
--------------------------------------------------------------------
- In hPanel open **File Manager** (or use FTP).
- Upload the **entire contents of this folder** into `public_html/`
  so that `index.php` sits directly inside `public_html/`.
  (If you upload the folder itself, move the files up one level.)

--------------------------------------------------------------------
## 2. Create the MySQL database
--------------------------------------------------------------------
- hPanel > **Databases > MySQL Databases**.
- Create a database and a database user, and assign the user to it.
- Note down: **Database name**, **Username**, **Password**, **Host**
  (host is usually `localhost` on Hostinger).

--------------------------------------------------------------------
## 3. Enter your database details
--------------------------------------------------------------------
Edit **`config/database.php`** and set:

    define(''DB_HOST'', ''localhost'');       // Hostinger DB host
    define(''DB_NAME'', ''your_db_name'');     // the database you created
    define(''DB_USER'', ''your_db_user'');     // the DB user
    define(''DB_PASS'', ''your_db_password''); // the DB user password
    define(''DB_CHARSET'', ''utf8mb4'');
    define(''DB_PREFIX'', ''cevm_'');          // KEEP as cevm_

--------------------------------------------------------------------
## 4. Import the database
--------------------------------------------------------------------
- hPanel > **phpMyAdmin** > select your new database.
- Go to the **Import** tab > choose **`database.sql`** (in this folder) > **Go**.
- All tables (prefixed `cevm_`) and content will be created.

--------------------------------------------------------------------
## 5. Folder permissions (writable uploads)
--------------------------------------------------------------------
Make the `storage` folder writable so admins can upload images/PDFs:
- `storage/uploads`, `storage/cache`, `storage/logs` -> permission **755** (or 775).

--------------------------------------------------------------------
## 6. Log in to the admin panel
--------------------------------------------------------------------
- Visit: `https://yourdomain.com/admin`
- Email:    **admin@cevidyamandir.com**
- Password: **CEVM@admin2026**
- IMPORTANT: change this password immediately after your first login.

--------------------------------------------------------------------
## 7. Final security & production notes
--------------------------------------------------------------------
- After a successful import, **delete `database.sql`** from `public_html`
  (it is only needed once).
- The site auto-switches to **production mode** on a real domain
  (errors hidden, HTML minified, caching on) â€” no config change needed.
- Enable **HTTPS** (free SSL in hPanel). The site builds URLs automatically.
- Images live in `storage/uploads`. Placeholders labelled "Awaiting Image"
  can be replaced later from the admin panel without editing code.

Enjoy your new website!
