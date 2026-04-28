# NGO Website — Static HTML/Bootstrap Plan

A complete static frontend for an NGO site, structured for easy later conversion to PHP + MySQL. All files are plain HTML + Bootstrap 5 (CDN) + minimal vanilla JS. No React, no build step.

## Folder structure

```
/ngo-site
├── public/
│   ├── index.html
│   ├── about.html
│   ├── news.html
│   ├── announcements.html
│   ├── events.html
│   ├── promotions.html
│   └── partials/
│       ├── navbar.html        (reference snippet for PHP include)
│       └── footer.html        (reference snippet for PHP include)
├── admin/
│   ├── login.html
│   ├── dashboard.html
│   ├── manage-news.html
│   ├── manage-announcements.html
│   ├── manage-events.html
│   ├── manage-promotions.html
│   └── partials/
│       ├── sidebar.html
│       └── topbar.html
└── assets/
    ├── css/
    │   ├── style.css          (public site theme)
    │   └── admin.css          (admin dashboard theme)
    ├── js/
    │   ├── main.js            (nav toggles, simple interactions)
    │   └── admin.js           (modal helpers, mock table actions)
    └── images/
        └── .gitkeep           (placeholder; uses Unsplash URLs in markup)
```

The whole thing lives in a top-level `/ngo-site` folder so it sits cleanly next to the existing TanStack app and can be pulled as one unit.

## Page contents

**Public pages** — share the same Bootstrap navbar (Home, About, News, Announcements, Events, Promotions) and footer.

- `index.html` — Hero with CTA, "Latest News" 3-card grid, "Upcoming Events" 3-card grid, donate/volunteer CTA band.
- `about.html` — NGO description, Mission card, Vision card, team/values section.
- `news.html` — Responsive card grid (image, title, date badge, short description, "Read more").
- `announcements.html` — Bootstrap list-group with title, message, date.
- `events.html` — Card grid with image, title, date, location, description.
- `promotions.html` — Promotional cards with image, headline, badge, CTA.

**Admin pages** — share a left sidebar (Dashboard, News, Announcements, Events, Promotions, Logout) and a topbar.

- `login.html` — Centered Bootstrap card with email + password form.
- `dashboard.html` — Stat cards (counts) + recent activity table.
- `manage-*.html` (4 pages) — Each has: page header with "Add New" button, Bootstrap table listing mock rows with Edit/Delete buttons, and a Bootstrap modal form with Title, Description (textarea), Image upload input, Date input, Save/Cancel.

## Design

- Bootstrap 5.3 via CDN (CSS + JS bundle with Popper).
- Bootstrap Icons via CDN for nav, sidebar, action buttons.
- Custom palette in `style.css`: deep green primary (`#1f7a4d`), warm accent (`#f0a04b`), neutral grays — clean professional NGO feel.
- Admin uses a light gray canvas with a dark-green sidebar for contrast.
- Fully responsive: collapsible navbar on mobile, off-canvas sidebar in admin on small screens.

## PHP-conversion friendliness

- Navbar and footer kept as standalone snippets in `public/partials/` and `admin/partials/` so each `*.html` can later become `*.php` with `<?php include 'partials/navbar.php'; ?>`.
- Repeating card/row markup is structured so a single block can later be wrapped in a `foreach` over MySQL rows.
- Form `name` attributes on all inputs match likely DB column names (`title`, `description`, `image`, `event_date`, etc.) so PHP `$_POST` handling drops in directly.
- Forms use `method="post"` and `enctype="multipart/form-data"` where image upload exists, with `action="#"` placeholders ready to point at PHP endpoints.

## Technical notes

- No package install, no edits to the existing TanStack app — files are pure static HTML and won't be served by the dev preview. You'll run them locally with any static server or `php -S localhost:8000 -t ngo-site/public`.
- Minimal JS only: Bootstrap's own bundle for modals/navbar, plus a small `admin.js` to wire the "Add New / Edit" buttons to open the modal with prefilled mock data, and "Delete" to a confirm dialog (no real persistence).
- Images use Unsplash hotlink URLs as placeholders so you don't need binary assets in the repo.

## Deliverable

After approval, I'll create all ~20 files in one batch. You can then pull the `/ngo-site` folder and run it locally.
