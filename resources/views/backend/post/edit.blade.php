@extends('easel::backend.layout')

@section('title')
    <title>{{ config('easel.title') }} | Edit Post</title>
@stop

@section('content')
    <section id="main">

        @include('easel::backend.partials.sidebar-navigation')

        <section id="content">
            <div class="container">
                    <form class="keyboard-save" role="form" method="POST" id="frmPost" action="{!! route('admin.post.update', $id) !!}">
                        @include('easel::backend.post.partials.form')
                    </form>
            </div>
        </section>
    </section>

    @include('easel::backend.post.partials.modals.delete')
@stop

@section('unique-js')
    @include('easel::backend.post.partials.editor')
    {!! JsValidator::formRequest('Easel\Http\Requests\PostUpdateRequest', '#frmPost') !!}

    @if(Session::get('_update-post'))
        @include('easel::backend.post.partials.notifications.update-post')
        {{ \Session::forget('_update-post') }}
    @endif

@stop
