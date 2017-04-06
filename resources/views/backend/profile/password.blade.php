@extends('easel::backend.profile.layout')

@section('title')
    <title>{{ config('easel.title') }} | Edit Password</title>
@stop

@section('profile-content')

    <form class="keyboard-save" action="{!! route('admin.profile.update.password', $user->id) !!}" method="POST" role="form" autocomplete="false" id="frmPasswordUpdate">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

    <div class="pmb-block">
        <div class="pmbb-header">

            @include('easel::shared.errors')

            @include('easel::shared.success')

            <h2><i class="zmdi zmdi-shield-check m-r-10"></i> Change Password</h2>
        </div>

        <div class="pmbb-body p-l-30">


            <div class="form-group">
                <div class="fg-line">
                    <label class="fg-label">Current Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Current Password">
                </div>
            </div>

            <br>

            <div class="form-group">
                <div class="fg-line">
                    <label class="fg-label">New Password</label>
                    <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password">
                </div>
            </div>

            <br>

            <div class="form-group">
                <div class="fg-line">
                    <label class="fg-label">Confirm New Password</label>
                    <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation" placeholder="Confirm New Password">
                </div>
            </div>

            <br>

            <div class="form-group m-l-30">
                <button type="submit" class="btn btn-primary btn-icon-text"><i class="zmdi zmdi-floppy"></i> Save</button>
                &nbsp;
                <a href="{{ url('/admin/profile') }}">
                    <button type="button" class="btn btn-link">Cancel</button>
                </a>
            </div>

            {{--  Just so that the sidebar with the contact details continues to be shown --}}
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>

        </div>

    </div>

    </form>

@stop

@section('unique-js')
    {!! JsValidator::formRequest(\Easel\Http\Requests\PasswordUpdateRequest::class, '#frmPasswordUpdate') !!}

    @if(Session::get('_passwordUpdate'))
        @include('easel::backend.shared.notifications.notify', ['section' => '_passwordUpdate'])
        {{ \Session::forget('_passwordUpdate') }}
    @endif
@stop
