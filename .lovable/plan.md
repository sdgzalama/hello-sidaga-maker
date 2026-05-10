## Plan: Wider layout, redesigned Consultancy page, sitewide SEO

### 1. Fix the "shrunk" feel — widen the container to ~1440px

**File:** `assets/css/style.css` (top, after `:root`)

Override Bootstrap's `.container` max-width on large screens so the site uses more of the viewport without going full-bleed (preserves comfortable line length on body text).

```css
@media (min-width: 1200px) {
  .container, .container-lg, .container-xl, .container-xxl { max-width: 1320px; }
}
@media (min-width: 1440px) {
  .container, .container-lg, .container-xl, .container-xxl { max-width: 1400px; padding-left: 2rem; padding-right: 2rem; }
}
```

Also lift the hero so it stretches edge-to-edge on big monitors (the inner `.container` already widens with the rule above), and bump `.hero h1` slightly for balance at the new width. No HTML changes needed — same `.container` class everywhere.

### 2. Redesign `consultancy.php` — warm, community-first, professional

Goal: looks like an NGO that *also* consults, not a corporate firm. Earth tones, community photos lead, narrative framed around "expertise that funds community impact."

**New page structure (rewrites `consultancy.php`):**

1. **Hero band** — earth-green gradient with a real community/field photo overlay. Eyebrow: `TECHNICAL & CONSULTANCY SERVICES`. H1: *Technical & Consultancy Services for Impact*. Sub-paragraph: the user's exact copy ("SustainLife Foundation provides professional technical and advisory services… directly support community programs and long-term impact"). Two CTAs: "Request a Quote" + "Partner With Us".

2. **Impact framing strip** — soft cream band, single sentence: *"Every engagement reinvests into the communities we serve."* with three small stat tiles (Sectors served, Community programs funded, Years on the ground).

3. **Our Strategic Partnerships** — section title + intro line, then a 5-card row (icon + label) for: Government institutions; Development partners & donors; NGOs & civil society organisations; Private-sector stakeholders; Community groups & associations.

4. **Our Consultancy Services** — keep the existing 5 categories array, but redesign the cards: warm off-white surface, green left-accent bar, hand-drawn-feel icon tile, sub-services as a clean checklist. Spacing increased; no flashy gradients.

5. **How proceeds return to the community** — 3-step horizontal flow (Engagement → Surplus reinvested → Community programs delivered), with a single supporting photo on the right.

6. **Why partner with us** — 4-tile band (community-driven expertise, multi-sector experience, government-aligned, impact-focused) — same items as today but warmer typography and softer card style.

7. **CTA + contact strip** — unchanged in intent, restyled to match the warmer palette (cream background, green primary button, yellow secondary).

**Style additions** (scoped to `.theme-consult` in `assets/css/style.css`):
- New tokens: `--cream:#fbf7ef`, `--earth:#7a5a3a`, soft shadow.
- New classes: `.consult-hero`, `.partner-card`, `.service-card-warm`, `.flow-step`, `.impact-strip`.
- Replace the heavy blue corporate hero override with a green/earth gradient + photo.

No business logic changes; the `$categories` array stays. The `<?= str_pad(...) ?>` "CATEGORY 0X" label is removed in favour of cleaner section headers.

### 3. SEO pass — all main pages

**`includes/config.php`** — add helpers:
- `slf_seo($opts)` accepting `title`, `description`, `canonical`, `og_image`, `type`, `jsonld` and rendering tags.
- Constant `SITE_URL` defaulting to `https://sustainlifefoundation.org` (overridable via env).

**`partials/head.php`** — replace the static title/description block with:
- `<title>` from `$page_title` + brand suffix (≤60 chars guard).
- `<meta name="description">` from `$page_description` (≤160 chars guard, fallback to current text).
- `<link rel="canonical" href="SITE_URL + REQUEST_URI">`.
- Open Graph + Twitter card tags (`og:title`, `og:description`, `og:type`, `og:url`, `og:image`, `og:site_name`, `twitter:card=summary_large_image`).
- Organization JSON-LD (name, url, logo, sameAs socials, contactPoint with `SITE_EMAIL` / `SITE_PHONE`, address with `SITE_ADDRESS`).
- Optional per-page JSON-LD via `$page_jsonld` (e.g. Service schema on `consultancy.php` and `services.php`, Article on news detail later).
- `robots` meta (default `index,follow`, overridable).

**Per-page metadata** — add `$page_title` + `$page_description` (and `$page_og_image` where a hero photo exists) to: `index.php`, `about.php`, `services.php`, `consultancy.php`, `projects.php`, `project.php`, `resources.php`, `resource.php`, `strategic-plan.php`, `faq.php`, `news.php`, `events.php`, `announcements.php`, `campaigns.php`, `promotions.php`, `content.php`, `contact.php`, `impact.php`. Each gets a unique, keyword-led title (<60 chars) and description (<160 chars) — e.g. *"Consultancy Services in Tanzania | SustainLife Foundation"*, *"Professional technical & advisory services across health, agriculture, environment and IT — proceeds reinvested into community programs."*

**`sitemap.xml` (new, PHP-generated)** — `sitemap.php` enumerating the public pages above with `<lastmod>` from `filemtime()`; published as `/sitemap.xml` via a tiny `.htaccess` rewrite.

**`robots.txt` (new)** — allow all, point to `https://sustainlifefoundation.org/sitemap.xml`, disallow `/admin/`.

**Other on-page SEO touch-ups (no redesign):**
- Ensure exactly one `<h1>` per page (page-header already provides one — audit `index.php` hero `<h1>` is the only h1 there; demote stray duplicates to `<h2>`).
- Add descriptive `alt` text to remaining decorative-but-unlabeled images (hero, intro, services).
- Add `loading="lazy"` to below-the-fold images.

### Files touched

- `assets/css/style.css` — container widths + new warm consultancy styles.
- `consultancy.php` — full rewrite of markup, same data array.
- `includes/config.php` — `SITE_URL`, `slf_seo()` helper.
- `partials/head.php` — SEO tag block, OG, JSON-LD, canonical, robots.
- All public PHP pages listed above — set `$page_title` + `$page_description` (+ `$page_og_image` where applicable).
- `sitemap.php` (new), `.htaccess` (add one rewrite line), `robots.txt` (new).

### Out of scope

- Admin pages (already untouched by SEO).
- New copy for every page beyond title/description (existing body copy stays).
- Image replacements beyond what consultancy.php needs.

Approve and I'll apply it in one pass.
