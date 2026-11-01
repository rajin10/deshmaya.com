# cPanel Deployment Notes

## Check before starting (Phase 0)
- PHP 8.2+ selectable in cPanel (MultiPHP Manager); extensions: intl, zip, mbstring, gd or imagick, fileinfo, pdo_mysql, bcmath
- Filament requires intl and a recent PHP, verify first
- SSH/Terminal access (needed for composer, artisan). If no SSH: build vendor locally and upload
- Cron Jobs access, MySQL database creation, SMTP mailbox
- php.ini: memory_limit >= 256M, upload_max_filesize and post_max_size >= 32M (4K images)

## Structure
- Keep Laravel app outside public_html (e.g. /home/user/deshmaya), point domain document root to /home/user/deshmaya/public (or copy public/ contents into public_html and fix paths in index.php)
- Run php artisan storage:link (or symlink manually if blocked)

## Build and deploy
- Build assets locally: npm run build, upload public/build (no Node on server)
- composer install --no-dev --optimize-autoloader
- php artisan migrate --force, config:cache, route:cache, view:cache
- .env: APP_ENV=production, APP_DEBUG=false, QUEUE_CONNECTION=database, CACHE_STORE=file, SESSION_DRIVER=file/database

## Cron (every minute)
* * * * * cd /home/user/deshmaya && php artisan schedule:run >> /dev/null 2>&1
Queue: in schedule, run queue:work --stop-when-empty --max-time=50 every minute.

## Performance on cPanel
- Enable OPcache, gzip/brotli and cache headers in .htaccess
- Put Cloudflare (free) in front for CDN and caching, strongly recommended
- Back up DB + storage/app/public via cPanel backup or cron
