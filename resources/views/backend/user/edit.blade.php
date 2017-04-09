@extends('easel::backend.layout')

@section('title')
    <title>{{ config('easel.title') }} | Edit User</title>
@stop

@section('content')
    <section id="main">
        @include('easel::backend.partials.sidebar-navigation')
        <section id="content">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h2>User Profile</h2>
                        @include('easel::shared.breadcrumbs', ['links' => [
                            'Home' => url('/admin'),
                            'Users' => url('/admin/user'),
                            'Edit User' => '',
                    ]])
                        @include('easel::shared.errors')
                        @include('easel::shared.success')
                    </div>
                    <div class="card-body card-padding">
                        <form class="keyboard-save" role="form" method="POST" id="createUser" action="{!! route('admin.user.update', $data->id) !!}">
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <input type="hidden" name="_method" value="PATCH">
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
    @include('easel::backend.user.partials.modals.delete')
@stop

@section('unique-js')

    {!! JsValidator::formRequest(\Easel\Http\Requests\UserUpdateRequest::class, '#userUpdate') !!}

    @if(Session::get('-update-user'))
        @include('easel::backend.shared.notifications.notify', ['section' => '-update-user'])
        {{ \Session::forget('-update-user') }}
    @endif

    @if(Session::get('-update-password'))
        @include('easel::backend.shared.notifications.notify', ['section' => '-update-password'])
        {{ \Session::forget('-update-password') }}
    @endif
@stop