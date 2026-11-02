# Phases and Tracker

Status keys: [ ] todo, [~] in progress, [x] done. Mark ONE phase as CURRENT.
Backend phases (0-4) do not need page designs. Page phases (6.x) start only when that page's design is provided.

## Phase 0 - Planning and Setup

- [x] Review and approve PRD
- [x] Decisions D-01 to D-04, D-08 resolved (Filament, static pages, English only, cPanel, no video)
- [ ] Confirm default choices for D-05, D-06, D-07, D-09 in DECISIONS.md
- [ ] Confirm cPanel PHP version (8.2+ needed), extensions (intl, zip, gd/imagick), SSH/terminal access, cron access
- [ ] Collect assets: logo (svg), favicon, brand color list, fonts, design files access
- [ ] Create Git repo, branch strategy (main, develop, feature/\*)
      DoD: PRD approved, decisions resolved, cPanel capabilities confirmed, repo ready.

## Phase 1 - Foundation

- [x] Fresh Laravel install, PHP/Node versions pinned
- [x] Tailwind + Vite + Alpine setup (assets built locally, built files committed/uploaded; no Node on server)
- [x] Install Filament admin panel
- [x] .env.example, config cleanup, timezone, app name
- [ ] Code style (Pint), basic CI check (optional)
- [x] Settings system: settings table, Setting service, setting() helper, cache + bust
- [x] View composer sharing $site (business info) to all views
- [x] Brand color pipeline: CSS variables injected in layout, Tailwind tokens mapped to variables
- [x] Media pipeline: library installed, WebP (AVIF if server supports) + responsive sizes, <x-picture> component
- [x] Queue set to database driver, processed by cPanel cron (no Redis)
- [x] Base layout: head/SEO partial, header/footer shells, loader shell, smooth scroll, animation utilities
      DoD: changing a setting in DB changes layout output; a test image renders responsive and lazy.

## Phase 2 - Admin Core

- [x] Admin auth + seeded super admin (account created locally; credentials remain untracked)
- [x] Admin layout/navigation
- [x] Brand Colors page (live preview, reset default)
- [x] Business & Connect Info page (grouped tabs)
- [x] Loader settings (image upload, toggle, bg color, min time)
- [x] SEO defaults
      DoD: editing colors/business info/loader in admin updates the front layout with no code change.

## Phase 3 - Catalog

- [x] categories migration/model/admin CRUD + reorder
- [x] products migration/model/admin CRUD (gallery, specs, SEO, featured)
- [x] Slug handling, soft deletes, validation
- [x] Seeders with sample categories/products
      DoD: admin can add/edit/delete categories and products; data available through query scopes.

## Phase 4 - Forms and Submissions

- [x] contact_messages + quote_requests tables/models
- [x] Form request validation, honeypot, throttle, captcha
- [x] Mail notification to admin (queue)
- [x] Admin lists: search, filter, status, view, delete, CSV export
- [x] Dashboard home: counts of new messages/quotes and latest submissions
      DoD: submitted data shows in admin; spam protections tested.

## Phase 5 - Frontend Shell and Components

- [x] Final header/footer from supplied mockup (dynamic business data)
- [x] Loader styling using the configured brand palette and logo
- [x] Shared components/styles: buttons, section headings, product cards, category chips, form fields, CTA bands
- [x] Animation kit: scroll reveal, hover effects, smooth scrolling, reduced-motion support, page transitions
      DoD: shell matches design at all breakpoints; components documented in ARCHITECTURE.md.

## Phase 6 - Pages (CURRENT - mockup implemented; photography and visual QA pending)

- [~] 6.1 Home
- [~] 6.2 About Us
- [~] 6.3 Our Products (listing + category filter)
- [~] 6.4 Dynamic Single Product
- [~] 6.5 Certification
- [~] 6.6 How We Export
- [~] 6.7 Export Markets
- [~] 6.8 Contact Us
- [~] 6.9 Request a Quote
- [~] Quality & Packaging (additional page shown in the supplied mockup)
      DoD per page: PAGE_WORKFLOW.md checklist fully ticked.
      Note: The supplied design is a single composite image. Layouts are implemented from it; labeled photo placeholders remain until original photography is supplied. Responsive and page-by-page visual comparison is still pending.

## Phase 7 - Performance, QA, SEO

- [ ] Lighthouse mobile/desktop >= targets on every page
- [ ] Cross-device test matrix (iOS Safari, Android Chrome, desktop browsers)
- [ ] Accessibility pass, contrast check against brand colors
- [ ] Sitemap, robots, schema, 404/500 pages
- [ ] Security pass (headers, upload rules, admin hardening)
- [ ] 4K image upload stress test via admin (check PHP memory_limit and upload size on cPanel)
      DoD: all targets in PRD section 8 met.

## Phase 8 - Deployment and Handover

- [ ] cPanel setup per docs/DEPLOYMENT_CPANEL.md (PHP version, document root, .env, DB, storage link)
- [ ] Cron for scheduler and queue, SMTP mail via cPanel
- [ ] HTTPS (AutoSSL), optional Cloudflare for CDN/caching
- [ ] Production build uploaded, route/config/view cache
- [ ] Backups + monitoring
- [ ] Admin guide (short) + credentials handover
      DoD: live, backed up, client can operate admin alone.
