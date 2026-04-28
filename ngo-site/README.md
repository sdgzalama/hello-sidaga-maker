# HopeBridge NGO — Static Frontend

A complete static HTML/Bootstrap frontend for an NGO website, ready to be converted to PHP + MySQL.

## Folder structure

```
ngo-site/
├── public/                    Public-facing pages
│   ├── index.html
│   ├── about.html
│   ├── news.html
│   ├── announcements.html
│   ├── events.html
│   ├── promotions.html
│   └── partials/              Reusable navbar/footer (for PHP includes)
├── admin/                     Admin dashboard UI
│   ├── login.html
│   ├── dashboard.html
│   ├── manage-news.html
│   ├── manage-announcements.html
│   ├── manage-events.html
│   ├── manage-promotions.html
│   └── partials/              Reusable sidebar/topbar
└── assets/
    ├── css/   (style.css, admin.css)
    ├── js/    (main.js, admin.js)
    └── images/
```

## Run locally

Any static server works. Two easy options:

```bash
# With PHP (serves the public site)
php -S localhost:8000 -t ngo-site/public

# Then visit:
#   http://localhost:8000/index.html
#   http://localhost:8000/../admin/login.html  (or open admin folder separately)
```

```bash
# Or with Python
cd ngo-site && python3 -m http.server 8000
# Visit http://localhost:8000/public/index.html
```

## Tech

- HTML5
- Bootstrap 5.3 (CDN)
- Bootstrap Icons (CDN)
- Minimal vanilla JS (no frameworks)

## Converting to PHP + MySQL

1. Rename `*.html` → `*.php`.
2. Replace inline navbar/footer/sidebar markup with `<?php include 'partials/navbar.php'; ?>` etc. (snippets are already in `partials/`).
3. Wrap repeating `card` / `tr` blocks in `foreach ($rows as $row)` — DB-friendly comments are placed in the markup.
4. Form `name` attributes match likely DB column names (`title`, `description`, `image`, `event_date`, `location`).
5. Update `<form action="...">` to point at PHP endpoints.

## Admin demo

The login form posts to `dashboard.html` for demo navigation. Replace with real auth in PHP. Add/Edit/Delete buttons are wired to a Bootstrap modal — no persistence yet.
