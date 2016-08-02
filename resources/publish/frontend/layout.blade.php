<!DOCTYPE html>
<html lang="en">
    <head>
        @include('easel::shared.meta-tags')

        @yield('title')

        <meta name="description" content="{{ $meta_description }}">

        @include('vendor.easel.frontend.partials.css')
    </head>
    <body>
        @include('vendor.easel.frontend.blog.partials.header')

        @yield('content')

        @yield('unique-js')

        @include('vendor.easel.frontend.partials.js')

        @include('vendor.easel.frontend.blog.partials.footer')


    </body>
</html>
