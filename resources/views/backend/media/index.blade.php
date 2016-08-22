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
                    @include('easel::backend.media.partials.file-picker')
                </div>
            </div>
        </section>
    </section>

@stop

@section('unique-js')
    @include('easel::backend.media.partials.js.file-manager-mixin')
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
