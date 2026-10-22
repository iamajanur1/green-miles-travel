# Green Miles Travel

A lightweight, premium travel, trekking, cultural-festival and trip-enquiry website for North-East India. Built around the supplied Green Miles branding and the Luxtrail layout reference, with entirely new markup and styles.

## Included

- **Laravel 13 + PHP 8.3+** server-rendered public website; **SQLite by default** (change to MySQL if traffic grows).
- **Filament 5** administration at `/manage`, with Owner/Editor roles and built-in authenticator-app MFA.
- Home, About, Tours, Tour Details, filtered Categories, Destinations, Destination Details, Journal, Contact, Privacy, Terms, custom 403/404 pages.
- Trip price, itinerary, inclusions/exclusions, FAQs, gallery, departure dates, status and featured flags.
- Editable timed event popups for Hornbill Festival, Falcon Festival and future promotions. One per session with dismissal and keyboard handling.
- Responsive custom CSS, cinematic hero, photography collages, cards, torn edges, marquees, mobile menu, slider; GSAP optional enhanced animations after asset build.
- Persistent enquiries, validation, CSRF, honeypot, per-IP throttle, configurable Turnstile, email notification, WhatsApp follow-up.
- Dynamic metadata, canonical links, simple TravelAgency/TouristTrip/Article JSON-LD, sitemap.xml, robots.txt.
- Owner-only user/settings management; activity log; closed enquiry retention scheduling.

## Requirements

- PHP **8.3+** with `pdo_sqlite`, `mbstring`, `intl`, `dom`, `xml`, `curl`, `fileinfo`, `gd`, `zip`, `openssl`
- Composer 2, Node.js 20.19+ or 22+, npm
- SQLite support (included in PHP's `pdo_sqlite` extension)
- Internet connection to install Composer/npm dependencies

## Run locally (macOS / Linux / Windows PowerShell equivalent)

```bash
# 1. Unzip the archive, then:
cd green-miles-travel

# 2. Install PHP and JS packages (needs an internet connection)
composer install
npm install

# 3. Configure environment and secret
cp .env.example .env
# EDIT .env: set ADMIN_EMAIL to your email, ADMIN_PASSWORD to a PRIVATE random 12+ character password.
# EDIT .env: set ENQUIRY_TO_EMAIL for notifications (and MAIL_* when switching away from the log mailer).
php artisan key:generate

# 4. Prepare the database, tables, starter packages and admin user
mkdir -p database
# macOS/Linux:
touch database/database.sqlite
# Windows PowerShell: New-Item database/database.sqlite -ItemType File
php artisan migrate --seed
php artisan storage:link

# 5. Build front-end assets and run the website
npm run build
php artisan serve --host=127.0.0.1 --port=8000
```

**Open:** http://127.0.0.1:8000  
**Admin:** http://127.0.0.1:8000/manage  
**MFA:** set up an authenticator app when you first sign in.

`ADMIN_EMAIL` and `ADMIN_PASSWORD` must be configured **before** `migrate --seed`; the seeder intentionally does not create a shared/default login. Do not paste credentials into ChatGPT. Edit your local `.env` only. `.env` is git-ignored.

For new migrations after the initial install:

```bash
php artisan migrate
php artisan optimize:clear
npm run build
```

Optional live-refresh development front end (second terminal): `npm run dev`. The non-GSAP public CSS and JS also load directly from `public/assets`; this means page visuals remain useful even if the Vite bundle has not been built.

## Inspect the design before installing PHP dependencies

An **offline visual design preview**, not the full booking website, lives at `preview/index.html`. From the project directory:

```bash
python3 -m http.server 8080
# visit http://localhost:8080/preview/index.html
```

It shares the website's actual `public/assets/site.css`, JavaScript and images. Forms/admin/database are not connected in that preview. It is only a convenience; the Laravel routes are the main implementation.

## Content management

1. Visit `/manage`. Create and edit trips, categories, destinations, departures, popups, journal posts, testimonials, and users (Owner only).
2. Use **Announcements** to enable one popup. Configure event date, image, price, window and CTA.
3. For a new trip, add at least a title, slug, price, category, itinerary and cover photo before publishing. Set Featured if it belongs on the homepage (recommended: maximum 3).
4. Open **Enquiries** to change status (`new`, `contacted`, `confirmed`, `closed`) and store private notes.
5. Use **Site settings** for phone, WhatsApp, email and homepage headline/photo.

The supplied flyers are seeded as **editable starter content**. Not all flyers state inclusions, seats, transport, exact day-by-day itineraries or final booking prices. Unconfirmed fields deliberately ask customers to confirm with the team. **All package descriptions, prices and dates need approval before taking live enquiries.**

## Festival popups

`Announcement` fields: `title`, `eyebrow`, `description`, `image`, `event_date`, `price_from`, `location`, `cta_label`, `cta_url`, `is_active`, `starts_at`, `ends_at`, `priority`. The highest priority announcement within its date window displays after a short delay. It dismisses with ×, backdrop, Escape, CTA or 'Maybe later'. It shows once per browser session. `prefers-reduced-motion` disables the entrance animation.

## WhatsApp / phone

Poster contact numbers initially used: **6002529424** and **7577853010**. The configured WhatsApp number initially uses the first number. **Verify which number receives WhatsApp and calls** and update them in Site settings before launch. Country code is +91 for the supplied numbers.

## What is not included in version 1

- No payment checkout, visitor account registration or seat locking. The real business confirms bookings by call/WhatsApp.
- No fake user testimonials, fabricated traveller counters or unconfirmed itinerary promises.
- No exported or cloned Luxtrail source code, photos or illustrations.
- Automatic social feed scraping is intentionally not included; upload only material you have rights to publish.

## Security and launch

Follow `docs/DEPLOY.md` and `docs/QA.md`. Never use `APP_DEBUG=true` in production. Turnstile **must** be configured on production; submissions fail closed when its secret is missing. Email defaults to `MAIL_MAILER=log`, so set up real SMTP plus `ENQUIRY_TO_EMAIL` before launch. Check privacy/terms drafts with a legal adviser. Use proper backups, HTTPS and an SMTP mailbox.

## Test commands

```bash
php artisan route:list
php artisan migrate:status
php artisan test
npm run check
npm run build
composer audit
npm audit
```

**Important build verification note:** This source archive was generated in an environment with PHP but **without Composer, required PHP database extensions or package-download network access**. PHP syntax and local structural checks were performed; framework installation, rendered Laravel requests, Filament compatibility, delivery of email and deployment were **not executable here**. Run the commands above in your normal Laravel development machine and resolve any real integration issues before production. The archive contains no `vendor/` or `node_modules/`, which is standard for a source-code delivery.

## Source assets and permissions

Logo and flyers come from the user's attachments; a cropped scenic photo from the supplied Kapamodzu screenshot is used as temporary website photography. Replace the screenshot-derived photos with high-resolution original Green Miles trip photos before launch. See `docs/ASSETS.md`.

## Repository layout

- `app/Http/Controllers/` — page routes, enquiry handler
- `app/Filament/Resources/` — editable content and admin routes
- `app/Models/` — Eloquent models
- `database/migrations/` and `database/seeders/` — schema and editable starter content
- `resources/views/` — Blade templates
- `public/assets/` — CSS, vanilla JS, supplied images
- `resources/js/app.js` — optional GSAP enhanced animations
- `preview/` — static design-only visual preview
- `docs/PROJECT_SOURCE.txt` — supplied requirements document, included for reference
