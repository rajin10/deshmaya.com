# Page Build and Visual QA Workflow (repeat for every page in Phase 6)

Order: Home -> About -> Products -> Single Product -> Certification -> Quality & Packaging -> How We Export -> Export Markets -> Contact -> Request a Quote.

## Steps
1. Use the supplied mockup as the visual reference. Before final sign-off, collect approved image assets, map artwork, fonts, and responsive frames for the page.
2. Break page into sections; list dynamic data (what comes from admin/DB, what is static).
3. Export optimized assets; upload via media pipeline. If an approved asset is unavailable, retain the labeled placeholder and record it below; do not substitute unrelated imagery.
4. Build route, controller, Blade view, section partials.
5. Style to match design using tokens only.
6. Add animations and hover effects (listed per section).
7. Technical responsive smoke pass at 360/390/768/1024/1280/1440/1920; after delivery, repeat visual comparison at every supplied design frame.
8. Performance pass (Lighthouse, image sizes, CLS) after final assets are in place.
9. Compare side-by-side with each supplied design frame, record gaps, fix them, and obtain page sign-off.
10. Update PHASES.md and PROGRESS_LOG.md; commit and tag.

## Phase 6 status (2026-11-02)

- Implemented all listed public pages and dynamic product/category routes from the supplied composite mockup.
- Technical smoke audit passed for 11 route variants at seven viewport widths (77 checks): HTTP 200, no horizontal overflow, exactly one H1, canonical and `og:url` metadata on every route, and no browser-console errors.
- Mobile navigation was checked: it opens and closes with Escape.
- Full automated suite: 37 tests, 230 assertions passed. Production asset build and targeted Pint check passed.
- This is not visual sign-off. The composite mockup is insufficient to compare responsive design pixel-for-pixel, and all labeled placeholders below must remain until approved assets arrive.

## Pending asset register

Provide approved/licensed originals and identify the intended page/slot. Keep original files; do not replace them with generated or unrelated stock images.

| Page/slot | Asset needed | Current state |
|---|---|---|
| Shared brand | Final logo and favicon, if different from the current configured/default brand treatment | Confirm/replace if supplied |
| Home hero | Bangladesh produce field and harvest | Placeholder |
| Home category cards | Approved image for each displayed product category | Placeholder |
| Home grower feature | Bangladesh farm and grower | Placeholder |
| Home export feature | Export-ready produce shipment | Placeholder |
| About Us feature | Farmer selecting fresh produce | Placeholder |
| Product listing cards | Approved photo for each product; category images as needed | Placeholder when product media is absent |
| Product detail | Main product photo and gallery images per product | Placeholder when product media is absent |
| Certification banner | Approved certification/quality image, if present in final visual | Placeholder banner treatment |
| Quality & Packaging | Approved process photo for each displayed stage | Placeholder |
| How We Export | Bangladesh export shipment | Placeholder |
| Export Markets banner | Approved market/route image, if present in final visual | Placeholder banner treatment |
| Contact Us | Approved map artwork or confirmed location/map embed requirements | Map placeholder |
| Request a Quote | Fresh export produce | Placeholder |

## Recommended image handoff checklist

The dimensions below are recommended source sizes based on the current layout, not final pixel-perfect crop specifications. Individual responsive design frames have not been supplied yet, so keep the main subject away from the edges and allow `cover` crops. Provide licensed originals; do not create or imply certifications Deshmaya does not hold.

### Fixed page photography and artwork

Place these source files under `deshmaya/resources/images/` using the exact lowercase filenames shown. Static images are not wired into the page placeholders yet; after delivery, connect each asset to its page, build responsive variants, and run visual QA.

| Page/section | Source filename (relative to `resources/images/`) | Recommended source size |
|---|---|---:|
| Home hero, desktop | `home/hero-harvest.jpg` | 2560 x 1440 |
| Home hero, optional mobile crop | `home/hero-harvest-mobile.jpg` | 1080 x 1440 |
| Home grower feature | `home/farmer-grower.jpg` | 1920 x 1440 |
| Home export feature | `home/export-shipment.jpg` | 1920 x 1440 |
| About Us banner | `banners/about.jpg` | 2560 x 900 |
| About Us feature | `about/farmer-selecting-produce.jpg` | 1920 x 1440 |
| Products listing banner | `banners/products.jpg` | 2560 x 900 |
| Product detail banner (shared by product detail pages) | `banners/product-detail.jpg` | 2560 x 900 |
| Certification banner | `banners/certifications.jpg` | 2560 x 900 |
| Quality & Packaging banner | `banners/quality-packaging.jpg` | 2560 x 900 |
| Quality process: Sorting | `quality/sorting.jpg` | 1600 x 1200 |
| Quality process: Grading | `quality/grading.jpg` | 1600 x 1200 |
| Quality process: Cleaning | `quality/cleaning.jpg` | 1600 x 1200 |
| Quality process: Packing | `quality/packing.jpg` | 1600 x 1200 |
| How We Export banner | `banners/how-we-export.jpg` | 2560 x 900 |
| How We Export shipment feature | `export/shipment-promise.jpg` | 2560 x 1440 |
| Export Markets banner | `banners/export-markets.jpg` | 2560 x 900 |
| Export Markets map artwork | `maps/export-markets.svg` (preferred) or `.png` | SVG viewBox / PNG 1600 x 1000 |
| Contact Us banner | `banners/contact.jpg` | 2560 x 900 |
| Contact location artwork (only if not using an embedded map) | `maps/contact-location.png` | 1600 x 1000 |
| Request a Quote banner | `banners/request-quote.jpg` | 2560 x 900 |
| Request a Quote side feature | `quote/fresh-export-produce.jpg` | 1920 x 1440 |

