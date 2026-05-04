## Goal
Declutter the navbar by merging the "Updates" dropdown into the existing "Content" item, so there's a single dropdown instead of two overlapping nav entries.

## Changes

### 1. `partials/navbar.php`
- Remove the standalone `Content` nav link.
- Remove the standalone `FAQ` nav link from the top level (optional — see below).
- Rename the `Updates` dropdown to `Content` and expand its items:
  - News → `news.php`
  - Events → `events.php`
  - Promotions → `promotions.php`
  - Announcements → `announcements.php`
  - divider
  - Content Hub → `content.php`
  - FAQ → `faq.php`
- Active state highlights the dropdown when on any of: `news.php`, `events.php`, `promotions.php`, `announcements.php`, `content.php`, `faq.php`.

### Resulting top-level nav
Home · About · Projects · Consultancy · Impact · **Content ▾** · [Request a Quote]

That drops the navbar from 9 items to 7 and removes the duplication between "Updates" and "Content".

### 2. No other files need changes
All target pages already exist and are wired to the DB.

## Open question
Do you want FAQ kept inside the Content dropdown, or removed from the navbar entirely (still reachable from the footer)? Default in this plan: keep it inside the dropdown.