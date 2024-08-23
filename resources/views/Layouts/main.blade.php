<!DOCTYPE html>
<html lang="en">

<head>
    @include('Partials.header')
</head>

<body>

    @include('Partials.navbar')

    @include('Partials.sidebar')

    <main id="main" class="main">

        @yield('main')

    </main><!-- End #main -->

    @include('Partials.footer')

</body>

</html>
