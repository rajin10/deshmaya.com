# Page Build Workflow (repeat for every page in Phase 6)

Order: Home -> About -> Products -> Single Product -> Certification -> Quality & Packaging -> How We Export -> Export Markets -> Contact -> Request a Quote.

## Steps
1. Use the supplied mockup as the visual reference. Confirm fonts, spacing, approved image assets, and responsive frames when available.
2. Break page into sections; list dynamic data (what comes from admin/DB, what is static).
3. Export optimized assets; upload via media pipeline. If source photography is unavailable, retain the labeled placeholder and track the asset needed; do not substitute unrelated imagery.
4. Build route, controller, Blade view, section partials.
5. Style to match design using tokens only.
6. Add animations and hover effects (listed per section).
7. Responsive pass at 360/390/768/1024/1280/1440/1920.
8. Performance pass (Lighthouse, image sizes, CLS).
9. Compare side-by-side with design, fix gaps.
10. Update PHASES.md and PROGRESS_LOG.md; commit and tag.

The current supplied design is a single composite image. Desktop section layouts are based on that reference; confirm responsive details and replace every labeled photo placeholder when source assets are provided.

## Per-page Definition of Done
- [ ] Matches design on mobile, tablet, laptop, desktop
- [ ] Uses brand tokens only, business info from settings
- [ ] Images via <x-picture>, lazy where needed
- [ ] Animations/hover smooth, reduced-motion safe
- [ ] SEO title/description/OG set
- [ ] Lighthouse mobile >= 90
- [ ] No console errors, keyboard focus visible
- [ ] Progress files updated
