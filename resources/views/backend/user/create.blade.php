@extends('easel::backend.layout')

@section('title')
    <title>{{ config('easel.title') }} | New User</title>
@stop

@section('content')
    <section id="main">
        @include('easel::backend.partials.sidebar-navigation')
        <section id="content">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        @include('easel::shared.breadcrumbs', ['links' => [
                            'Home' => url('/admin'),
                            'Users' => url('/admin/user'),
                            'New User' => '',
                        ]])
                        @include('easel::shared.errors')
                        @include('easel::shared.success')
                        <h2>Create a New User</h2>
                    </div>
                    <div class="card-body card-padding">
                        <form class="keyboard-save" role="form" method="POST" id="createUser" action="{!! route('admin.user.store') !!}">


                            @include('easel::backend.user.partials.form')

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-icon-text"><i class="zmdi zmdi-floppy"></i> Save</button>
                                &nbsp;
                                <a href="{!! route('admin.user.index') !!}"><button type="button" class="btn btn-link">Cancel</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </section>
@stop

@section('unique-js')
    {!! JsValidator::formRequest(\Easel\Http\Requests\UserCreateRequest::class, '#createUser') !!}
@stop