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

            <media-uploader inline-template>
                <div class="container">
                    <div class="card">
                        <media-manager></media-manager>
                    </div>
                </div>
            </media-uploader>
        </section>
    </section>

@stop

@section('unique-js')
    <script>
        Vue.component('media-uploader', {

            mounted: function () {
                window.eventHub.$on('media-manager-notification', function (message, type, time) {
                    $.notify({
                        message: message
                    }, {
                        type: 'inverse',
                        allow_dismiss: false,
                        label: 'Cancel',
                        className: 'btn-xs btn-inverse',
                        placement: {
                            from: 'top',
                            align: 'right'
                        },
                        z_index: 9999,
                        delay: time,
                        animate: {
                            enter: 'animated fadeInRight',
                            exit: 'animated fadeOutRight'
                        },
                        offset: {
                            x: 20,
                            y: 85
                        }
                    });
                });
            }

        });
    </script>
@stop
