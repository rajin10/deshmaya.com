@extends('layouts.app')
@section('title', 'Fresh Produce from Bangladesh')
@section('description', 'Premium fruits, vegetables and agricultural products, responsibly sourced in Bangladesh and
    delivered to global markets.')
@section('content')
    <section class="section-shell home-produce-section" id="categories">
        <div class="container-shell">
            @if ($carouselProducts->isNotEmpty())
                <div class="produce-marquee" aria-label="Browse our produce">
                    <div class="produce-marquee__viewport">
                        <div class="produce-marquee__track"
                            style="--produce-marquee-duration: {{ max(22, $carouselProducts->count() * 4) }}s">
                            @for ($copy = 0; $copy < 2; $copy++)
                                <div class="produce-marquee__group"
                                    @if ($copy) aria-hidden="true" inert @endif>
                                    @foreach ($carouselProducts as $product)
                                        @php($productImage = $product->getAvailableMediaUrl())
                                        <a class="produce-marquee__item" href="{{ route('products.show', $product->slug) }}">
                                            <span class="produce-marquee__media">
                                                @if ($productImage)
                                                    <img class="produce-marquee__image" src="{{ $productImage }}"
                                                        alt="{{ $product->name }}" loading="lazy" decoding="async"
                                                        data-produce-image>
                                                @else
                                                    <x-picture class="produce-marquee__image" :src="'/images/products/' . $product->slug . '.jpg'"
                                                        :alt="$product->name" data-produce-image />
                                                @endif
                                            </span>
                                            <span class="produce-marquee__name">{{ $product->name }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            @else
                <p class="empty-state">Our product collection is being prepared. Please check back soon.</p>
            @endif
            <div class="home-produce-heading">
                <x-section-heading eyebrow="From farm to market" title="Explore Our Produce"
                    description="Browse fresh, export-ready products from our growing selection." center />
            </div>
        </div>
    </section>

    <section class="home-hero">
        <x-picture class="home-hero__image" src="/images/homepage-banner.jpg" alt="" :eager="true" />
        <div class="home-hero__shade"></div>
        <div class="home-hero__content container-shell">
            <p class="eyebrow text-white/85" data-reveal>Fresh from Bangladesh.</p>
            <h1 data-reveal style="--reveal-delay:80ms">Delivered to the <span>World.</span></h1>
            <p class="home-hero__copy" data-reveal style="--reveal-delay:140ms">Premium fruits, vegetables and agricultural
                products, thoughtfully sourced for international markets.</p>
            <div class="button-row" data-reveal style="--reveal-delay:200ms">
                <a class="button button--primary" href="{{ route('products.index') }}">Explore Products <span
                        aria-hidden="true">→</span></a>
                <a class="button button--light" href="{{ route('request-quote') }}">Request a Quote</a>
            </div>
        </div>
    </section>

    <section class="trust-strip" aria-label="Our commitments">
        <div class="container-shell trust-strip__grid">
            @foreach ([['icon' => '✓', 'title' => 'Quality Assured', 'text' => 'Careful selection'], ['icon' => '◇', 'title' => 'Export Grade', 'text' => 'Buyer-ready produce'], ['icon' => '↗', 'title' => 'Reliable Supply', 'text' => 'Consistent coordination'], ['icon' => '◎', 'title' => 'Global Delivery', 'text' => 'International logistics']] as $item)
                <div class="trust-item">
                    <span class="trust-item__icon" aria-hidden="true">{{ $item['icon'] }}</span>
                    <span><strong>{{ $item['title'] }}</strong><small>{{ $item['text'] }}</small></span>
                </div>
            @endforeach
        </div>
    </section>

    <section class="section-shell section-shell--tint">
        <div class="container-shell split-feature">
            <div class="split-feature__copy">
                <p class="eyebrow">Rooted in Bangladesh</p>
                <h2>Connecting Bangladesh’s Agriculture with the World</h2>
                <p>Deshmaya is a Bangladesh-based agricultural export company focused on supplying high-quality fruits,
                    vegetables and agricultural products to international buyers. We work with trusted farmers and suppliers
                    to ensure freshness, quality and timely delivery.</p>
                <a class="button button--primary" href="{{ route('about') }}">Read More <span
                        aria-hidden="true">→</span></a>
            </div>
            <x-picture class="split-feature__image" src="/images/features/home-farm.jpg" alt="Bangladesh farm and growers"
                sizes="(min-width: 1024px) 50vw, 100vw" />
        </div>
    </section>

    {{--
<section class="section-shell">
    <div class="container-shell">
        <div class="section-heading section-heading--row">
            <div>
                <p class="eyebrow">Selected with care</p>
                <h2>Our Products</h2>
                <p class="section-heading__description">Freshness you can trust, prepared for international markets.</p>
            </div>
            <a class="text-link section-heading__action" href="{{ route('products.index') }}">View all products <span aria-hidden="true">→</span></a>
        </div>
        <div class="product-grid">
            @forelse($featuredProducts as $product)
                <x-product-card :product="$product" />
            @empty
                <p class="empty-state">Our product collection is being prepared. Please check back soon.</p>
            @endforelse
        </div>
    </div>
</section>
--}}

    <section class="benefits-band">
        <div class="container-shell">
            <h2 class="benefits-band__title">From the field to shipping</h2>
            <div class="benefit-grid">
                @foreach ([['icon' => '♧', 'title' => 'Harvest', 'text' => 'Picked at the right stage'], ['icon' => '✓', 'title' => 'Quality check', 'text' => 'Checked against order requirements'], ['icon' => '▣', 'title' => 'Packaging', 'text' => 'Prepared to buyer specifications'], ['icon' => '❄', 'title' => 'Cold chain', 'text' => 'Temperature managed to protect freshness'], ['icon' => '↗', 'title' => 'Shipping', 'text' => 'Coordinated from order to delivery']] as $benefit)
                    <article class="benefit-card">
                        <span class="benefit-card__icon" aria-hidden="true">{{ $benefit['icon'] }}</span>
                        <h3>{{ $benefit['title'] }}</h3>
                        <p>{{ $benefit['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-shell">
        <div class="container-shell split-feature split-feature--reverse">
            <div class="split-feature__copy">
                <p class="eyebrow">A clear, careful journey</p>
                <h2>Our Export Process</h2>
                <p>Every order is coordinated from product selection and quality checks through packing, documentation and
                    delivery.</p>
                <a class="button button--primary" href="{{ route('how-we-export') }}">Learn More <span
                        aria-hidden="true">→</span></a>
            </div>
            <x-picture class="split-feature__image" src="/images/features/home-shipment.jpg"
                alt="Export-ready produce shipment" sizes="(min-width: 1024px) 50vw, 100vw" />
        </div>
    </section>

    <section class="export-routes" data-reveal aria-labelledby="export-routes-title">
        <h2 class="export-routes__title" id="export-routes-title">Where we export</h2>
        <p class="export-routes__subtitle">Global markets — by air, road and sea</p>

        <div class="export-routes__map" role="img"
            aria-label="Animated map showing Deshmaya export routes by air, sea and road">
            <svg class="export-routes__world" viewBox="0 0 2000 948" preserveAspectRatio="xMidYMid meet" aria-hidden="true">
                <defs>
                    <g id="export-plane" fill="#e2231a">
                        <path d="M16 0 6 1.6-2 1.6-9 8.5h-3L-8 1.6h-5l-3 3h-2l1.5-4.6L-18-4.5h2l3 2.9h5l-4-7h3l7 6.9h8l10-1.6Z"/>
                    </g>
                    <g id="export-ship" fill="#0e9fbd">
                        <path d="M-16-3h32l-4 10h-24l-4-10Zm4-4h8v4h-8Zm12 0h8v4h-8Zm-24 14h44v5h-44Z"/>
                    </g>
                    <g id="export-truck" fill="#3f9d4f">
                        <path d="M-18-8h24v17h-24Zm24 5h9l7 7v5h-16Zm-17 18a4 4 0 1 0 8 0 4 4 0 0 0-8 0Zm24 0a4 4 0 1 0 8 0 4 4 0 0 0-8 0Z"/>
                    </g>
                </defs>

                <image class="export-routes__countries" href="/images/world-map.svg" x="0" y="0" width="2000" height="948"/>
                <g class="export-routes__glow">
                    <use href="#export-route-air-1"></use>
                    <use href="#export-route-air-2"></use>
                    <use href="#export-route-air-3"></use>
                    <use href="#export-route-air-4"></use>
                    <use href="#export-route-sea-1"></use>
                    <use href="#export-route-sea-2"></use>
                    <use href="#export-route-sea-3"></use>
                    <use href="#export-route-sea-4"></use>
                    <use href="#export-route-road-1"></use>
                    <use href="#export-route-road-2"></use>
                    <use href="#export-route-road-3"></use>
                    <use href="#export-route-road-4"></use>
                </g>
                <g class="export-routes__routes">
                    <path id="export-route-air-1" class="export-route export-route--air" pathLength="1"
                        d="M1500 350 Q1120 145 999 234">
                        <animate attributeName="stroke-dashoffset" dur="14s" begin="0s" repeatCount="indefinite"
                            calcMode="linear" values="1;1;0;0;1;1" keyTimes="0;0.0095;0.38;0.62;0.99;1"/>
                    </path>
                    <path id="export-route-air-2" class="export-route export-route--air" pathLength="1"
                        d="M1500 350 Q1290 175 1647 260">
                        <animate attributeName="stroke-dashoffset" dur="14s" begin="0.34s" repeatCount="indefinite"
                            calcMode="linear" values="1;1;0;0;1;1" keyTimes="0;0.0095;0.38;0.62;0.99;1"/>
                    </path>
                    <path id="export-route-air-3" class="export-route export-route--air" pathLength="1"
                        d="M1500 350 Q1210 160 1305 420">
                        <animate attributeName="stroke-dashoffset" dur="14s" begin="0.68s" repeatCount="indefinite"
                            calcMode="linear" values="1;1;0;0;1;1" keyTimes="0;0.0095;0.38;0.62;0.99;1"/>
                    </path>
                    <path id="export-route-air-4" class="export-route export-route--air" pathLength="1"
                        d="M1500 350 Q1260 180 1050 270">
                        <animate attributeName="stroke-dashoffset" dur="14s" begin="1.02s" repeatCount="indefinite"
                            calcMode="linear" values="1;1;0;0;1;1" keyTimes="0;0.0095;0.38;0.62;0.99;1"/>
                    </path>
                    <path id="export-route-sea-1" class="export-route export-route--sea" pathLength="1"
                        d="M1500 350 Q1550 480 1577 570">
                        <animate attributeName="stroke-dashoffset" dur="14s" begin="1.36s" repeatCount="indefinite"
                            calcMode="linear" values="1;1;0;0;1;1" keyTimes="0;0.0095;0.38;0.62;0.99;1"/>
                    </path>
                    <path id="export-route-sea-2" class="export-route export-route--sea" pathLength="1"
                        d="M1500 350 Q1710 480 1750 760">
                        <animate attributeName="stroke-dashoffset" dur="14s" begin="1.70s" repeatCount="indefinite"
                            calcMode="linear" values="1;1;0;0;1;1" keyTimes="0;0.0095;0.38;0.62;0.99;1"/>
                    </path>
                    <path id="export-route-sea-3" class="export-route export-route--sea" pathLength="1"
                        d="M1500 350 Q1580 500 1665 520">
                        <animate attributeName="stroke-dashoffset" dur="14s" begin="2.04s" repeatCount="indefinite"
                            calcMode="linear" values="1;1;0;0;1;1" keyTimes="0;0.0095;0.38;0.62;0.99;1"/>
                    </path>
                    <path id="export-route-sea-4" class="export-route export-route--sea" pathLength="1"
                        d="M1500 350 Q1230 180 970 240">
                        <animate attributeName="stroke-dashoffset" dur="14s" begin="2.38s" repeatCount="indefinite"
                            calcMode="linear" values="1;1;0;0;1;1" keyTimes="0;0.0095;0.38;0.62;0.99;1"/>
                    </path>
                    <path id="export-route-road-1" class="export-route export-route--road" pathLength="1"
                        d="M1500 350 Q1330 300 1306 420">
                        <animate attributeName="stroke-dashoffset" dur="14s" begin="2.72s" repeatCount="indefinite"
                            calcMode="linear" values="1;1;0;0;1;1" keyTimes="0;0.0095;0.38;0.62;0.99;1"/>
                    </path>
                    <path id="export-route-road-2" class="export-route export-route--road" pathLength="1"
                        d="M1500 350 Q1260 160 1102 256">
                        <animate attributeName="stroke-dashoffset" dur="14s" begin="3.06s" repeatCount="indefinite"
                            calcMode="linear" values="1;1;0;0;1;1" keyTimes="0;0.0095;0.38;0.62;0.99;1"/>
                    </path>
                    <path id="export-route-road-3" class="export-route export-route--road" pathLength="1"
                        d="M1500 350 Q1380 310 1385 365">
                        <animate attributeName="stroke-dashoffset" dur="14s" begin="3.40s" repeatCount="indefinite"
                            calcMode="linear" values="1;1;0;0;1;1" keyTimes="0;0.0095;0.38;0.62;0.99;1"/>
                    </path>
                    <path id="export-route-road-4" class="export-route export-route--road" pathLength="1"
                        d="M1500 350 Q1470 330 1490 460">
                        <animate attributeName="stroke-dashoffset" dur="14s" begin="3.74s" repeatCount="indefinite"
                            calcMode="linear" values="1;1;0;0;1;1" keyTimes="0;0.0095;0.38;0.62;0.99;1"/>
                    </path>
                </g>
                <g class="export-routes__nodes">
                    <circle class="export-routes__origin-halo" cx="1500" cy="350" r="18"/>
                    <circle class="export-routes__origin" cx="1500" cy="350" r="8"/>
                    <text class="export-routes__origin-label" x="1500" y="385" text-anchor="middle">Bangladesh</text>
                    <circle cx="999" cy="234" r="4"/>
                    <circle cx="1647" cy="260" r="4"/>
                    <circle cx="1305" cy="420" r="4"/>
                    <circle cx="1050" cy="270" r="4"/>
                    <circle cx="1577" cy="570" r="4"/>
                    <circle cx="1750" cy="760" r="4"/>
                    <circle cx="1665" cy="520" r="4"/>
                    <circle cx="970" cy="240" r="4"/>
                    <circle cx="1306" cy="420" r="4"/>
                    <circle cx="1102" cy="256" r="4"/>
                    <circle cx="1385" cy="365" r="4"/>
                    <circle cx="1490" cy="460" r="4"/>
                </g>
                <g class="export-routes__icons">
                    <g class="export-routes__icon" opacity="0">
                        <animateMotion dur="14s" begin="0s" repeatCount="indefinite" rotate="auto" calcMode="linear" keyPoints="0;0;1;1;0;0" keyTimes="0;0.0095;0.38;0.62;0.99;1"><mpath href="#export-route-air-1"/></animateMotion>
                        <animate attributeName="opacity" dur="14s" begin="0s" repeatCount="indefinite" calcMode="linear" values="0;0;1;1;0;0" keyTimes="0;0.0095;0.0245;0.60;0.62;1"/>
                        <g transform="translate(-3,-3)"><use href="#export-plane"/></g>
                    </g>
                    <g class="export-routes__icon" opacity="0">
                        <animateMotion dur="14s" begin="0.34s" repeatCount="indefinite" rotate="auto" calcMode="linear" keyPoints="0;0;1;1;0;0" keyTimes="0;0.0095;0.38;0.62;0.99;1"><mpath href="#export-route-air-2"/></animateMotion>
                        <animate attributeName="opacity" dur="14s" begin="0.34s" repeatCount="indefinite" calcMode="linear" values="0;0;1;1;0;0" keyTimes="0;0.0095;0.0245;0.60;0.62;1"/>
                        <g transform="translate(-3,-3)"><use href="#export-plane"/></g>
                    </g>
                    <g class="export-routes__icon" opacity="0">
                        <animateMotion dur="14s" begin="0.68s" repeatCount="indefinite" rotate="auto" calcMode="linear" keyPoints="0;0;1;1;0;0" keyTimes="0;0.0095;0.38;0.62;0.99;1"><mpath href="#export-route-air-3"/></animateMotion>
                        <animate attributeName="opacity" dur="14s" begin="0.68s" repeatCount="indefinite" calcMode="linear" values="0;0;1;1;0;0" keyTimes="0;0.0095;0.0245;0.60;0.62;1"/>
                        <g transform="translate(-3,-3)"><use href="#export-plane"/></g>
                    </g>
                    <g class="export-routes__icon" opacity="0">
                        <animateMotion dur="14s" begin="1.02s" repeatCount="indefinite" rotate="auto" calcMode="linear" keyPoints="0;0;1;1;0;0" keyTimes="0;0.0095;0.38;0.62;0.99;1"><mpath href="#export-route-air-4"/></animateMotion>
                        <animate attributeName="opacity" dur="14s" begin="1.02s" repeatCount="indefinite" calcMode="linear" values="0;0;1;1;0;0" keyTimes="0;0.0095;0.0245;0.60;0.62;1"/>
                        <g transform="translate(-3,-3)"><use href="#export-plane"/></g>
                    </g>
                    <g class="export-routes__icon" opacity="0">
                        <animateMotion dur="14s" begin="1.36s" repeatCount="indefinite" rotate="auto" calcMode="linear" keyPoints="0;0;1;1;0;0" keyTimes="0;0.0095;0.38;0.62;0.99;1"><mpath href="#export-route-sea-1"/></animateMotion>
                        <animate attributeName="opacity" dur="14s" begin="1.36s" repeatCount="indefinite" calcMode="linear" values="0;0;1;1;0;0" keyTimes="0;0.0095;0.0245;0.60;0.62;1"/>
                        <g transform="translate(-3,-3)"><use href="#export-ship"/></g>
                    </g>
                    <g class="export-routes__icon" opacity="0">
                        <animateMotion dur="14s" begin="1.70s" repeatCount="indefinite" rotate="auto" calcMode="linear" keyPoints="0;0;1;1;0;0" keyTimes="0;0.0095;0.38;0.62;0.99;1"><mpath href="#export-route-sea-2"/></animateMotion>
                        <animate attributeName="opacity" dur="14s" begin="1.70s" repeatCount="indefinite" calcMode="linear" values="0;0;1;1;0;0" keyTimes="0;0.0095;0.0245;0.60;0.62;1"/>
                        <g transform="translate(-3,-3)"><use href="#export-ship"/></g>
                    </g>
                    <g class="export-routes__icon" opacity="0">
                        <animateMotion dur="14s" begin="2.04s" repeatCount="indefinite" rotate="auto" calcMode="linear" keyPoints="0;0;1;1;0;0" keyTimes="0;0.0095;0.38;0.62;0.99;1"><mpath href="#export-route-sea-3"/></animateMotion>
                        <animate attributeName="opacity" dur="14s" begin="2.04s" repeatCount="indefinite" calcMode="linear" values="0;0;1;1;0;0" keyTimes="0;0.0095;0.0245;0.60;0.62;1"/>
                        <g transform="translate(-3,-3)"><use href="#export-ship"/></g>
                    </g>
                    <g class="export-routes__icon" opacity="0">
                        <animateMotion dur="14s" begin="2.38s" repeatCount="indefinite" rotate="auto" calcMode="linear" keyPoints="0;0;1;1;0;0" keyTimes="0;0.0095;0.38;0.62;0.99;1"><mpath href="#export-route-sea-4"/></animateMotion>
                        <animate attributeName="opacity" dur="14s" begin="2.38s" repeatCount="indefinite" calcMode="linear" values="0;0;1;1;0;0" keyTimes="0;0.0095;0.0245;0.60;0.62;1"/>
                        <g transform="translate(-3,-3)"><use href="#export-ship"/></g>
                    </g>
                    <g class="export-routes__icon" opacity="0">
                        <animateMotion dur="14s" begin="2.72s" repeatCount="indefinite" rotate="auto" calcMode="linear" keyPoints="0;0;1;1;0;0" keyTimes="0;0.0095;0.38;0.62;0.99;1"><mpath href="#export-route-road-1"/></animateMotion>
                        <animate attributeName="opacity" dur="14s" begin="2.72s" repeatCount="indefinite" calcMode="linear" values="0;0;1;1;0;0" keyTimes="0;0.0095;0.0245;0.60;0.62;1"/>
                        <g transform="translate(-3,-3)"><use href="#export-truck"/></g>
                    </g>
                    <g class="export-routes__icon" opacity="0">
                        <animateMotion dur="14s" begin="3.06s" repeatCount="indefinite" rotate="auto" calcMode="linear" keyPoints="0;0;1;1;0;0" keyTimes="0;0.0095;0.38;0.62;0.99;1"><mpath href="#export-route-road-2"/></animateMotion>
                        <animate attributeName="opacity" dur="14s" begin="3.06s" repeatCount="indefinite" calcMode="linear" values="0;0;1;1;0;0" keyTimes="0;0.0095;0.0245;0.60;0.62;1"/>
                        <g transform="translate(-3,-3)"><use href="#export-truck"/></g>
                    </g>
                    <g class="export-routes__icon" opacity="0">
                        <animateMotion dur="14s" begin="3.40s" repeatCount="indefinite" rotate="auto" calcMode="linear" keyPoints="0;0;1;1;0;0" keyTimes="0;0.0095;0.38;0.62;0.99;1"><mpath href="#export-route-road-3"/></animateMotion>
                        <animate attributeName="opacity" dur="14s" begin="3.40s" repeatCount="indefinite" calcMode="linear" values="0;0;1;1;0;0" keyTimes="0;0.0095;0.0245;0.60;0.62;1"/>
                        <g transform="translate(-3,-3)"><use href="#export-truck"/></g>
                    </g>
                    <g class="export-routes__icon" opacity="0">
                        <animateMotion dur="14s" begin="3.74s" repeatCount="indefinite" rotate="auto" calcMode="linear" keyPoints="0;0;1;1;0;0" keyTimes="0;0.0095;0.38;0.62;0.99;1"><mpath href="#export-route-road-4"/></animateMotion>
                        <animate attributeName="opacity" dur="14s" begin="3.74s" repeatCount="indefinite" calcMode="linear" values="0;0;1;1;0;0" keyTimes="0;0.0095;0.0245;0.60;0.62;1"/>
                        <g transform="translate(-3,-3)"><use href="#export-truck"/></g>
                    </g>
                </g>
            </svg>

            <div class="export-routes__legend" aria-label="Export transportation methods">
                <span><svg viewBox="-18 -12 36 24" aria-hidden="true"><use href="#export-plane"></use></svg>By air</span>
                <span><svg viewBox="-18 -12 36 24" aria-hidden="true"><use href="#export-ship"></use></svg>By sea</span>
                <span><svg viewBox="-18 -12 36 24" aria-hidden="true"><use href="#export-truck"></use></svg>By road</span>
            </div>
        </div>
    </section>

    <script>
    (() => {
        const section = document.querySelector('.export-routes');
        if (!section || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

        const routeIds = [
            'export-route-air-1',
            'export-route-air-2',
            'export-route-air-3',
            'export-route-air-4',
            'export-route-sea-1',
            'export-route-sea-2',
            'export-route-sea-3',
            'export-route-sea-4',
            'export-route-road-1',
            'export-route-road-2',
            'export-route-road-3',
            'export-route-road-4',
        ];
        const delay = 14000;

        routeIds.forEach((routeId) => {
            const route = section.querySelector(`#${routeId}`);
            route?.querySelectorAll('animate').forEach((animation) => {
                animation.setAttribute('begin', 'indefinite');
                animation.setAttribute('repeatCount', '1');
            });

            section.querySelectorAll('.export-routes__icon').forEach((icon) => {
                const motion = icon.querySelector(`animateMotion mpath[href="#${routeId}"]`)?.closest('animateMotion');
                if (!motion) return;
                icon.querySelectorAll('animateMotion, animate').forEach((animation) => {
                    animation.setAttribute('begin', 'indefinite');
                    animation.setAttribute('repeatCount', '1');
                });
            });
        });

        function startRoute(routeId) {
            const route = section.querySelector(`#${routeId}`);
            route?.querySelectorAll('animate').forEach((animation) => {
                if (typeof animation.beginElement === 'function') animation.beginElement();
            });

            section.querySelectorAll('.export-routes__icon animateMotion').forEach((motion) => {
                if (motion.querySelector(`mpath[href="#${routeId}"]`)) {
                    const icon = motion.closest('.export-routes__icon');
                    icon?.querySelectorAll('animateMotion, animate').forEach((animation) => {
                        if (typeof animation.beginElement === 'function') animation.beginElement();
                    });
                }
            });
        }

        function playSchedule() {
            routeIds.forEach((routeId, index) => {
                window.setTimeout(() => startRoute(routeId), index * delay);
            });
        }

        playSchedule();
        window.setInterval(playSchedule, routeIds.length * delay);
    })();
    </script>
@endsection
