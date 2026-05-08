
## Goals

1. Fix the "sometimes nothing is clickable" bug in Chrome (caused by the navbar dropdown JS).
2. Redesign `resource.php` so it looks professional and corporate (not a raw browser PDF download prompt).
3. Implement a real **Projects** module: admin upload/edit/delete + the public `projects.php` reads from the database (with proper detail view).
4. Audit the rest of the system for related issues and fix them.

---

## 1. Fix the Chrome "unclickable" bug

**Root cause** — `assets/js/main.js` attaches a click handler to **every** `.navbar-ngo .dropdown-toggle`. On desktop it just `return`s, but Bootstrap also binds its own `data-bs-toggle="dropdown"` handler. Two effects in Chrome:

- The accordion code calls `menu.classList.toggle('show')` directly without using Bootstrap's Dropdown API, so the open menu has no outside-click listener — it stays open and overlays the page, intercepting clicks (= "nothing is clickable").
- On window resize from mobile → desktop the `.show` class is left dangling.

**Fix in `assets/js/main.js`**:

- Use Bootstrap's `bootstrap.Dropdown` API (`getOrCreateInstance(toggle).hide()/show()`) instead of toggling classes directly.
- Only attach the listener when `mq.matches` is true; remove on resize.
- Add a global `click` listener that closes any open `.dropdown-menu.show` when the click is outside `.navbar-ngo`.
- On `resize` past the 992px breakpoint, force-close all open menus and remove `.show`.

Also in `assets/css/style.css` add `.navbar-ngo .dropdown-menu { z-index: 1050; }` and ensure no oversized invisible overlay (`.modal-backdrop` from a stuck modal) — add a small safety reset in JS that removes orphaned `.modal-backdrop` if no `.modal.show` exists.

## 2. Redesign `resource.php` (professional document viewer)

Replace the current 2-column layout with a corporate-style document viewer:

```text
┌───────────────────────────────────────────────────────────────┐
│ Hero band (blue gradient)                                     │
│   [type badge] Title                                          │
│   Years • Published date • File size                          │
│   [ Download PDF ]  [ Open in new tab ]  [ Share ▾ ]          │
└───────────────────────────────────────────────────────────────┘
┌─────────────────────────────────┬─────────────────────────────┐
│ Embedded PDF viewer             │ About this document         │
│ (PDF.js viewer with toolbar OR  │ Summary + body              │
│  <object>/<iframe> fallback)    │ Document info card          │
│ Height ~ 80vh, sticky border    │ Related resources list      │
└─────────────────────────────────┴─────────────────────────────┘
```

Concrete changes in `resource.php`:

- Add a hero header section (uses `--blue` / `--blue-dark` gradient, white text, breadcrumb "Resources › {Type} › {Title}").
- Use `<object data="..." type="application/pdf">` with `<iframe>` fallback so Chrome shows its built-in viewer with toolbar (download, print, page nav). Wrap in a card with `box-shadow`, `border-radius`, `min-height: 80vh`.
- Right column: "Document Information" card (type, years covered, published date, file size, language, status), then "Need this in another format?" CTA → contact, then "Related documents" list (other resources of same `type`, exclude current).
- Add a Web Share / copy-link button (`navigator.share` with clipboard fallback).
- Polished "not found" state (currently a tiny alert) → centered card with icon and "Browse all resources" button.

Add a `slf_related_resources($type, $excludeId, $limit)` helper to `includes/resources.php`.

CSS additions in `assets/css/style.css`:
- `.doc-hero { background: linear-gradient(135deg, var(--blue), var(--blue-dark)); color:#fff; padding: 56px 0 40px; }`
- `.doc-viewer { border-radius: 14px; overflow: hidden; box-shadow: 0 12px 40px -16px rgba(20,50,70,.25); border: 1px solid var(--border); background:#f7f7f7; }`
- `.doc-meta-card`, `.doc-meta-list li { display:flex; justify-content:space-between; padding: 10px 0; border-bottom: 1px dashed var(--border); }`
- Mobile: PDF viewer collapses below the info card with a "View / Download" prominent button.

