@extends('easel::backend.layout')

@section('title')
    <title>{{ config('easel.title') }} | Media Manager</title>
@stop

@section('content')

    <section id="main">
        @include('easel::backend.partials.sidebar-navigation')
        <section id="content">
            <div class="container container-alt">
                <div class="block-header">
                    <h2>Media Manager</h2>
                    <small>
                        All the files you’ve uploaded are listed alphabetically in the Media Library. Double-click a folder name to see its contents.
                    </small>
                </div>
            </div>

            <div class="container">
                <div class="card">
                    <media-manager></media-manager>
                </div>
            </div>
        </section>
    </section>

@stop

@section('unique-js')
    <script>

    </script>
@stop
