@extends('easel::backend.layout')

@section('title')
    <title>{{ config('easel.title') }} | Uploads</title>
@stop

@section('unique-js')
    <section id="main">
        @include('easel::backend.partials.sidebar-navigation')
        <section id="content">
            <div class="container">
                <div class="card">
                    @include('easel::backend.media.partials.browser')

                </div>
            </div>
        </section>
    </section>
@stop