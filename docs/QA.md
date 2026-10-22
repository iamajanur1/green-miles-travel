# Green Miles QA and Acceptance Checklist

## In this delivery (offline)

- [x] PHP syntax checked on application, routes, migrations, configuration and public entry files.
- [x] Browser assets/preview written; semantic image, header, popup and form markup inspected.
- [x] JavaScript syntax checked with Node.
- [ ] Full `composer install`, database migrations and Filament routes executed (**unavailable here**).
- [ ] Real rendered browser visual screenshots validated (**headless Chromium timeout in this environment**).
- [ ] SMTP, anti-spam, customer consent, production HTTPS and backup restore (**require user infrastructure**).

## To test on your machine after setup

- [ ] `composer install`, `npm install`, `php artisan key:generate`, `php artisan migrate --seed`, `npm run build`, `php artisan route:list` all complete.
- [ ] Desktop widths 992, 1024, 1280, 1440, 1920 and mobile widths 360, 393, 430, 768 tested manually.
- [ ] Homepage has no side-scroll; 12-section composition feels consistent with Luxtrail *layout reference*, no cloned assets.
- [ ] Hamburger menu toggles, keyboard focus, Escape closing, destination carousel next/previous, low-motion preference.
- [ ] Announcement appears once per session, can close, correct event date, admin switch works, inactive/expired does not appear.
- [ ] Filters and sort work; empty category shows explanation; details show correct prices and itineraries.
- [ ] Logged-out visitors cannot access `/manage`; editors cannot visit Owner-only Users and Site Settings via direct URL.
- [ ] Owner MFA enrolled; password changes, disabled accounts blocked; no known default passwords.
- [ ] Enquiry stores a database record; invalid/CSRF/spam requests fail; rate limit works; admin sees status and notes; real SMTP mail delivered.
- [ ] Confirm number receiving WhatsApp and number receiving calls; run from a real smartphone.
- [ ] Check no user-supplied raw HTML executes in rich content or form confirmation messages.
- [ ] Test file upload with oversized files, SVG carrying JavaScript, PHP file, malformed image, valid JPG/PNG/WebP; only safe formats may go live.
- [ ] All pages have useful image alt text, labels, titles, descriptions, canonical, sitemap; confirm structured data.
- [ ] Lighthouse Core Web Vitals on mid-range mobile, accessibility check with axe, keyboard-only test; optimize assets as needed.
- [ ] Legal review on privacy, payment/cancellation, Indian data protection obligations before launch.
- [ ] Turnstile keys and email live, SSL, encrypted backups, retention schedule, security headers, domain ownership verified.

## Recommended functional tests for local acceptance

```bash
php artisan route:list
php artisan migrate:status
php artisan test
npm run check
npm run build
```
