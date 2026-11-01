{{-- Phase 1 shell. Final design applied in Phase 5. --}}
<header class="sticky top-0 z-40 border-b border-line bg-page/90 backdrop-blur" x-data="{ open: false }">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            @if($logo = setting_url('general.logo'))
                <img src="{{ $logo }}" alt="{{ setting('general.site_name') }}" class="h-9 w-auto" height="36">
            @else
                <span class="font-heading text-xl text-primary-dark">{{ setting('general.site_name', 'Deshmaya') }}</span>
            @endif
        </a>
        <nav class="hidden items-center gap-6 text-sm lg:flex">
            @foreach(config('site.menu') as $item)
                @if($item['enabled'] && $item['route'])
                    <a href="{{ route($item['route']) }}" class="transition-colors hover:text-primary {{ request()->routeIs($item['route']) ? 'text-primary font-medium' : 'text-ink' }}">{{ $item['label'] }}</a>
                @endif
            @endforeach
        </nav>
        <div class="flex items-center gap-3">
            <a href="{{ route('request-quote') }}" class="hidden rounded-md bg-primary px-4 py-2 text-sm font-medium text-white transition hover:bg-primary-dark sm:inline-block">Request a Quote</a>
            <button class="lg:hidden" @click="open = !open" aria-label="Menu" :aria-expanded="open">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
            </button>
        </div>
    </div>
    <nav x-show="open" x-cloak x-transition class="border-t border-line bg-page px-4 py-3 lg:hidden">
        @foreach(config('site.menu') as $item)
            @if($item['enabled'] && $item['route'])
                <a href="{{ route($item['route']) }}" class="block py-2 text-ink">{{ $item['label'] }}</a>
            @endif
        @endforeach
        <a href="{{ route('request-quote') }}" class="mt-2 block rounded-md bg-primary px-4 py-2 text-center font-medium text-white">Request a Quote</a>
    </nav>
</header>
