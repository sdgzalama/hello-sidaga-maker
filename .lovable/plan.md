## Goal
Restructure the Services area so the navbar exposes a real "Services" hub (not just Consultancy), each service has a "Learn More" button that opens a detailed modal, the page reads at a corporate / professional level, and the rest of the site is audited for the issues this restructure surfaces. Then explain how to host this PHP site on Cloudflare's free tier (with the important caveat that Cloudflare Pages does **not** execute PHP).

---

## 1. Define the Services catalogue (single source of truth)

Create `includes/services.php` that returns one PHP array of services. Each entry has:
- `slug`, `title`, `tagline`, `icon` (Bootstrap Icons), `tone` (blue/yellow/green)
- `summary` (1–2 lines for cards)
- `details` — long-form HTML-ready blocks: **Overview**, **What we deliver**, **Typical engagements**, **Who it's for**, **Outcomes / KPIs**, **Why SustainLife**
- `cta_label` + `cta_link` (defaults to `contact.php?service={slug}`)

Initial services:
1. **Consultancy** — umbrella; modal links into the dedicated `consultancy.php` page for the full 5-practice breakdown.
2. **Strategic & Business Advisory**
3. **Technical & IT Solutions**
4. **Social & Development Programs**
5. **Research, M&E and Innovation**
6. **Agricultural & Field Services**
7. **Training & Capacity Building**

Both `services.php` (new page) and the navbar dropdown read from this same array, so nothing drifts.

## 2. Navbar restructure (`partials/navbar.php`)

Replace the current single-item Services dropdown with a richer one driven by the catalogue:

```text
Services ▾
  ├── All Services           → services.php
  ├── ──────────
  ├── Consultancy            → services.php#svc-consultancy
  ├── Strategic & Business   → services.php#svc-strategy
  ├── Technical & IT         → services.php#svc-it
  ├── Social & Development   → services.php#svc-social
  ├── Research & M&E         → services.php#svc-research
  ├── Agricultural & Field   → services.php#svc-agriculture
  └── Training & Capacity    → services.php#svc-training
```

- Each link goes to the matching card on `services.php` via a `#svc-{slug}` anchor.
- Active-state highlights when on `services.php` **or** `consultancy.php`.
- Keep the existing Content dropdown, Contact link and "Request a Quote" button untouched.

## 3. New page: `services.php`

Corporate/professional layout, mirroring the existing site theme (`section`, `card-ngo`, `badge-pill-ngo`, `icon-tile`, etc.):

- **Hero / page header** via `partials/page-header.php` — title "Our Services", subtitle "End-to-end consultancy and implementation across the sectors that move Tanzania forward."
- **Intro band** — short positioning statement + trust signals (NeST registered, sector coverage, multi-disciplinary teams).
- **Services grid** — responsive 3-column card grid. Each card:
  - icon tile, sector badge, title, 2-line summary
  - **"Learn More"** button → opens a Bootstrap modal unique to that service
  - Secondary **"Request a Quote"** link → `contact.php?service={slug}`
  - Card wrapper has `id="svc-{slug}"` for anchor scroll from the navbar.
- **One modal per service** (looped from the catalogue) with:
  - Header: icon + title + sector pill
  - Body: Overview → What we deliver (bulleted) → Typical engagements → Who it's for → Outcomes/KPIs → Why SustainLife
  - Footer: "Request a Quote" primary button + (for Consultancy) a "View full Consultancy page" link → `consultancy.php`
  - `modal-lg`, `modal-dialog-scrollable`, `modal-dialog-centered` for a polished corporate feel.
- **"Why partner with us" strip** — 4 tiles (Sector depth, Senior-led teams, Evidence-driven, Outcome-focused).
- **CTA strip** identical pattern to `consultancy.php` for visual consistency.
- Smooth-scroll script so `#svc-{slug}` anchors land cleanly under the sticky navbar (offset for the navbar height).

## 4. Tighten `consultancy.php`

- Add a "Back to all services" breadcrumb link near the top → `services.php`.
- Keep the existing 5-practice deep dive — `consultancy.php` becomes the **deep page**, while `services.php` is the **hub**.
- No content rewrite needed beyond that link.

## 5. Site-wide audit (fix what this work uncovers)

Read each of these and patch issues found; report findings in the final summary:

