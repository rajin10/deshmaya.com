<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body>
    @include('partials.loader')
    @include('partials.header')
    <main id="content">
        @yield('content')
    </main>
    @include('partials.footer')
</body>
</html>
