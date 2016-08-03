@extends('easel::backend.layout')

@section('title')
    <title>{{ config('easel.title') }} | Profile</title>
@stop

@section('content')
    <section id="main">
        @include('easel::backend.partials.sidebar-navigation')
        <section id="content">
            <div class="container container-alt">

                <div class="block-header">
                    <h2>{{ $user->display_name }}
                        <small>{{ $user->job }}, {{ $user->city }}, {{ $user->country }}</small>
                    </h2>
                </div>

                <div class="card" id="profile-main">
                    @include('easel::backend.profile.partials.sidebar')

                    <div class="pm-body clearfix">
                        <ul class="tab-nav tn-justified">
                            <li class="{{ Route::is('admin.profile.index') ? 'active' : '' }}">
                                <a href="{{ route('admin.profile.index') }}">Profile</a>
                            </li>

                            <li class="{{ Route::is('admin.profile.edit') ? 'active' : '' }}">
                                <a href="{{ route('admin.profile.edit', $user->id ) }}">Edit</a>
                            </li>

                            <li class="{{ Route::is('admin.profile.edit.password') ? 'active' : '' }}">
                                <a href="{{ route('admin.profile.edit.password', $user->id ) }}">Password</a>
                            </li>
                        </ul>

                        @yield('profile-content')

                    </div>
                </div>
            </div>
        </section>
    </section>
@stop
