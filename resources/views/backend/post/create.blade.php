@extends('easel::backend.layout')

@section('title')
    <title>{{ config('easel.title') }} | New Post</title>
@stop

@section('content')
    <section id="main">

        @include('easel::backend.partials.sidebar-navigation')

        <section id="content">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb">
                            <li><a href="/admin">Home</a></li>
                            <li><a href="/admin/post">Posts</a></li>
                            <li class="active">New Post</li>
                        </ol>

                        @include('easel::shared.errors')

                        @include('easel::shared.success')

                        <h2>Create a New Post</h2>
                    </div>
                    <div class="card-body card-padding">
                        {!! Form::open(['class' => 'keyboard-save', 'role' => 'form', 'id' => 'postCreate', 'url' => 'admin/post/' ]) !!}

                            @include('easel::backend.post.partials.form')

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-icon-text"><i class="zmdi zmdi-floppy"></i> Save</button>
                                &nbsp;
                                <a href="{{ url('/admin/post') }}">
                                    <button type="button" class="btn btn-link">Cancel</button>
                                </a>
                            </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>
    </section>
@stop

@section('unique-js')
    @include('easel::backend.post.partials.summernote')

    {!! JsValidator::formRequest('Easel\Http\Requests\PostCreateRequest', '#postCreate') !!}

    @include('easel::backend.shared.notifications.protip')

@stop
