<header class="site-header" x-data="{ open: false }">
    <div class="container-shell site-header__inner">
        <a href="{{ route('home') }}" class="brand-lockup" aria-label="{{ setting('general.site_name', 'Deshmaya') }} home">
            @if($logo = setting_url('general.logo'))
                <img src="{{ $logo }}" alt="{{ setting('general.site_name', 'Deshmaya') }}" class="brand-lockup__image" width="172" height="48">
            @else
                <span class="brand-lockup__mark" aria-hidden="true">D</span>
                <span class="brand-lockup__text"><strong>{{ setting('general.site_name', 'Deshmaya') }}</strong><small>Global Agri Exporter</small></span>
            @endif
        </a>

        <nav class="site-nav" aria-label="Main navigation">
            @foreach(config('site.menu') as $item)
                @if($item['enabled'] && $item['route'])
                    <a href="{{ route($item['route']) }}" @class(['site-nav__link', 'is-active' => request()->routeIs($item['route'])]) @if(request()->routeIs($item['route'])) aria-current="page" @endif>{{ $item['label'] }}</a>
                @endif
            @endforeach
        </nav>

        <a href="{{ route('request-quote') }}" class="button button--header">Request a Quote <span aria-hidden="true">→</span></a>
        <button class="site-menu-toggle" type="button" @click="open = !open" :aria-expanded="open.toString()" aria-controls="mobile-navigation" :aria-label="open ? 'Close menu' : 'Open menu'">
            <span></span><span></span><span></span>
        </button>
    </div>

    <nav id="mobile-navigation" class="mobile-nav" x-show="open" x-cloak x-transition @click.outside="open = false" @keydown.escape.window="open = false" aria-label="Mobile navigation">
        @foreach(config('site.menu') as $item)
            @if($item['enabled'] && $item['route'])
                <a href="{{ route($item['route']) }}" @click="open = false" @class(['mobile-nav__link', 'is-active' => request()->routeIs($item['route'])])>{{ $item['label'] }}</a>
            @endif
        @endforeach
        <a href="{{ route('request-quote') }}" class="button button--primary mobile-nav__cta" @click="open = false">Request a Quote <span aria-hidden="true">→</span></a>
    </nav>
</header>
