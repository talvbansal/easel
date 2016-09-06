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
                </div>
            </div>

            <div class="container">
                <div class="card">
                    @include('media-manager::media.partials.file-picker')
                </div>
            </div>
        </section>
    </section>

@stop

@section('unique-css')
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/talvbansal/mediamanager/css/media-manager.css')}}">
@stop

@section('unique-js')
    @include('media-manager::media.partials.js.file-manager-mixin')
    <script type="text/javascript">
        $(document).ready(function () {
            Vue.config.devtools = true;
            var vm = new Vue({
                el: 'body',
                mixins: [FileManagerMixin],
                ready: function () {
                    this.loadFolder();
                }
            });
        });
    </script>
@stop