## 3. Projects — full backend + frontend

### 3a. Admin: new `admin/manage-projects.php`

CRUD identical pattern to `manage-news.php`. Fields: `title`, `slug` (auto), `sector` (select: Health, Agriculture, Environment, Community, Education, Other), `summary`, `body` (textarea), `image` (upload), `status` (draft/active/completed). Uses existing `projects` table from `database/schema.sql` and existing `save_row` / `handle_upload` / `delete_row` helpers.

Sidebar entry already exists (`manage-projects.php`); confirm link works.

### 3b. Frontend: rewrite `projects.php`

- Read from DB (already done) but only `status IN ('active','completed')`.
- Add **sector filter chips** that actually filter (`?sector=Health`).
- Replace inline modal flow with a real **detail page** `project.php?slug=...` (modals are flaky on mobile and bad for SEO). Card "Read more" links to `project.php?slug=`.
- If a sector image is missing show a branded placeholder (icon + gradient), not a stock Unsplash URL.

### 3c. New `project.php` (public detail page)

- Hero with project image + sector badge + title + summary.
- Body (rich text, `nl2br`).
- Side card: sector, status, "Partner With Us" CTA.
- Related projects (same sector, exclude current, max 3).

### 3d. Homepage tile

`index.php` "Recent Projects" section already pulls from DB if available — confirm the link points to `project.php?slug=` instead of `projects.php#...`. Update if needed.

### 3e. Schema note

`projects` table already exists in `database/schema.sql`. No migration required; admin page will show a friendly "table missing" notice if not imported, mirroring the resources page pattern.

## 4. System audit fixes

While in here, fix these small issues found while reading the codebase:

- `partials/navbar.php`: the "Request a Quote" CTA is inside the `<ul class="navbar-nav">` as an `<li>` containing a `<a class="btn">` — that's structurally fine, but on mobile it sits inside the collapsing menu without spacing. Add `w-100 w-lg-auto text-center` to the button so it stretches on mobile.
- `assets/js/admin.js`: ensure no leftover open-modal-blocking-clicks (audit for orphan backdrop) — same fix as point 1.
- `resources.php`: the "All" filter chip and category chips are `<a>` styled with `badge-pill-ngo`; add `aria-current="page"` on the active one and underline-on-hover removal (`text-decoration:none` already applied).
- `projects.php`: remove the hard-coded Unsplash demo array — replace with an empty-state card ("No projects published yet — admin can add some via the dashboard") so production never shows fake data.
- `strategic-plan.php`: when redirecting to `resource.php`, also pass `from=strategic-plan` so the new hero breadcrumb can show "Strategic Plan" correctly.

## 5. Files touched

**New**
- `admin/manage-projects.php`
- `project.php`

**Edited**
- `assets/js/main.js` (Chrome dropdown bug fix + outside-click + resize cleanup + orphan backdrop cleanup)
- `assets/css/style.css` (document viewer styles, dropdown z-index, mobile CTA)
- `resource.php` (full redesign — hero, two-column, PDF object, related)
- `includes/resources.php` (add `slf_related_resources()` helper)
- `projects.php` (sector filter chips, link to detail page, empty-state, no fake data)
- `index.php` (project tiles → `project.php?slug=`)
- `partials/navbar.php` (CTA mobile width, minor a11y)
- `strategic-plan.php` (pass `from=strategic-plan` on redirect)

No DB schema changes. No changes under `medicare/`.

## Notes

- The PDF viewer uses the browser's built-in PDF plugin via `<object type="application/pdf">`. This works reliably in Chrome, Edge, Firefox, and Safari desktop. On iOS Safari (which doesn't render inline PDFs in `<object>`), the fallback view shows a large "Open / Download PDF" card instead of a broken frame.
- All changes are additive / cosmetic; existing data and routes keep working.

After approval I'll implement everything in one pass.
