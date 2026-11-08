# Hostinger Shared Hosting: deshmaya.com

This checklist is tailored to Hostinger shared hosting with DNS managed at Hostinger. It covers the Laravel application in the repository's `deshmaya/` directory and keeps application code and secrets outside the public web root. Confirm that the selected shared plan supports the required PHP version, SSH/Terminal, document-root, cron, and database options before changing the live site.

## 1. Check the hosting plan first

In hPanel, confirm:

- The website is attached to the shared hosting plan and supports PHP 8.3 or later within PHP 8.x and Laravel's required PHP extensions. The project requires PHP `^8.3` (PHP 8.3 through 8.x, not PHP 9); verify the installed runtime with `php -v` and `composer check-platform-reqs --no-dev`.
- A MySQL/MariaDB database and database user can be created.
- SSH/Terminal or another supported way to run Composer and Artisan commands is available.
- The domain's document root can point to the Laravel app's `public/` directory. If it cannot, use the protected-web-root fallback below.
- A cron-job feature is available for processing queued email notifications.

Do not share hPanel, registrar, SSH, database, SMTP, or GitHub passwords or tokens in chat or commit them to the repository.

## 2. Prepare a release

From the Laravel application directory (`deshmaya/`), run locally:

```sh
npm ci
npm run build
```

Upload the application source to a private directory on the host. The generated `public/build/` directory is ignored by Git, so include it in the upload. Do not upload `.env`, `.git`, `node_modules/`, `public/hot`, or Windows-built `vendor/`. If `public/hot` exists from an earlier development run on the server, remove that exact file before serving production traffic. On the host, install PHP dependencies for its Linux/PHP runtime:

```sh
cd /path/to/private/deshmaya
composer install --no-dev --optimize-autoloader --no-interaction
```

If the plan does not provide SSH/Terminal, arrange a Linux-compatible release build for PHP dependencies before uploading; do not substitute the local Windows `vendor/` directory.

## 3. Keep the Laravel application private

Recommended layout:

```text
/home/ACCOUNT/deshmaya/                 # Laravel application, .env, vendor, storage
/home/ACCOUNT/domains/deshmaya.com/public_html/  # Not used as the app root
```

Set the domain's document root in hPanel to `/home/ACCOUNT/deshmaya/public` (use the actual account path shown by Hostinger). Only Laravel's `public/` directory should be web-accessible.

If the plan does not allow changing the document root, keep the Laravel application outside `public_html`, copy the *contents* of its `public/` directory into `public_html`, and edit `public_html/index.php` so the maintenance file, `vendor/autoload.php`, and `bootstrap/app.php` all point to the private Laravel application directory. Preserve Laravel's `public/.htaccess`. Never put `.env`, `vendor/`, `storage/`, or the full application in `public_html`.

## 4. Create production settings

Create a new `.env` on the host from `.env.example`; do not upload the office/local `.env`. Set the following values using the database and mail details shown in hPanel:

```dotenv
APP_NAME="Deshmaya"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://deshmaya.com

DB_CONNECTION=mysql
DB_HOST=HOSTINGER_DATABASE_HOST
DB_PORT=3306
DB_DATABASE=HOSTINGER_DATABASE_NAME
DB_USERNAME=HOSTINGER_DATABASE_USER
DB_PASSWORD=HOSTINGER_DATABASE_PASSWORD

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=database
FILESYSTEM_DISK=public

MAIL_MAILER=smtp
MAIL_HOST=HOSTINGER_SMTP_HOST
MAIL_PORT=HOSTINGER_SMTP_PORT
MAIL_SCHEME=HOSTINGER_SMTP_SCHEME
MAIL_USERNAME=HOSTINGER_MAILBOX
MAIL_PASSWORD=HOSTINGER_MAILBOX_PASSWORD
MAIL_FROM_ADDRESS=VERIFIED_SENDER_ADDRESS
MAIL_FROM_NAME="${APP_NAME}"
```

Replace every `HOSTINGER_*` and sender placeholder with the exact values from hPanel. Use the SMTP scheme/port pair Hostinger provides (commonly `smtps` with port `465`, or `smtp` with port `587`). Configure a real sender mailbox: contact and quote submissions queue email notifications.

Set a strong, unique `APP_KEY` once by running `php artisan key:generate` on the host after creating `.env`. Keep the same key on future releases; changing it invalidates encrypted data and active sessions. Restrict `.env` to the account owner and make `storage/` and `bootstrap/cache/` writable by the PHP process.

## 5. Initialize and verify Laravel

From the private application directory:

```sh
php artisan migrate --force
php artisan db:seed --class=SettingsSeeder --force
php artisan storage:link
php artisan optimize
```

Do not run the full `db:seed` command on production: it also seeds sample catalog data and may create an administrator from seed environment values. Create the first administrator interactively instead:

```sh
php artisan make:filament-user
```

If `storage:link` is not permitted by the plan, ask Hostinger support about symlinks before exposing uploaded media. Do not make the entire `storage/` directory public.

## 6. Process queued notifications

Contact and quote notifications use Laravel's database queue. Add a cron job to run every minute, using the account's actual PHP binary and private application path:

```sh
cd /home/ACCOUNT/deshmaya && /usr/bin/php artisan queue:work --stop-when-empty --max-time=50 --tries=3
```

Replace `/usr/bin/php` with the PHP CLI path provided by the plan. If the plan does not support cron or a persistent queue worker, confirm an appropriate queue option before launch; otherwise submissions may save without their queued email notification being delivered.

## 7. Connect the domain only after staging checks

1. Preview the site on a Hostinger temporary URL or staging subdomain first.
2. Verify the homepage, product/media pages, `/admin` login, contact and quote form submissions, storage-backed uploads, and delivery of queued email.
3. Confirm `APP_DEBUG=false`, HTTPS, and that requests for `/.env` and `/vendor/` do not expose files.
4. Take a database and uploaded-media backup.
5. Since DNS is already managed at Hostinger, do not change nameservers. Check the current zone and the web-hosting target shown in hPanel; only update the apex and `www` web records if they do not already point to this hosting plan. Preserve MX, SPF, DKIM, and other mail-related records.
6. Wait for DNS to resolve to Hostinger, enable the SSL certificate, and verify both `https://deshmaya.com` and `https://www.deshmaya.com`.

Do not delete existing DNS records or change nameservers. If the zone does not show the hosting plan's expected web target, confirm the exact values with hPanel/Hostinger support before updating it.

## Release checklist

- [ ] Shared plan confirmed to support PHP 8.3+, required extensions, database, CLI, document root, and cron
- [ ] Frontend build uploaded, including `public/build/`
- [ ] Production `.env` created privately; debug disabled; APP_KEY generated and retained
- [ ] Production database migrated; settings seeded; initial admin created interactively
- [ ] `storage:link` and writable Laravel runtime directories verified
- [ ] Queued notifications tested with production SMTP and cron
- [ ] Staging checks and backups completed before DNS changes
- [ ] Hostinger DNS records applied without disrupting existing email records
- [ ] HTTPS and both domain variants verified
