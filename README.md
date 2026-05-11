# HopeBridge NGO, PHP Website

Pure PHP + HTML + Bootstrap 5. No Node, no React, no WordPress.
Designed to be wired to MySQL later. Layout/style inspired by the Medicare template (kept under `/medicare/` as a design reference only, it is **not** loaded by the site).

## Project Structure

```
/                       → public PHP pages (index.php, about.php, news.php, ...)
/admin                  → admin dashboard (login.php, dashboard.php, manage-*.php)
/admin/partials         → admin sidebar, topbar, head, foot
/partials               → public navbar, footer, head, page-header
/includes               → config.php, db.php, auth.php
/assets/css             → style.css (public), admin.css (admin)
/assets/js              → main.js, admin.js
/medicare               → original Medicare template (DESIGN REFERENCE ONLY)
```

## How to run locally (preview)

You need PHP **8.0+** installed (no MySQL required to view the UI).

```bash
# from the project root:
php -S localhost:8000
```

Then open:
- Public site: <http://localhost:8000/index.php>
- Admin login: <http://localhost:8000/admin/login.php>
  - Demo credentials: **admin / admin**

### Alternative: XAMPP / WAMP / MAMP
Copy the project folder into `htdocs/` (or equivalent) and visit
`http://localhost/<folder-name>/index.php`.

## Connecting MySQL later

1. Create a database matching `DB_NAME` in `includes/config.php`.
2. Update `DB_HOST`, `DB_USER`, `DB_PASS` in `includes/config.php`.
3. Replace the hard-coded `$rows = [...]` arrays in each page with
   `db()->query("SELECT ...")->fetchAll()` calls.
4. Wire form POSTs in the admin modals to insert/update queries
   (forms already include `name=""` attributes ready for `$_POST`).

## Pages

**Public:** `index.php`, `about.php`, `news.php`, `events.php`,
`announcements.php`, `promotions.php`

**Admin:** `admin/login.php`, `admin/dashboard.php`,
`admin/manage-news.php`, `admin/manage-events.php`,
`admin/manage-announcements.php`, `admin/manage-promotions.php`
