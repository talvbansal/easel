<!DOCTYPE html>
<html lang="en">
    <head>
        @include('easel::shared.meta-tags')

        @yield('title')

        @include('easel::backend.partials.backend-css')

        @yield('unique-css')

        <script>
            window.Laravel = <?php echo json_encode([
                    'csrfToken' => csrf_token(),
            ]); ?>
        </script>

    </head>
    <body @if(Auth::check()) class="toggled sw-toggled" @endif>
        @if (Auth::guest())

            @yield('login')

        @else

            @include('easel::backend.partials.header')

            @yield('content')

            @include('easel::shared.page-loader')

        @endif

        @include('easel::backend.partials.footer')

        @include('easel::backend.partials.backend-js')

        @include('easel::backend.partials.search-js')

        @yield('unique-js')

    </body>
</html>
