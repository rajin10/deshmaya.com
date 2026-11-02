# PRD - Deshmaya.com

## 1. Overview
Build the Deshmaya export business website in Laravel, matching the supplied design exactly, with an admin dashboard that controls brand colors, categories, products, business/contact info, loader, and all submitted form data.

## 2. Goals
- Exact design match on mobile, tablet, laptop, desktop.
- Very fast, smooth site (scroll, hover, touch) with polished animations.
- Everything business-related editable from admin, no code change needed.
- HD/4K image ready. Video support is deferred to a later phase.

## 3. Non-goals (v1)
- Online payment / cart / customer accounts.
- Multi-language (English only).
- Video (deferred, not in v1).
- Dynamic admin editing of Home/About text, Certification and Export Markets content (these are fixed in Blade).
- Public user registration.

## 4. Users
- Visitor / importer: browses products, checks certifications and export process, sends inquiry or quote request.
- Admin (business owner/staff): manages content and reads submissions.

## 5. Public pages
1. Home
2. About Us
3. Our Products (listing, category filter)
4. Dynamic Single Product (/products/{slug})
5. Certification
6. Quality & Packaging
7. How We Export
8. Export Markets
9. Contact Us
10. Request a Quote (supports prefilled product via ?product=slug)
Home, About Us, Certification, Quality & Packaging, How We Export, Export Markets text/content are fixed in Blade templates (not editable from admin). Products, categories, brand colors, business info, loader and form data are dynamic.
Global: header, footer, loader, 404/500, sitemap.xml, robots.txt, SEO meta + OpenGraph per page.

## 6. Admin dashboard modules
| Module | Requirements |
|---|---|
| Auth | Secure admin login, password reset, throttling |
| Brand Colors | Edit all theme colors in one place; changing one updates every use across the site instantly (CSS variables). Reset-to-default |
| Business & Connect Info | Business name, logo (light/dark), favicon, phone(s), WhatsApp, email(s), address, map embed, working hours, social links, footer text, SEO defaults. One change updates whole site |
| Loader | Upload loader logo/image, toggle on/off, background color, min display time |
| Categories | Add / edit / update / delete, reorder, active toggle, image, SEO |
| Products | Add / edit / update / delete, category, gallery, specs, featured, active, SEO, slug |
| Contact Messages | List, search, filter by status, view, mark read/replied, delete, export CSV |
| Quote Requests | Same as above plus product, quantity, country |

## 7. Functional requirements
- FR-1 Brand colors stored in DB, injected as CSS variables in layout; zero hardcoded hex in templates/CSS.
- FR-2 Business info read through one settings service, cached, cache cleared on save.
- FR-3 Product/category CRUD with soft delete and slug auto-generation (unique).
- FR-4 Contact and quote forms: server validation, honeypot + rate limit + captcha (Turnstile/reCAPTCHA), saved to DB, admin email notification, success/error UX.
- FR-5 Single product page pulls all data dynamically, related products, "Request a quote" button prefilled.
- FR-6 Loader shows logo from admin, hides when page ready, never blocks longer than the configured max.
- FR-7 Image upload auto-generates WebP/AVIF + multiple widths; originals up to 4K accepted.
- FR-8 (Deferred) Video support is out of v1; layout should not block adding it later.

## 8. Non-functional requirements
- Performance: Lighthouse mobile >= 90 Performance, LCP < 2.5s, CLS < 0.1, INP < 200ms.
- Smoothness: 60fps animations, only transform/opacity animated, smooth scroll, reduced-motion respected.
- Responsive: 360, 390, 768, 1024, 1280, 1440, 1920, 2560 widths verified.
- Accessibility: semantic HTML, alt text, focus states, contrast checked against brand colors.
- Security: CSRF, validation, escaped output, upload type/size checks, admin hardened, backups.
- SEO: meta, OG, schema (Organization, Product), sitemap, clean URLs.

## 9. Success criteria
- Every page visually matches design at all breakpoints.
- Admin can change colors/business info/products/categories and see changes live with no developer.
- All form submissions visible in admin.
- Performance targets met on production.

## 10. Assumptions / dependencies
- A composite final mockup for the shared shell and all public pages was supplied on 2026-11-02. Original photography and individual responsive frames are pending; until supplied, the site marks photo slots as temporary placeholders and responsive details are inferred from the composite.
- Hosting is cPanel (shared/VPS with cPanel). See docs/DEPLOYMENT_CPANEL.md.
- Admin panel is built with Filament.
- Open questions tracked in docs/DECISIONS.md.
