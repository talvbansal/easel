@extends('easel::backend.layout')

@section('title')
    <title>{{ config('easel.title') }} | New Tag</title>
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
                            <li><a href="{{ url('/admin/tag') }}">Tags</a></li>
                            <li class="active">New Tag</li>
                        </ol>
                        <ul class="actions">
                            <li class="dropdown">
                                <a href="" data-toggle="dropdown">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="">Refresh Tag</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                        @include('easel::shared.errors')

                        @include('easel::shared.success')

                        <h2>Create a New Tag</h2>

                    </div>
                    <div class="card-body card-padding">
                        {!! Form::open(['class' => 'keyboard-save', 'role' => 'form', 'id' => 'tagUpdate', 'url' => '/admin/tag']) !!}

                            @include('easel::backend.tag.partials.form')

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-icon-text"><i class="zmdi zmdi-floppy"></i> Save</button>
                                &nbsp;
                                <a href="{{ url('/admin/tag') }}"><button type="button" class="btn btn-link">Cancel</button></a>
                            </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>
    </section>
@stop

@section('unique-js')
    {!! JsValidator::formRequest('Easel\Http\Requests\TagCreateRequest', '#tagUpdate') !!}

    @include('easel::backend.shared.notifications.protip')
@stop
