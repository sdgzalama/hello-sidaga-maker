## Goal

Tighten the navbar (smaller, slimmer dropdowns), reorganise navigation into a clearer NGO-appropriate hierarchy (Home / About / Services / Projects / Resources / Media / Contact), drop the commercial word "Promotions" in favour of "Campaigns", and add a real **Resources** area where admin uploads the Strategic Plan, Annual Reports, Policies and other downloads — viewable inline as PDFs and downloadable. Projects continue to be admin-managed; Strategic Plan documents become a new admin-managed content type.

---

## 1. Navbar restructure (`partials/navbar.php`)

New top-level menu, in this order:

```text
Home | About | Services ▾ | Projects | Resources ▾ | Media ▾ | Contact     [Request a Quote]
```

- **Services ▾** — slimmed down to only the high-level groups (not all 7 detailed services):
  - All Services → `services.php`
  - Consultancy → `services.php#svc-consultancy`
  - Technology → `services.php#svc-it`
  - Research & M&E → `services.php#svc-research`
  - Agriculture → `services.php#svc-agriculture`
  - Training → `services.php#svc-training`
  - The remaining services (Strategy, Social) stay visible on the `services.php` hub but are dropped from the navbar dropdown to reduce height.
- **Resources ▾** (new):
  - Strategic Plan → `resources.php?type=strategic-plan` (or dedicated `strategic-plan.php`)
  - Annual Reports → `resources.php?type=annual-report`
  - Publications → `resources.php?type=publication`
  - Policies → `resources.php?type=policy`
  - Downloads → `resources.php`
  - FAQ → `faq.php`
- **Media ▾** (renamed from "Content"):
  - News → `news.php`
  - Events → `events.php`
  - Announcements → `announcements.php`
  - Campaigns → `campaigns.php` (renamed from Promotions)
  - Content Hub → `content.php`
- Active state covers all child pages of each dropdown.
- "Request a Quote" CTA stays.

## 2. Slimmer dropdown CSS (`assets/css/style.css`)

Add a navbar-scoped block:

```css
.navbar-ngo .dropdown-menu {
  min-width: 240px;
  padding: 6px 0;
  border: 1px solid var(--border);
  border-radius: 10px;
  box-shadow: 0 8px 24px -10px rgba(20,50,70,.18);
}
.navbar-ngo .dropdown-item {
  padding: 8px 16px;
  font-size: .92rem;
  font-weight: 500;
}
.navbar-ngo .dropdown-item i { font-size: .9rem; opacity: .8; }
.navbar-ngo .dropdown-item:hover { background: var(--blue-soft); color: var(--primary); }
.navbar-ngo .dropdown-divider { margin: 4px 0; }
@media (min-width: 992px) {
  .navbar-ngo .dropdown-menu { max-height: 70vh; overflow-y: auto; }
}
```

Also: bump logo to `height: 56px` and tighten `.navbar-nav` gap so the empty horizontal whitespace shrinks.

## 3. Mobile: accordion-style dropdowns

Add a small JS tweak in `assets/js/main.js` so on `<992px` the dropdowns expand inline (click toggles `.show` on the submenu instead of opening as floating menu) — keeps spacing touch-friendly.

## 4. Rename Promotions → Campaigns (NGO tone)

- Add `campaigns.php` that mirrors `promotions.php` (queries the same `promotions` table for now to avoid a schema rename).
- Update all link references (`navbar`, `footer`, `index`, admin sidebar) from "Promotions" → "Campaigns".
- Keep `promotions.php` as a thin redirect to `campaigns.php` so old links don't break.
- Admin label: "Manage Campaigns" (file stays `admin/manage-promotions.php` internally; topbar/sidebar text changes).

## 5. New Resources area (admin-uploadable documents)

### 5a. Schema (additive — `database/schema.sql`)

