## Plan: Structured Consultancy Page + SQL Schema

### 1. Rewrite `consultancy.php`

Keep the existing `theme-consult` layout, page-header, and partials. Replace the body with five clearly-separated sections written in a warm, human voice (not robotic):

**Section 1 — Intro**
- Two-column layout: left = headline + intro paragraph based on the SLF NeST registration; right = supporting image.
- Pill badge: "Registered on Tanzania NeST".
- CTA buttons: "Request a Quote" + "Partner With Us".

**Section 2+3 — Service Categories with cards**
Five category blocks, each rendered as a `card-ngo` with header (icon + title + short intro) and a nested grid of sub-service mini-cards:

1. Strategic & Business Consultancy — Strategic Planning, Organisation & Change Management, Human Resources, Tax Consultancy
2. Technical & IT Services — IT Consultancy, Software Development, Systems Implementation
3. Social & Development Consultancy — Health Care, Educational, Food & Nutrition, Environmental
4. Research & Innovation — Research, Survey & Development Consultancy
5. Agricultural & Field Services — Crop Cultivation Services

Each sub-service has a title + short human-written description. Data driven by a PHP array `$categories` so the markup loops cleanly (easy to swap for DB later).

**Section 4 — Why Choose Us**
4-column feature grid with icons:
- Community-driven expertise
- Multi-sector experience
- Government-aligned services
- Impact-focused approach

**Section 5 — CTA strip**
Reuse `.cta-strip` gradient with two buttons: "Request a Quote" → contact.php, "Partner With Us" → contact.php?type=partner.

### 2. Minor CSS additions to `assets/css/style.css`

Add a few corporate-feeling utilities scoped to `.theme-consult`:
- `.service-group` card with subtle top border accent
- `.sub-service` mini-card (light bg, hover lift)
- `.why-tile` for the Why-Choose-Us icons

Keeps the consultancy page visually distinct (more structured/corporate) while staying consistent with the rest of the brand.

### 3. SQL schema — new `database/schema.sql`

Provide a ready-to-import MySQL file matching the existing site sections. Tables:

```text
admins(id, username, password_hash, full_name, email, created_at)
news(id, title, slug, category, excerpt, body, image, published_at, status)
events(id, title, slug, location, start_at, end_at, description, image, status)
announcements(id, title, body, published_at, status)
promotions(id, title, body, image, starts_on, ends_on, status)
projects(id, title, slug, sector, summary, body, image, status)
service_categories(id, name, slug, icon, intro, sort_order)
services(id, category_id FK, title, slug, description, sort_order)
contact_messages(id, name, email, phone, subject, message, type, created_at)
quote_requests(id, organization, contact_name, email, phone, service_id FK, scope, budget, timeline, created_at)
```

Includes:
- InnoDB + utf8mb4
- Indexes on slugs and FKs
- Seed `INSERT` rows for the 5 service categories and all sub-services listed above
- Default admin row (username `admin`, bcrypt hash placeholder noted in a comment)

### 4. Files touched

- edit `consultancy.php` (full rewrite of body)
- edit `assets/css/style.css` (append consultancy utilities)
- create `database/schema.sql`
- create `database/README.md` with `mysql -u root slf_site < database/schema.sql` import instructions

No JS, no frameworks, no WordPress. Pure PHP + HTML + CSS, consistent with existing partials and helpers (`url()`, `asset()`, `e()`).
