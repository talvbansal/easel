@extends('easel::backend.layout')

@section('title')
    <title>{{ config('easel.title') }} | Edit Category</title>
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
                            <li><a href="{{ url('/admin/category') }}">Categorys</a></li>
                            <li class="active">Edit Category</li>
                        </ol>
                        <ul class="actions">
                            <li class="dropdown">
                                <a href="" data-toggle="dropdown">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="">Refresh Category</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                        @include('easel::shared.errors')

                        @include('easel::shared.success')

                        <h2>
                            Edit <em>{{ $data['name'] }}</em>
                            <small>
                                Last edited on {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data['updated_at'])->format('M d, Y') }} at {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data['updated_at'])->format('g:i A') }}
                            </small>
                        </h2>

                    </div>
                    <div class="card-body card-padding">
                        <form class="keyboard-save" role="form" method="POST" id="categoryUpdate" action="/admin/category/{{ $data['id'] }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="id" value="{{ $data['id'] }}">

                            @include('easel::backend.category.partials.form')

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-icon-text">
                                    <i class="zmdi zmdi-floppy"></i> Save
                                </button>&nbsp;
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

    @include('easel::backend.category.partials.modals.delete')
@stop

@section('unique-js')
    {!! JsValidator::formRequest('Easel\Http\Requests\CategoryUpdateRequest', '#categoryUpdate') !!}

    @if(Session::get('_update-category'))
        @include('easel::backend.category.partials.notifications.update')
        {{ \Session::forget('_update-category') }}
    @endif
@stop