- `partials/navbar.php` — confirm no duplicate `Consultancy` entries remain; ensure `is_active()` covers both `services.php` and `consultancy.php`.
- `partials/footer.php` — if it lists "Consultancy" in a Quick Links column, replace with "Services" → `services.php`.
- `index.php` — if the homepage features a "Services" / "What we do" section, point its "View all" / card links at `services.php` and the new anchors instead of `consultancy.php` directly.
- `contact.php` — if it has a "Service of interest" select, populate it from `includes/services.php` so options stay in sync; pre-select when `?service={slug}` is in the URL.
- `includes/db.php` — keep the silent-fail pattern but add an admin-only debug hint (only when `?debug=1` and an authenticated admin session) so DB outages are diagnosable without leaking errors to public visitors.
- `partials/head.php` — verify Bootstrap 5 JS bundle (with Popper) is loaded so the new modals/dropdowns work; add it if only the CSS is present.
- `assets/css/style.css` — add small additions if needed: anchor scroll offset (`scroll-margin-top`) for `.service-card`, hover lift, modal header accent.
- Quick scan of `projects.php`, `news.php`, `events.php`, `promotions.php`, `announcements.php`, `content.php`, `faq.php`, `about.php`, `impact.php` for: broken `url()` paths, missing `e()` escaping on user-influenced output, dropped `include` paths, and any lingering links to a removed Consultancy top-level nav item.
- `admin/` pages — confirm none link to a "Consultancy" top-level nav; they shouldn't, but verify.

Anything broken gets fixed in the same change set; anything risky-but-not-broken is listed in the final summary so you can decide.

## 6. Files changed / created

**New**
- `includes/services.php` — services catalogue
- `services.php` — services hub page with modals

**Edited**
- `partials/navbar.php` — richer Services dropdown
- `consultancy.php` — back-to-services link
- `partials/footer.php` — Services link (if applicable)
- `index.php` — homepage service links → `services.php` (if applicable)
- `contact.php` — dynamic service select + `?service=` preselect (if applicable)
- `partials/head.php` — ensure Bootstrap JS bundle (if missing)
- `assets/css/style.css` — small polish additions

No DB schema changes. No changes under `medicare/` (legacy theme, untouched).

---

## 7. Hosting on Cloudflare's free plan — important caveat first

**Cloudflare Pages does not execute PHP.** It serves static files plus JavaScript/TypeScript Functions (Workers). Your project is server-rendered PHP (`<?php include ... ?>`, PDO/MySQL in `includes/db.php`, an `admin/` area with sessions). Cloudflare's free tier cannot run it as-is. You have three realistic options:

### Option A — Recommended: free PHP host + Cloudflare in front (free CDN, SSL, DNS)
1. Deploy the PHP app to a free PHP host that supports MySQL, e.g. **InfinityFree**, **000webhost**, or **AwardSpace** (all free, PHP 8 + MySQL).
2. Import `database/schema.sql` via their phpMyAdmin; update `includes/config.php` `DB_*` constants with the host's credentials.
3. Point your domain's nameservers at **Cloudflare (free plan)** — you get free SSL, CDN caching, DDoS protection and analytics in front of the PHP host.
4. In Cloudflare → SSL/TLS set mode to **Full** (or **Flexible** if the origin has no cert), enable **Always Use HTTPS**, and add a Page Rule to cache `/assets/*` aggressively.

### Option B — Convert to fully static (works directly on Cloudflare Pages free)
Only viable if you drop the admin area and DB. Render each page once with PHP locally, save the HTML, and push the resulting `index.html`, `about.html`, `services.html`, etc. plus `assets/` to a GitHub repo connected to Cloudflare Pages. Forms (contact, etc.) would need to use a third-party endpoint like Formspree. Best for a brochure-only version of the site.

### Option C — Rewrite the dynamic parts as Workers/Pages Functions
Cloudflare Pages Functions run TypeScript/JS, not PHP. You'd port `admin/`, auth, and DB calls to Workers + a database like **Cloudflare D1** (free tier) or **Neon Postgres** (free tier). This is a real rewrite, not a deploy step — only worth it if you want to fully commit to Cloudflare.

After approval I'll implement sections 1–6 and then walk you through Option A step-by-step (it's the fastest path to "live on a free plan with Cloudflare in front").