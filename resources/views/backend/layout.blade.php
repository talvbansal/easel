<!DOCTYPE html>
<html lang="en">
    <head>
        @include('vendor.easel.shared.meta-tags')

        @yield('title')

        @include('vendor.easel.backend.partials.backend-css')
    </head>
    <body @if(Auth::check()) class="toggled sw-toggled" @endif>
        @if (Auth::guest())

            @yield('login')

        @else

            @include('vendor.easel.backend.partials.header')

            @yield('content')

            @include('vendor.easel.shared.page-loader')

        @endif

        @include('vendor.easel.backend.partials.footer')

        @include('vendor.easel.backend.partials.backend-js')

        @include('vendor.easel.backend.partials.search-js')

        @yield('unique-js')

    </body>
</html>