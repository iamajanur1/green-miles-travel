# Green Miles Assets and Source Tracking

## Provided by the business

- `public/assets/images/logo.png` — exact supplied Green Miles round logo (150x150), should be replaced with original vector logo when available.
- `hornbill-packages.webp`, `hornbill-camping.webp` — optimized supplied 2026 Hornbill promotional flyers.
- `falcon-poster.webp`, `durga-packages.webp` — optimized supplied promotional screenshot/poster material.
- `kapamodzu-hero.webp`, `kapamodzu-flowers.webp`, `kapamodzu-hills.webp`, `kapamodzu-wildflowers.webp` — optimized crops from the *user-supplied Kapamodzu photograph screenshot*, NOT original full-quality camera files. Some image crops retain text overlay from the source screenshot. These are temporary.

## Replace before production

- One 2400+ px wide original hero photograph with an area for headline text.
- Six original 4:5 category covers.
- Each package: original 3:2 card cover, 6–10 photo gallery images (owned/licensed, and recognizable people consent).
- Destinations and team portrait images; testimonials only with written consent.
- Vector logo and confirmed exact tagline wording.

Admin uploads save to Laravel's public disk. The code deliberately avoids downloading Luxtrail's licensed photos, Webflow source, or unrelated stock images.
