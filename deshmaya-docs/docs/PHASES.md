# Phases and Tracker

Status keys: [ ] todo, [~] in progress, [x] done. Mark ONE phase as CURRENT.
Backend phases (0-4) do not need page designs. Phase 6 implementation may use the supplied composite mockup; page-level visual sign-off requires approved assets and responsive references.

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

## Phase 6 - Pages (implementation and responsive smoke audit done; final visual QA pending)

- [x] 6.1 Home implementation
- [x] 6.2 About Us implementation
- [x] 6.3 Our Products implementation (listing + category filter)
- [x] 6.4 Dynamic Single Product implementation
- [x] 6.5 Certification implementation
- [x] 6.6 How We Export implementation
- [x] 6.7 Export Markets implementation
- [x] 6.8 Contact Us implementation
- [x] 6.9 Request a Quote implementation
- [x] Quality & Packaging implementation (additional page shown in the supplied mockup)
- [x] Route/viewport smoke audit: 11 public route variants x 7 widths (360, 390, 768, 1024, 1280, 1440, 1920); all HTTP 200, no horizontal overflow, one H1 and canonical/OG URL metadata per route, no browser-console errors
- [x] Mobile menu interaction check, including Escape-to-close
- [~] Replace all image placeholders with approved assets; asset locations and page-by-page slots are tracked in PAGE_WORKFLOW.md
- [~] Compare each page/section against supplied visuals at each provided responsive frame; record gaps and sign-off in PAGE_WORKFLOW.md
      DoD per page: implementation and technical smoke checks are complete; PAGE_WORKFLOW.md visual/assets checklist must be completed after assets and responsive references are supplied.
      Note: Current reference is one composite image. No approved original photography, map artwork, or individual responsive frames were available; placeholders remain intentional and are not final artwork.

## Phase 7 - Performance, QA, SEO (CURRENT - started; see open work below)

- [ ] Lighthouse mobile/desktop >= targets on every page
- [ ] Cross-device test matrix (iOS Safari, Android Chrome, desktop browsers)
- [ ] Accessibility pass, contrast check against brand colors
- [~] Sitemap, robots, schema, 404/500 pages (dynamic sitemap and robots, Organization/Product JSON-LD, and branded 404/500 views implemented and feature-tested; validate production URL/indexing behavior before completion)
- [~] Security pass (baseline response headers added; review upload rules and admin hardening remains)
- [ ] 4K image upload stress test via admin (check PHP memory_limit and upload size on cPanel)
      DoD: all targets in PRD section 8 met.
      Phase 6 dependency: approved photography and responsive design frames are still needed for final visual sign-off and meaningful image-weight/Lighthouse validation. Phase 7 has started in parallel by request; Phase 6 remains open.
      Remaining QA includes Lighthouse on every page after final media, iOS/Android/desktop browser matrix, keyboard/screen-reader/contrast checks, production sitemap/schema checks, security review, and cPanel 4K upload stress test using confirmed server limits.
      Current validation: 41 tests / 266 assertions pass; production asset build and targeted Pint pass. No source images were present, so the build optimized 0 images; this is not a Lighthouse result.
      Local browser audit after Phase 7: 13 public route variants x 8 widths (360, 390, 768, 1024, 1280, 1440, 1920, 2560) = 104 checks; all HTTP 200, exactly one H1, no horizontal overflow or unnamed links/buttons/placeholders. All 26 unique internal URLs returned successfully; desktop nav links, product/category/quote CTA, mobile menu + Escape, form required-field blocking/labels, robots/sitemap, Product/Organization schema, and branded 404 were checked. This is a local Chromium smoke check, not cross-device, visual, Lighthouse, or production sign-off.
      Local HTTP responses include `X-Powered-By: PHP/8.3.36`; verify/suppress this server-level header in production. HSTS is intentionally absent over local HTTP and still needs verification on the real HTTPS host.
      Existing upload limits found: category/product media 10 MiB per file (gallery up to 20 files), logo/favicon/loader 4 MiB, and Open Graph image 8 MiB. Confirm these against cPanel PHP/web-server limits and the approved 4K originals before the upload stress test.

## Phase 8 - Deployment and Handover

