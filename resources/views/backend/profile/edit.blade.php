@extends('easel::backend.profile.layout')

@section('title')
    <title>{{ config('easel.title') }} | Edit Profile</title>
@stop

@section('profile-content')

    <form class="keyboard-save" role="form" method="POST" id="profileUpdate" action="{{ route('admin.profile.update', $user->id) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        <div class="pmb-block">
            <div class="pmbb-header">

                @include('easel::shared.errors')

                @include('easel::shared.success')

                <h2><i class="zmdi zmdi-equalizer m-r-10"></i> Summary</h2>
            </div>
            <div class="pmbb-body p-l-30">

                @include('easel::backend.profile.partials.form.summary')

            </div>
        </div>

        <div class="pmb-block">
            <div class="pmbb-header">
                <h2><i class="zmdi zmdi-account m-r-10"></i> Basic Information</h2>
            </div>
            <div class="pmbb-body p-l-30">

                @include('easel::backend.profile.partials.form.basic-information')

            </div>
        </div>

        <div class="pmb-block">
            <div class="pmbb-header">
                <h2><i class="zmdi zmdi-phone m-r-10"></i> Contact Information</h2>
            </div>
            <div class="pmbb-body p-l-30">

                @include('easel::backend.profile.partials.form.contact-information')

            </div>
            <div class="form-group m-l-30">
                <button type="submit" class="btn btn-primary btn-icon-text"><i class="zmdi zmdi-floppy"></i> Save</button>
                &nbsp;
                <a href="{{ url('/admin/profile') }}">
                    <button type="button" class="btn btn-link">Cancel</button>
                </a>
            </div>
        </div>
    </form>
@stop

@section('unique-js')
    {!! JsValidator::formRequest('Easel\Http\Requests\ProfileUpdateRequest', '#profileUpdate') !!}

    @if(Session::get('_profile'))
        @include('easel::backend.profile.partials.notifications.update-profile')
        {{ \Session::forget('_profile') }}
    @endif
@stop
