@extends('vendor.easel.backend.layout')

@section('title')
    <title>{{ config('blog.title') }} | Edit Profile</title>
@stop

@section('content')
    <section id="main">

        @include('vendor.easel.backend.partials.sidebar-navigation')

        <section id="content">
            <div class="container container-alt">

                <div class="block-header">
                    <h2>{{ $user->display_name }}
                        <small>{{ $user->job }}, {{ $user->city }}, {{ $user->country }}</small>
                    </h2>
                </div>

                <div class="card" id="profile-main">

                    @include('vendor.easel.backend.profile.partials.sidebar')

                    <div class="pm-body clearfix">
                        <ul class="tab-nav tn-justified">
                            <li><a href="/admin/profile">Profile</a></li>
                            <li class="active"><a href="/admin/profile/{{ Auth::user()->id }}/edit">Settings</a></li>
                        </ul>

                        <form class="keyboard-save" role="form" method="POST" id="profileUpdate" action="{{ route('admin.profile.update', Auth::user()->id) }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">

                            <div class="pmb-block">
                                <div class="pmbb-header">

                                    @include('vendor.easel.shared.errors')

                                    @include('vendor.easel.shared.success')

                                    <h2><i class="zmdi zmdi-equalizer m-r-10"></i> Summary</h2>
                                </div>
                                <div class="pmbb-body p-l-30">

                                    @include('vendor.easel.backend.profile.partials.form.summary')

                                </div>
                            </div>

                            <div class="pmb-block">
                                <div class="pmbb-header">
                                    <h2><i class="zmdi zmdi-account m-r-10"></i> Basic Information</h2>
                                </div>
                                <div class="pmbb-body p-l-30">

                                    @include('vendor.easel.backend.profile.partials.form.basic-information')

                                </div>
                            </div>

                            <div class="pmb-block">
                                <div class="pmbb-header">
                                    <h2><i class="zmdi zmdi-phone m-r-10"></i> Contact Information</h2>
                                </div>
                                <div class="pmbb-body p-l-30">

                                    @include('vendor.easel.backend.profile.partials.form.contact-information')

                                </div>
                                <div class="form-group m-l-30">
                                    <button type="submit" class="btn btn-primary btn-icon-text"><i class="zmdi zmdi-floppy"></i> Save</button>
                                    &nbsp;
                                    <a href="/admin/profile"><button type="button" class="btn btn-link">Cancel</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </section>
@stop

@section('unique-js')
    {!! JsValidator::formRequest('Easel\Http\Requests\ProfileUpdateRequest', '#profileUpdate') !!}

    @if(Session::get('_profile'))
        @include('backend.profile.partials.notifications.update-profile')
        {{ \Session::forget('_profile') }}
    @endif
@stop
