<!DOCTYPE html>
<html lang="en">
    <head>
        @include('shared.meta-tags')

        @yield('title')

        @include('backend.partials.backend-css')
    </head>
    <body @if(Auth::check()) class="toggled sw-toggled" @endif>
        @if (Auth::guest())

            @yield('login')

        @else

            @include('backend.partials.header')

            @yield('content')

            @include('shared.page-loader')

        @endif

        @include('backend.partials.footer')

        @include('backend.partials.backend-js')

        @include('backend.partials.search-js')

        @yield('unique-js')

    </body>
</html>