Photos can be JPG, PNG, or WebP. The local image build generates AVIF/WebP variants at widths 480, 768, 1024, 1440, 1920, and 2560 pixels; a 4K master is welcome, but generated variants currently top out at 2560 pixels. Keep the focal subject clear of overlay text. For the home hero, the mobile crop is optional and needs responsive image wiring after the mobile design frame is confirmed.

### Images uploaded through the admin

These are dynamic media, not files to place in `resources/images/`. Keep the suggested names when handing them over, then upload them through the corresponding Filament admin form. Current upload limits are per file.

| Admin section | Suggested handoff filename | Recommended source size | Current limit |
|---|---|---:|---:|
| Business & Connect Info: light logo | `branding/logo-light.png` | 1200 x 340, transparent | 4 MiB |
| Business & Connect Info: dark logo | `branding/logo-dark.png` | 1200 x 340, transparent | 4 MiB |
| Business & Connect Info: favicon | `branding/favicon.png` | 512 x 512 | 4 MiB |
| Loader settings: image (optional; logo can be reused) | `branding/loader-logo.png` | 800 x 240, transparent | 4 MiB |
| SEO Defaults: Open Graph image | `branding/og-default.jpg` | 1200 x 630 | 8 MiB |
| Categories: one image per active category (currently Fruits and Vegetables) | `categories/<category-slug>.jpg` | 1920 x 1200 | 10 MiB |
| Products: one featured image for each real product | `products/<product-slug>-featured.jpg` | 2048 x 1536 | 10 MiB |
| Products: gallery, ideally five views per real product | `products/<product-slug>-gallery-01.jpg` through `-05.jpg` | 1600 x 1200 each | 10 MiB each; up to 20 files |

The admin creates responsive previews for category/product media (640 x 480). Use real, approved product photos and accurate alt text; do not use the sample catalog as a substitute for the final product list. If the Contact page should show a live map, provide the approved Google Maps embed URL instead of `maps/contact-location.png`; the current Contact template still needs to be wired to render the existing map setting.

### Shared file/quality notes

- The project source directory is `deshmaya/resources/images/`; static page photos do not appear automatically when copied there. They must be connected to the Blade sections and built before they display.
- Use descriptive filenames exactly as listed, lowercase with hyphens; keep a copy of each original.
- Admin upload limits are hard caps. For the best loading speed, compress photos before upload and keep files comfortably below those caps.
- `logo_dark` is available as an admin field, but the current header/footer templates have not yet been wired to select the matching logo variant. Hold both logo variants if convenient; use the standard `logo` until that display behavior is updated.
- Certification artwork is not required unless Deshmaya supplies genuine, currently valid certificates and approves their publication.

## Pending visual references

- Supply individual page/section design frames for desktop, laptop/tablet, and mobile breakpoints (or specify the exact widths represented by each frame).
- Confirm fonts, exact copy, spacing, crop/focal point, logo variants, and any map/certification artwork not discernible from the composite.
- After receipt, record reference filenames/links, review date, viewport, differences found, fixes, and approval for each page in the sign-off table below.
- Do not mark visual QA complete based only on the current 77 route/viewport smoke checks; they test rendering/overflow/metadata, not pixel fidelity.
- Once assets are added, rerun the smoke checks and production build. Lighthouse is deferred until final media is present so image weight/LCP results are representative.

| Page | Asset slots replaced | Responsive frames reviewed | Visual differences/fixes | Sign-off |
|---|---|---|---|---|
| Home | Pending | Pending | Pending | Pending |
| About Us | Pending | Pending | Pending | Pending |
| Products + category filter | Pending | Pending | Pending | Pending |
| Product detail | Pending | Pending | Pending | Pending |
| Certification | Pending | Pending | Pending | Pending |
| Quality & Packaging | Pending | Pending | Pending | Pending |
| How We Export | Pending | Pending | Pending | Pending |
| Export Markets | Pending | Pending | Pending | Pending |
| Contact Us | Pending | Pending | Pending | Pending |
| Request a Quote | Pending | Pending | Pending | Pending |

## Resume procedure

1. Map each supplied approved asset to a row in the asset register and add/reference the filenames; preserve originals and do not commit secrets or unlicensed imagery.
2. Replace the matching placeholders/media, run image processing, and verify dimensions, responsive crop/focal point, alt text, and loading priority.
3. For each page row, compare every provided viewport frame side-by-side; record viewport, differences, fixes, and approval.
4. Run Lighthouse mobile/desktop only after final imagery is in place; record scores and Core Web Vitals in the page sign-off notes.
5. Update `PHASES.md` and `PROGRESS_LOG.md`; leave any page without approved frames/assets visibly pending.

## Per-page Definition of Done
- [ ] Matches supplied page design on mobile, tablet, laptop, desktop (requires responsive frames)
- [ ] Uses brand tokens only, business info from settings
- [ ] Approved images use <x-picture>, with appropriate loading priority and alt text
- [ ] Animations/hover smooth, reduced-motion safe
- [ ] SEO title/description/OG set
- [ ] Lighthouse mobile >= 90 after final assets
- [ ] No console errors, keyboard focus visible; keyboard interaction verified
- [ ] Progress files updated and visual sign-off recorded above
