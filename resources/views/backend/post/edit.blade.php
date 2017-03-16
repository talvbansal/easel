@extends('easel::backend.layout')

@section('title')
    <title>{{ config('easel.title') }} | Edit Post</title>
@stop

@section('content')
    <section id="main">

        @include('easel::backend.partials.sidebar-navigation')

        <section id="content">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb">
                            <li><a href="{{ url('/admin') }}">Home</a></li>
                            <li><a href="{{ url('/admin/post') }}">Posts</a></li>
                            <li class="active">Edit Post</li>
                        </ol>
                        <ul class="actions">
                            <li class="dropdown">
                                <a href="" data-toggle="dropdown">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="">Refresh Post</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                        @include('easel::shared.errors')

                        @include('easel::shared.success')

                        <h2>
                            Edit <em>{{ $title }}</em>
                            <small>Last edited on {{ $updated_at->format('M d, Y') }} at {{ $updated_at->format('g:i A') }}</small>
                        </h2>

                    </div>
                    <div class="card-body card-padding">
                        <form class="keyboard-save" role="form" method="POST" id="frmPost" action="{!! route('admin.post.update', $id) !!}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="user_id" value="{!! auth()->user()->id!!}">
                            @include('easel::backend.post.partials.form')

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-icon-text" name="action" value="continue">
                                    <i class="zmdi zmdi-floppy"></i> Save
                                </button>
                                &nbsp;
                                <button type="button" class="btn btn-danger btn-icon-text" data-toggle="modal" data-target="#modal-delete">
                                    <i class="zmdi zmdi-delete"></i> Delete
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
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
