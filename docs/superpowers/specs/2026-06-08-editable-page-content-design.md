# Editable Page Content (Admin "Pages" CMS) — Design

**Date:** 2026-06-08
**Project:** Mortil Holders (Laravel 8 digital-banking site)
**Status:** Approved approach (A), pending spec review

## Goal

1. Let the super admin edit the text of each section of the public pages from the admin panel.
2. Replace the old template copy with fresh, original Mortil Holders banking copy.

**Scope (this iteration):** Home, About Us, Contact. The system is built so the
remaining public pages (Business, Personal, Loans, Cards, etc.) can be added later
by inserting rows and wiring their blades — no schema or UI changes needed.

Out of scope: FAQs and Testimonials (already have admin editors), Terms/Privacy
(already editable), static data like the currency-code table.

## Architecture overview

A small, self-contained content store plus a read helper and an admin editor:

- `page_contents` table — one row per editable text field.
- `App\Models\PageContent` — Eloquent model.
- `pc()` global helper — reads a value (cached per request) with a default fallback.
- `Admin\PageContentController` — admin list/edit/update screens.
- Seeder — installs every section with its label/group/type and the new copy.
- Blade wiring — hardcoded text in the three pages replaced with `pc()` calls.

## Data model

Table `page_contents`:

| column | type | notes |
|---|---|---|
| id | bigint PK | |
| page | string(50) | `home` / `about` / `contact` |
| section_key | string(100) | unique within page, e.g. `hero_heading` |
| label | string(255) | shown in admin, e.g. "Hero heading" |
| section_group | string(100) | editor sub-heading, e.g. "Hero", "Features" (named `section_group`, since `group` is a reserved SQL word) |
| type | string(20) | `text` or `textarea` |
| value | text | the content |
| sort_order | int | order within page |
| timestamps | | |

Unique index `(page, section_key)`. Migration is idempotent (`Schema::hasTable`
guard) consistent with the other migrations added during the audit.

## Read helper `pc()`

```
pc(string $page, string $key, string $default = ''): string
```

- On first call per request, loads all rows once and keys them by `"{page}.{key}"`
  in a static array (the table is tiny, so this is a single query).
- Returns the stored `value`, or `$default` if the row is missing.
- Wrapped in a `try/catch` + `Schema::hasTable('page_contents')` guard so it returns
  the default (never 500s) before the table exists — matching the boot-time
  hardening already applied to the providers/middleware.
- Registered via `app/helpers.php` added to `composer.json` `autoload.files`.

Usage in blade: `{{ pc('home','hero_heading') }}` (auto-escaped — stored text is
plain, so no stored-XSS risk).

## Admin "Pages" editor

Routes (inside the existing `['isadmin','2fa']` + `admin` prefix group in
`routes/admin.php`):

- `GET  dashboard/pages` → `index` (name `pages.index`)
- `GET  dashboard/pages/{page}` → `edit` (name `pages.edit`)
- `PUT  dashboard/pages/{page}` → `update` (name `pages.update`)

`Admin\PageContentController`:
- `index()` — lists the editable pages (Home, About Us, Contact) with links.
- `edit($page)` — loads that page's rows ordered by `sort_order`, grouped by `section_group`.
- `update($page, Request)` — validates `$page` is a known page, saves each posted
  `section_key` back to its row (empty allowed), redirects back with success.

Views:
- `admin/pages/index.blade.php` — card list of pages.
- `admin/pages/edit.blade.php` — fields grouped by `section_group` heading; `text` → input,
  `textarea` → textarea; one Save button.

Sidebar: add a "Pages" link in `resources/views/admin/sidebar.blade.php` near the
existing "Front page" / settings items.

## Template wiring

Replace hardcoded strings in `resources/views/home/index.blade.php`,
`about.blade.php`, `contact.blade.php` with `pc()` calls. Seeded values equal the
new copy, so the rendered site is unchanged-looking until edited. Static lists and
already-editable widgets are left alone.

## New copy (seeded defaults)

### Home (`page = home`)