- [ ] cPanel setup per docs/DEPLOYMENT_CPANEL.md (PHP version, document root, .env, DB, storage link)
- [ ] Cron for scheduler and queue, SMTP mail via cPanel
- [ ] HTTPS (AutoSSL), optional Cloudflare for CDN/caching
- [ ] Production build uploaded, route/config/view cache
- [ ] Backups + monitoring
- [ ] Admin guide (short) + credentials handover
      DoD: live, backed up, client can operate admin alone.

## Resume checklist (next work session)

Do not treat the started Phase 7 code as complete or production-ready. Current Phase 7 changes are uncommitted unless a later progress entry says otherwise. Keep secrets out of Git and documentation.

### First: finish Phase 6 visual sign-off

1. Collect approved/licensed photos for each slot in `PAGE_WORKFLOW.md`, final logo/favicon, and map/certification artwork or written confirmation that none is required.
2. Supply individual responsive design frames for all ten public page groups; specify each frame's target viewport and confirm fonts, copy, image crop/focal point, and branding.
3. Replace placeholders, optimize/process images, verify alt text and responsive crops, then run the route/viewport smoke audit again.
4. Compare each page against its supplied frames, record issues/fixes and approvals in the `PAGE_WORKFLOW.md` sign-off table.

### Then: finish Phase 7

1. Run automated tests, production asset build, Pint, and `git diff --check`; retain the current baseline of 41 tests / 266 assertions unless tests intentionally change.
2. With the final media and production-like URL configured, run Lighthouse mobile and desktop on every public page and product/category route. Record Performance score and LCP, CLS, INP; meet PRD targets (Performance >= 90, LCP < 2.5s, CLS < 0.1, INP < 200ms). Fix and retest failures.
3. Verify `robots.txt`, XML sitemap syntax/content, canonical URLs, Organization/Product JSON-LD, OG images, and 404/500 behavior on staging/production-like host. Ensure sitemap contains only active public pages/products/categories and that its URLs use the canonical host.
4. Test current Chrome/Edge/Firefox and Safari where available, including iOS Safari and Android Chrome, at the relevant device sizes. Record browser/device/OS and failures.
5. Complete keyboard-only and screen-reader spot checks, visible focus, labels/errors, heading order, image alternatives, reduced-motion behavior, and WCAG AA text/UI contrast; record findings and fixes.
6. Review security end-to-end: headers/HSTS behind the actual HTTPS proxy, CSRF, form throttle/honeypot/captcha, admin auth/authorization/session behavior, upload validation (MIME/type/size), exposed files, dependency advisories, and error/debug leakage. Do not add a restrictive CSP until all required inline scripts and third-party integrations are inventoried and tested.
7. Before a 4K upload test, obtain cPanel PHP/web-server limits (`upload_max_filesize`, `post_max_size`, `memory_limit`, execution time), PHP extensions (GD/Imagick), disk quota, and queue/cron behavior. Current app limits: product/category media 10 MiB/file, gallery max 20 files, logo/favicon/loader 4 MiB, OG image 8 MiB. Confirm or deliberately revise these limits before testing representative 4K files through the admin and verifying conversions, queue completion, storage, and site stability.

### Finally: Phase 8 deployment/handover

1. Obtain the production domain, cPanel/PHP/database/SMTP configuration, notification address, Turnstile keys, admin account owner, and backup/monitoring contact through a secure channel; never commit secrets.
2. Follow `DEPLOYMENT_CPANEL.md`: provision document root and environment, deploy built assets, configure database/storage permissions, run reviewed migrations, and configure scheduler/queue cron.
3. Enable AutoSSL/HTTPS and verify canonical/sitemap URLs and HSTS on the real host; configure optional CDN only if approved.
4. Run production smoke checks for public pages, forms/mail queue, admin access, media uploads, sitemap/robots, 404/500, backups and restore procedure; confirm debug is disabled.
5. Deliver admin instructions and credentials securely, and obtain owner confirmation that they can manage products/settings and submissions.

### Inputs needed from the project owner

- Approved image files and page/slot mapping; responsive design frames and their target widths.
- Production domain and authorized staging/production access.
- cPanel PHP version/extensions/limits and available SSH/cron access.
- SMTP settings, Turnstile site/secret keys, admin notification email, and analytics/third-party requirements.
- Confirmation of sitemap indexing policy, map/embed choice, and who receives admin credentials.
