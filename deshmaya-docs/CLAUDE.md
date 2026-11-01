# Project context for AI assistants
Project: Deshmaya.com - Laravel website + admin dashboard, built to match supplied designs exactly.
Read docs/PRD.md and docs/PHASES.md first. Work only on the current phase (marked CURRENT in PHASES.md).

Stack: Laravel, Blade, Tailwind, Alpine, Filament admin, cPanel hosting (database queue + cron, no Redis, no Node on server). English only. Home/About/Certification/Export pages are static Blade. No video in v1.

Hard rules:
- No hardcoded colors. Use Tailwind tokens backed by CSS variables (brand settings).
- No hardcoded business info (phone, email, address, social, logo). Use setting('group.key') / $site.
- All images via the media pipeline (WebP/AVIF + srcset + lazy). No raw <img> with huge originals.
- Every page: responsive (mobile/tablet/laptop/desktop), respects prefers-reduced-motion, passes Lighthouse targets in docs/PERFORMANCE_AND_MEDIA.md.
- Design is the source of truth. If unsure, ask; do not invent layout.
- After each session append to docs/PROGRESS_LOG.md and tick boxes in docs/PHASES.md.
