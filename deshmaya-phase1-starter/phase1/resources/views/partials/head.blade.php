<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>@hasSection('title')@yield('title') | {{ setting('general.site_name', 'Deshmaya') }}@else{{ setting('seo.default_title', config('app.name')) }}@endif</title>
<meta name="description" content="@yield('description', setting('seo.default_description', ''))">
<meta property="og:title" content="@yield('title', setting('seo.default_title', config('app.name')))">
<meta property="og:description" content="@yield('description', setting('seo.default_description', ''))">
@if($og = setting_url('seo.og_image'))<meta property="og:image" content="{{ $og }}">@endif
@if($fav = setting_url('general.favicon'))<link rel="icon" href="{{ $fav }}">@endif
<script>
    document.documentElement.classList.add('js');
    @if(setting('loader.mode', 'session') === 'session')
    try { if (sessionStorage.getItem('loaderSeen') === '1') document.documentElement.classList.add('no-loader'); } catch (e) {}
    @endif
</script>
@include('partials.brand-style')
@vite(['resources/css/app.css', 'resources/js/app.js'])
@stack('head')
