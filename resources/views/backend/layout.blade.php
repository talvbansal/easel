<!DOCTYPE html>
<html lang="en">
    <head>
        @include('easel::shared.meta-tags')

        @yield('title')

        @include('easel::backend.partials.backend-css')

        <meta name="_token" content="{{ encrypt(csrf_token()) }}" />

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

        <script>
            Vue.http.headers.common['X-XSRF-Token'] = document.querySelector('meta[name="_token"]').getAttribute('content');
        </script>

    </body>
</html>