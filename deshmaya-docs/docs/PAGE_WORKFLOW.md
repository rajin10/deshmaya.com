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

## Pending visual references

- Supply individual page/section design frames for desktop, laptop/tablet, and mobile breakpoints (or specify the exact widths represented by each frame).
- Confirm fonts, exact copy, spacing, crop/focal point, logo variants, and any map/certification artwork not discernible from the composite.
- After receipt, record reference filenames/links, review date, viewport, differences found, fixes, and approval for each page in the sign-off table below.

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

## Per-page Definition of Done
- [ ] Matches supplied page design on mobile, tablet, laptop, desktop (requires responsive frames)
- [ ] Uses brand tokens only, business info from settings
- [ ] Approved images use <x-picture>, with appropriate loading priority and alt text
- [ ] Animations/hover smooth, reduced-motion safe
- [ ] SEO title/description/OG set
- [ ] Lighthouse mobile >= 90 after final assets
- [ ] No console errors, keyboard focus visible; keyboard interaction verified
- [ ] Progress files updated and visual sign-off recorded above
