## Plan

**1. Homepage — add glowing "reinvest" promise band**

In `index.php`, insert a new compact section right after the hero (before the "Who We Are" intro) that surfaces the consultancy promise:

> "Every engagement reinvests into the communities we serve."

- Full-width band with a soft green→teal gradient and a subtle inner glow.
- Pulsing/glowing dot + animated sheen on the headline (CSS `@keyframes glow` + `@keyframes pulse`, respects `prefers-reduced-motion`).
- Small sub-line: "Hire us for consultancy. The surplus funds our community programs."
- CTA button → `consultancy.php` ("See how it works").
- New CSS in `assets/css/style.css`: `.reinvest-glow-band`, `.glow-dot`, `.shine-text` with reduced-motion fallback.

**2. consultancy.php — use real uploaded photos**

Copy the 5 uploaded images into `assets/images/`:
- `health_and_nutrition_2-2.jpg` → `assets/images/health-3.jpg`
- `environemnt_1.jpg` → `assets/images/environment-1.jpg`
- `agriculture_3.jpg` → `assets/images/agriculture-3.jpg`
- `agriculture_2.jpg` → `assets/images/agriculture-2.jpg`
- `consultancy_3.jpg` → `assets/images/consultancy-3.jpg`

Then in `consultancy.php`:
- Replace the hero background with `assets/images/consultancy-3.jpg` (keeps green overlay so text stays legible).
- Replace the "How proceeds return" right-column image (currently `community-1.jpg`) with `agriculture-3.jpg` (training/field shot — fits the consultancy narrative).
- Set `$page_og_image` to `assets/images/consultancy-3.jpg`.
- Add a small photo strip under the Impact Strip showing 3 thumbnails (`environment-1`, `agriculture-2`, `health-3`) to ground the page in real field work.

**3. Remove em-dash characters site-wide**

Files containing `—` or `&mdash;` (excluding `medicare/` and `admin/`):
- `index.php`, `about.php`, `services.php`, `resources.php`, `consultancy.php`
- `assets/css/style.css`, `assets/js/main.js`
- `README.md`, `database/README.md`, `database/schema.sql`

Replacement rules:
- ` — ` (space-dash-space) → `, `
- `&mdash;` → `,` (or removed if it sits between sentences — pick comma to keep grammar safe)
- Bare `—` between words → `-`
- Skip the `medicare/` WordPress theme and `admin/` (internal only).

**4. Polish for "donor-grade" feel**

- Tighten the hero CTA spacing on `consultancy.php`.
- Add `loading="lazy"` + descriptive `alt` on the new photos.
- Ensure the new homepage glow band degrades cleanly on mobile (single column, smaller pulse).

### Files touched
- `index.php` (new section + em-dash sweep)
- `consultancy.php` (real photos + em-dash sweep)
- `assets/css/style.css` (glow band styles + em-dash sweep)
- `assets/js/main.js`, `about.php`, `services.php`, `resources.php`, `README.md`, `database/README.md`, `database/schema.sql` (em-dash sweep only)
- `assets/images/` (5 new copied photos)

No business logic, DB, or admin changes.
