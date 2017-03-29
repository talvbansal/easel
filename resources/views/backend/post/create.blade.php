@extends('easel::backend.layout')

@section('title')
    <title>{{ config('easel.title') }} | New Post</title>
@stop

@section('content')
    <section id="main">

        @include('easel::backend.partials.sidebar-navigation')

        <section id="content">
            <div class="container">

                    <form class="keyboard-save" role="form" method="POST" id="frmPost" action="{!! route('admin.post.store') !!}">
                        @include('easel::backend.post.partials.form')
                    </form>
            </div>
        </section>
    </section>
@stop

@section('unique-js')
    @include('easel::backend.post.partials.editor')

    {!! JsValidator::formRequest('Easel\Http\Requests\PostCreateRequest', '#frmPost') !!}

    @include('easel::backend.shared.notifications.protip')

@stop