```sql
CREATE TABLE `resources` (
  `id`           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title`        VARCHAR(200) NOT NULL,
  `slug`         VARCHAR(220) NOT NULL UNIQUE,
  `type`         ENUM('strategic-plan','annual-report','publication','policy','download') NOT NULL,
  `summary`      VARCHAR(500) DEFAULT NULL,
  `body`         MEDIUMTEXT   DEFAULT NULL,
  `years_covered` VARCHAR(40) DEFAULT NULL,   -- e.g. "2025–2030"
  `file_path`    VARCHAR(255) NOT NULL,        -- relative path under /assets/docs/
  `file_size`    INT UNSIGNED DEFAULT NULL,    -- bytes
  `cover_image`  VARCHAR(255) DEFAULT NULL,
  `status`       ENUM('draft','published') NOT NULL DEFAULT 'draft',
  `published_at` DATETIME DEFAULT NULL,
  `created_at`   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `idx_resources_type_status` (`type`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

(Document this as an additive migration — admin sees friendly notice if table missing.)

### 5b. Public pages

- **`resources.php`** — Hub page listing all published resources, filterable by `?type=` (chips: All, Strategic Plan, Annual Reports, Publications, Policies, Downloads). Each card shows cover, title, year, file size, "View" + "Download PDF" buttons.
- **`resource.php?slug=...`** — Detail page with summary, embedded PDF viewer:
  ```html
  <iframe src="<?= asset('docs/'.$res['file_path']) ?>"
          width="100%" height="800" style="border:0;border-radius:10px;"></iframe>
  ```
  Plus prominent `Download PDF` button and metadata block (years covered, file size, published date).
- **`strategic-plan.php`** — convenience route that loads the latest published `strategic-plan` resource (or lists all if multiple) — so the navbar link is direct.

### 5c. Admin

- New `admin/manage-resources.php` — list + create/edit/delete with file upload (PDF, max ~20 MB) saved to `assets/docs/` with sanitised filename, plus cover image upload to `assets/uploads/`.
- Sidebar entry: "Resources" with sub-actions per type, or a single page with a `type` filter.
- Use existing `crud.php` patterns; add upload helper that validates MIME `application/pdf` and stores `file_size` automatically.

### 5d. Projects already admin-managed

Projects table + admin already exist; confirm `admin/manage-projects.php` exists or create it (same CRUD pattern as news/events) so admin can fully upload projects with image, sector, body. Public `projects.php` reads from DB and falls back to placeholder cards if empty.

## 6. Footer + cross-link updates

- `partials/footer.php` Explore column: Home, About, Services, Projects, Resources, Media, Contact (drop "Content").
- `index.php`: any homepage tile linking to "Promotions" becomes "Campaigns"; add a small "Resources / Strategic Plan" highlight card linking to `strategic-plan.php`.
- `contact.php` service select stays driven by `includes/services.php`.

## 7. CTA tweak

Keep the yellow "Request a Quote" as primary, but on `services.php` and `resources.php` add a secondary **"Partner With Us"** (`contact.php?type=partner`) — already wired. No "Donate" button until you confirm donations are in scope.

## 8. Files touched

**New**
- `resources.php`, `resource.php`, `strategic-plan.php`, `campaigns.php`
- `admin/manage-resources.php`
- `assets/docs/.gitkeep` (folder for uploaded PDFs)

**Edited**
- `partials/navbar.php` — new structure, slimmer Services dropdown, Resources + Media dropdowns
- `partials/footer.php` — Explore column updated
- `assets/css/style.css` — slim dropdown styles, larger logo, tighter nav spacing
- `assets/js/main.js` — mobile dropdown accordion tweak
- `index.php` — Promotions→Campaigns; add Strategic Plan highlight
- `promotions.php` — redirect to `campaigns.php`
- `admin/partials/sidebar.php` + `admin/partials/topbar.php` — Promotions→Campaigns label, add Resources entry
- `database/schema.sql` — `resources` table appended
- `includes/crud.php` — add `save_uploaded_pdf()` helper if not already present

No changes under `medicare/`. No breaking changes to existing tables.

---

## 9. Quick answers to the cosmetic points

- **Logo size**: `.navbar-ngo .navbar-brand img { height: 56px; width: 56px; }` (was 46px) and reduce surrounding padding.
- **Empty whitespace** between brand and menu: drop `ms-auto` to `ms-lg-4` and add `gap-lg-1` on `.navbar-nav` so items breathe without floating right.
- **Mobile**: hamburger already exists; the JS accordion tweak (step 3) makes nested dropdowns usable on touch.

After approval I'll implement steps 1–8 in one pass.