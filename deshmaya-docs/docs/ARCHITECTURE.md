# Architecture

## Stack
- Laravel (latest stable), PHP 8.3+, MySQL/MariaDB
- Blade + Tailwind CSS + Alpine.js, Vite
- Smooth scroll: Lenis. Animations: GSAP + ScrollTrigger (or CSS/IntersectionObserver for light effects)
- Media: spatie/laravel-medialibrary + Intervention/Imagick for WebP/AVIF conversions
- Admin: Filament (decided, D-01)
- Queue: database driver, run by cPanel cron (queue:work --stop-when-empty)
- Cache: file or database driver (no Redis on cPanel); HTTP caching headers
- Hosting: cPanel (see docs/DEPLOYMENT_CPANEL.md)

## Folder structure (target)
app/
  Http/Controllers/            (HomeController, ProductController, ContactMessageController, QuoteRequestController)
  Http/Requests/               (ContactRequest, QuoteRequest)
  Models/                      (Setting, Category, Product, ContactMessage, QuoteRequest)
  Services/SettingService.php  (get/set/cache/bust)
  View/Composers/SiteComposer.php
  View/Components/             (Picture)
  Mail/ or Notifications/      (NewContactMessage, NewQuoteRequest)
  Filament/                    (Resources: Category, Product, ContactMessage, QuoteRequest; Pages: BrandColors, BusinessInfo, LoaderSettings)
database/migrations, seeders
resources/
  views/layouts/app.blade.php
  views/partials/              (head, header, footer, loader, scripts)
  views/pages/                 (home, about, products/index, products/show, certification, quality-packaging, how-we-export, export-markets, contact, request-quote)
  views/components/            (Picture, ImagePlaceholder, PageBanner, SectionHeading, ProductCard)
  css/app.css                  (brand tokens, responsive component styles, motion)
  js/app.js, js/animations.js, js/smooth-scroll.js
routes/web.php
docs/

## Conventions
- Routes: / , /about-us, /products, /products/category/{slug}, /products/{slug}, /certification, /how-we-export, /export-markets, /contact-us, /request-a-quote
- One controller per page group, thin controllers, logic in services/models/scopes.
- Colors only via tokens: Tailwind `primary`, `secondary`, `accent`, etc. mapped to CSS variables; fallback palette values live only in `resources/css/app.css`.
- Business info only via `$site` / `setting()`.
- Static optimized images via <x-picture>; uploaded product/category media uses the media library and generated conversions. Temporary design placeholders use <x-image-placeholder>. (Video deferred.)
- Page JS loaded per page, not globally, when heavy. Reduced-motion preferences are respected by scroll, reveal, hover, and page-transition effects.
- Git: feature/<phase>-<short-name>, PR into develop, tag releases.

## Supplied design reference
- The composite mockup supplied on 2026-11-02 is the visual reference for the shared shell and all depicted public pages, including Quality & Packaging.
- Original photography and individual responsive frames were not included. `x-image-placeholder` marks image slots that must be replaced with approved photos; do not treat the gradient placeholders as final artwork.
- Phase 6 added canonical/Open Graph URL metadata, a single semantic H1 on product detail, progressive enhancement that keeps content visible when JavaScript fails, reduced-motion-safe reveal hooks, and Escape-key handling for the mobile menu.
- Responsive layouts are implemented from the composite. The 77 route/viewport technical smoke checks passed, but final side-by-side visual review and Lighthouse checks remain pending until approved assets and individual responsive frames are supplied; see `PAGE_WORKFLOW.md`.
- Phase 7 adds dynamic `robots.txt` and `sitemap.xml` endpoints, Organization/Product JSON-LD, branded 404/500 views, and baseline browser security headers. Production indexing, device/accessibility/performance QA, complete security review, and host-dependent upload stress testing remain open in `PHASES.md`.
