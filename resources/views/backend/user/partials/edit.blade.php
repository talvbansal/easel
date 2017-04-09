@extends('easel::backend.layout')

@section('title')
    <title>{{ config('easel.title') }} | Edit User</title>
@stop

@section('content')
    <section id="main">
        include('easel::backend.partials.sidebar-navigation')
        <section id="content">
            <div class="container container-alt">
                <div class="block-header">
                    <h2>User Profile</h2>
                    <ul class="actions">
                        <li class="dropdown">
                            <a href="" data-toggle="dropdown">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="{!! route('canvas.admin.user.edit', $data['id']) !!}"><i class="zmdi zmdi-refresh-alt pd-r-5"></i> Refresh User</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="card" id="profile-main">
                    @include('canvas::backend.user.partials.sidebar')
                    <div class="pm-body clearfix">
                        <ul class="tab-nav tn-justified">
                            <li class="{{ Route::is('canvas.admin.user.edit') ? 'active' : '' }}">
                                <a href="{{ route('canvas.admin.user.edit', $data['id']) }}">Profile</a>
                            </li>
                            <li class="{{ Route::is('canvas.admin.user.privacy') ? 'active' : '' }}">
                                <a href="{!! route('canvas.admin.user.privacy', $data['id']) !!}">Privacy</a>
                            </li>
                        </ul>
                        @if(Session::has('errors') || Session::has('success'))
                            <div class="pmb-block">
                                <div class="pmbb-header">
                                    @include('canvas::backend.shared.partials.errors')
                                    @include('canvas::backend.shared.partials.success')
                                </div>
                            </div>
                        @endif
                        @include('canvas::backend.user.partials.form.edit')
                    </div>
                </div>
            </div>
        </section>
    </section>
    @include('canvas::backend.user.partials.modals.delete')
@stop

@section('unique-js')
    @include('canvas::backend.user.partials.editor')

    {!! JsValidator::formRequest('Canvas\Http\Requests\UserUpdateRequest', '#userUpdate') !!}
    @include('canvas::backend.shared.components.profile-datetime-picker', ['format' => 'YYYY-MM-DD'])

    @if(Session::get('-update-user'))
        @include('canvas::backend.shared.notifications.notify', ['section' => '-update-user'])
        {{ \Session::forget('-update-user') }}
    @endif

    @if(Session::get('-update-password'))
        @include('canvas::backend.shared.notifications.notify', ['section' => '-update-password'])
        {{ \Session::forget('-update-password') }}
    @endif
@stop