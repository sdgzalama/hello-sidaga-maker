## Goal
Add a "Services" dropdown to the navbar with Consultancy nested under it, surface a top-level "Contact" link, and tighten the Consultancy page content to match the supplied copy.

## 1. `partials/navbar.php` — restructure top nav

Final top-level order:
**Home · About · Services ▾ · Projects · Impact · Content ▾ · Contact** · [Request a Quote]

Changes:
- Remove the standalone `Consultancy` nav item.
- Insert a new `Services` dropdown (between About and Projects) with one item for now: **Consultancy → `consultancy.php`**. Built so more services can be added later (e.g. Training, Research).
- Add a top-level `Contact` link → `contact.php` (currently only reachable via the "Request a Quote" button).
- Active-state for the Services dropdown highlights when on `consultancy.php`.
- Keep the existing `Content` dropdown (News, Events, Promotions, Announcements, Content Hub, FAQ) unchanged.
- Keep the "Request a Quote" CTA button at the end.

## 2. `consultancy.php` — align content with supplied copy

The page already has the 5 categories with the correct services and the "Why Choose Us" tiles. Adjustments:

- **Hero / page header**: title `Consultancy Services`, subtitle `Professional consultancy across the sectors that matter most` (move the current section H2 wording into the page header subtitle area).
- **Intro section**: replace the current two intro paragraphs with the exact supplied two paragraphs. Keep the "Request a Quote" + "Partner With Us" buttons and the side image. Keep the NeST badge.
- **"Our Consultancy Services" section header**: update the intro line to the supplied: *"We organise our consultancy work into five practice areas. Each area is led by specialists with real field experience, so you get advice that works on the ground — not just on paper."*
- **Five category blocks**: keep as-is (titles, intros and per-service descriptions already match the brief).
- **"Why Choose SustainLife Foundation as Your Consultancy Partner"**: rename the current "Why Choose Us" heading to this; keep the 4 tiles (wording already matches).
- **Work With Us / CTA strip**: keep the existing CTA but add a contact details block directly beneath it showing:
  - Email: jacobdamson120@gmail.com (mailto link)
  - Phone: +255 656 891 338 / +255 788 312 626
  - Location: Tanzania
  Pulled from `SITE_EMAIL`, `SITE_PHONE`, `SITE_ADDRESS` constants so it stays in sync with `includes/config.php`.

## 3. Files NOT changing
- `includes/config.php` (constants already correct)
- All other pages, DB wiring, admin
- `partials/footer.php` (Contact link already in footer)

## Notes
- `is_active()` helper already exists; the Services dropdown uses the same `in_array(basename(...), [...])` pattern as the Content dropdown for active highlighting.
- No DB schema changes required.