| key | group | type | value |
|---|---|---|---|
| hero_eyebrow | Hero | text | BANKING WITHOUT BORDERS |
| hero_heading | Hero | text | Move Money Across the World in Real Time |
| hero_subtext | Hero | textarea | Mortil Holders brings modern, secure digital banking to everyone. Open an account in minutes, hold multiple currencies, and send money worldwide with transparent, low fees — all from one app. |
| hero_button | Hero | text | Open Online Banking |
| why_heading | Why Us | text | We Reimagined Digital Banking |
| why_subtext | Why Us | textarea | For over a decade we've combined data, technology and thoughtful design to make banking simpler and more human. Today, millions trust Mortil Holders to manage, move and grow their money. |
| feature_app_title | Features | text | A Powerful Mobile & Online Experience |
| feature_app_body | Features | textarea | Check balances, move funds, freeze cards and track every transaction in real time. Our mobile and web apps put complete control of your money in your hands, wherever you are. |
| feature_cards_title | Features | text | Set Up & Spend From Your Cards in a Minute |
| feature_cards_body | Features | textarea | Create virtual and physical cards instantly, set your own limits, and spend in the currency you choose — with total transparency and total speed. |
| feature_secure_title | Features | text | Innovative, Secure and Truly Digital |
| feature_secure_body | Features | textarea | Bank-grade encryption, two-factor authentication and round-the-clock monitoring keep your money and data safe, so you can focus on living rather than worrying. |
| tool_rates_title | Tools | text | Historical Currency Rates |
| tool_rates_body | Tools | textarea | Track how rates have moved over time and time your exchanges with confidence. |
| tool_travel_title | Tools | text | Travel Expense Calculator |
| tool_travel_body | Tools | textarea | Plan trips abroad with clear, upfront estimates of what your money is worth. |
| tool_alerts_title | Tools | text | Currency Email Updates |
| tool_alerts_body | Tools | textarea | Get the rates you care about delivered straight to your inbox. |
| platform_heading | Platform | text | Your One-Stop Digital Banking Platform |
| platform_body | Platform | textarea | Exchange money across the world in real time with some of the lowest fees available, and hold and manage multiple currencies from a single, secure account. |
| stats_heading | Stats | text | Trusted by Millions Around the World |
| stats_value | Stats | text | 18.5M+ |
| stats_label | Stats | text | Happy customers and growing |
| cta_heading | Call To Action | text | Ready to Bank Smarter? |
| cta_body | Call To Action | textarea | Join Mortil Holders today and experience banking built for the way you live. |
| cta_button | Call To Action | text | Get Started |

### About (`page = about`)

| key | group | type | value |
|---|---|---|---|
| header_title | Header | text | About Mortil Holders |
| header_subtext | Header | textarea | We're on a mission to make world-class banking simple, transparent and accessible to everyone. |
| who_heading | Who We Are | text | Used by 100K+ Businesses of Every Shape & Size |
| who_body | Who We Are | textarea | From freelancers to fast-growing companies, organisations rely on Mortil Holders to hold multiple currencies, pay teams and suppliers worldwide, and move money in real time. |
| story_heading | Our Story | text | Digital Banking, Reinvented |
| story_body | Our Story | textarea | Mortil Holders was founded on a simple idea: banking should work for people, not the other way around. We replaced paperwork and hidden fees with a fast, secure, mobile-first platform you can trust. |
| feature_app_title | Features | text | Powerful Mobile & Online App |
| feature_app_body | Features | textarea | Everything you need to manage your money, on any device, around the clock. |
| feature_team_title | Features | text | Built for Multiple Users & Teams |
| feature_team_body | Features | textarea | Give your business controlled, role-based access so the right people manage the right money. |
| customers_heading | Customers | text | We Always Aim to Exceed Your Expectations |
| customers_body | Customers | textarea | Our product and our people are built around your needs, with responsive support whenever you need it. |
| cta_heading | Call To Action | text | Have Questions? Download Our App |
| cta_body | Call To Action | textarea | Get started with Mortil Holders in minutes and take your banking with you everywhere. |

### Contact (`page = contact`)

| key | group | type | value |
|---|---|---|---|
| header_title | Header | text | Contact Us |
| header_subtext | Header | textarea | We'd love to hear from you. Reach out and our team will get back to you as soon as possible. |
| location_label | Details | text | Our Location |
| location_value | Details | text | London, United Kingdom |
| email_label | Details | text | Email Us |
| email_value | Details | text | info@mortilholders.online |
| phone_label | Details | text | Call Us |
| phone_value | Details | text | +44 20 0000 0000 |

(Contact form behaviour is unchanged; only labels/intro/details become editable.)

## Install / rollout

- Migration creates the table; `PageContentSeeder` inserts all rows (idempotent:
  `updateOrInsert` keyed on page+section_key, so re-running won't duplicate).
- Local: `php artisan migrate --seed` (or run the seeder directly).
- Production: same, then editable via admin. No data loss — seeder only inserts/updates
  these specific keys.

## Testing

- Unit: `pc()` returns the seeded value; returns the default for a missing key;
  returns the default (no exception) when the table is absent.
- Feature: admin (admin guard) can load `dashboard/pages` and a page editor;
  submitting the edit form updates a row; the public Home page then renders the new value.

## Error handling / edge cases

- `pc()` never throws: missing table or row → default.
- `update()` validates `{page}` is one of the known pages; unknown → 404.
- Empty values allowed (a section can be blank).
- Stored content is rendered escaped (`{{ }}`); plain text only, so no stored XSS.
