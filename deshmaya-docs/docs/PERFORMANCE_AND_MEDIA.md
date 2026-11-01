# Performance, Media and Animation Rules

## Targets
Lighthouse mobile >= 90, LCP < 2.5s, CLS < 0.1, INP < 200ms, page weight < 1.5MB excluding lazy media.

## Images (HD/4K ready)
- Accept up to 4K originals; generate WebP (+ AVIF only if server supports it) + fallback at widths 480/768/1024/1440/1920/2560.
- <x-picture> outputs <picture>, srcset, sizes, width/height (no CLS), lazy + async decode.
- Hero/LCP image: eager, fetchpriority=high, preloaded.
- Blur-up or dominant color placeholder.

## Video
Deferred, not in v1. Keep layouts flexible so a lazy-loaded video component can be added later.

## Frontend
- Self-host fonts, woff2, font-display swap, preload main font, subset.
- Tailwind purge, code-split page JS, defer scripts, no jQuery.
- Animate only transform/opacity, will-change used sparingly.
- Lenis smooth scroll; disable on touch if it hurts performance.
- prefers-reduced-motion disables heavy motion.
- Hover effects wrapped in @media (hover:hover).

## Backend
- OPcache, route/config/view cache, eager loading (no N+1), DB indexes.
- Cache settings, menus, product lists (file/database cache); HTTP cache headers via .htaccess; gzip/brotli.
- Queue image conversion and mail through database queue + cron.

## Loader
Simple logo loader, under ~1s typical, never blocks past max_ms, no layout shift on exit.
