# Admin Dashboard Spec (Filament)

Filament resources: Category, Product, ContactMessage, QuoteRequest.
Filament custom settings pages: Brand Colors, Business and Connect Info, Loader, SEO.
Dashboard widgets: new messages count, new quotes count, latest submissions.

Contact and quote submissions are stored in their respective resources. Admins can search by submitter and submission details, filter by status and received date, inspect full records, update their status, delete individual or bulk selections, and export the filtered results as CSV. Exported visitor-provided text is protected against spreadsheet formula execution.

Public forms use Cloudflare Turnstile. Set `TURNSTILE_SITE_KEY` and `TURNSTILE_SECRET_KEY` in the application environment; production submissions fail closed if verification is unavailable or either key is missing. For local development and automated tests only, Turnstile verification is optional when both keys are unset. Configure the admin recipient under Business & Connect Info → Mail; `MAIL_FROM_ADDRESS` is the fallback recipient. Notifications and CSV exports use the configured queue and require the queue worker/cron to be running.

## Settings groups and keys

brand: primary, primary_dark, secondary, accent, background, surface, text, text_muted, border, success, danger (all hex)
general: site_name, tagline, logo, logo_dark, favicon, footer_text, copyright_text
contact: phone_primary, phone_secondary, whatsapp, email_primary, email_secondary, address, map_embed, working_hours
social: facebook, instagram, linkedin, youtube, x, tiktok (blank = hidden on site)
loader: enabled, image, background_color, min_ms, max_ms
seo: default_title, default_description, og_image, google_analytics_id, meta_pixel_id
mail: notification_email, from_name

## Admin bootstrap

Set `ADMIN_SEED_NAME`, `ADMIN_SEED_EMAIL`, and `ADMIN_SEED_PASSWORD` in the local or production environment, then run `php artisan db:seed --class=AdminUserSeeder`. The seeder intentionally creates no account when either credential is blank; never commit real credentials. Re-running it updates the named account from the configured values.

## Brand color system (how "change once, updates everywhere" works)

1. Admin saves hex values in settings(group=brand).
2. Layout head prints: <style>:root{--color-primary: R G B; ...}</style> (RGB channels, so opacity utilities work).
3. tailwind.config maps primary: 'rgb(var(--color-primary) / <alpha-value>)' etc.
4. Templates/CSS use only tokens (bg-primary, text-secondary, border-accent). Hex in code is forbidden.
5. Cache the generated style block; bust on save.
6. Dev check: `grep -rE "#[0-9a-fA-F]{3,8}" resources/views resources/css` must return only the token defaults file.
7. Admin form shows live preview and validates contrast (warn if text/background contrast is poor).

## Business info system

- Single SettingService; `setting('contact.phone_primary')`; all views get `$site`.
- Header, footer, contact page, quote page, schema markup, emails all read from it.
- Empty value = element hidden automatically (no blank icons).

## Loader

Public layout renders loader with admin image; JS hides on window load or max_ms; session-based "show once" optional (D-05).

## Submissions

List columns: date, name, email/phone, status. Filters: status, date. Search. Bulk delete. CSV export. Detail view with reply-by-email link.
