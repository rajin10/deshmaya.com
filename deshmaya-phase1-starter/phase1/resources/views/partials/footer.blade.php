{{-- Phase 1 shell. Final design applied in Phase 5. Empty settings hide automatically. --}}
<footer class="bg-primary-dark text-white/85">
    <div class="mx-auto grid max-w-7xl gap-8 px-4 py-12 sm:px-6 md:grid-cols-3 lg:px-8">
        <div>
            <p class="font-heading text-2xl text-white">{{ setting('general.site_name', 'Deshmaya') }}</p>
            @if($t = setting('general.tagline'))<p class="mt-1 text-sm">{{ $t }}</p>@endif
            @if($f = setting('general.footer_text'))<p class="mt-4 text-sm">{{ $f }}</p>@endif
        </div>
        <div class="space-y-2 text-sm">
            @if($v = setting('contact.address'))<p>{{ $v }}</p>@endif
            @if($v = setting('contact.phone_primary'))<p><a href="tel:{{ preg_replace('/[^\d+]/', '', $v) }}" class="hover:text-white">{{ $v }}</a></p>@endif
            @if($v = setting('contact.email_primary'))<p><a href="mailto:{{ $v }}" class="hover:text-white">{{ $v }}</a></p>@endif
        </div>
        <div class="flex flex-wrap gap-4 text-sm">
            @foreach(['facebook','instagram','linkedin','youtube','x','tiktok'] as $s)
                @if($u = setting("social.$s"))<a href="{{ $u }}" target="_blank" rel="noopener" class="capitalize hover:text-white">{{ $s }}</a>@endif
            @endforeach
        </div>
    </div>
    <div class="border-t border-white/10 py-4 text-center text-xs">
        {{ setting('general.copyright_text') ?: '© '.date('Y').' '.setting('general.site_name', 'Deshmaya').'. All rights reserved.' }}
    </div>
</footer>
