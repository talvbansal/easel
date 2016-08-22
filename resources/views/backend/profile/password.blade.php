@extends('easel::backend.profile.layout')

@section('title')
    <title>{{ config('easel.title') }} | Edit Password</title>
@stop

@section('profile-content')

    {!! Form::open(['class' => 'keyboard-save', 'autocomplete' => 'off', 'method' => 'put', 'url' => route('admin.profile.update.password', $user->id), 'id' => 'frmPasswordUpdate' ]) !!}

    <div class="pmb-block">
        <div class="pmbb-header">

            @include('easel::shared.errors')

            @include('easel::shared.success')

            <h2><i class="zmdi zmdi-shield-check m-r-10"></i> Change Password</h2>
        </div>

        <div class="pmbb-body p-l-30">

            <div class="form-group">
                <div class="fg-line">
                    {!! Form::label('password', 'Current Password', ['class' => 'fg-label'])  !!}
                    {!! Form::password('password', ['class'=> 'form-control', 'size' => 20, 'maxlength' => 255, 'autofocus' => 'autofocus', 'placeholder' => 'Current Password' ] )  !!}
                </div>
            </div>

            <br>

            <div class="form-group">
                <div class="fg-line">
                    {!! Form::label('new_password', 'Password', ['class' => 'fg-label']) !!}
                    {!! Form::password('new_password', ['class'=> 'form-control', 'maxlength' => 50, 'placeholder' => 'New Password'] ) !!}
                </div>
            </div>

            <br>

            <div class="form-group">
                <div class="fg-line">
                    {!! Form::label('new_password_confirmation', 'Confirm Password', ['class' => 'fg-label']) !!}
                    {!! Form::password('new_password_confirmation', ['class'=> 'form-control', 'maxlength' => 50, 'placeholder' => 'Confirm Password'] ) !!}
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

    {!! Form::close() !!}

@stop

@section('unique-js')
    {!! JsValidator::formRequest(\Easel\Http\Requests\PasswordUpdateRequest::class, '#frmPasswordUpdate') !!}

    @if(Session::get('_passwordUpdate'))
        @include('easel::backend.profile.partials.notifications.update-password')
        {{ \Session::forget('_passwordUpdate') }}
    @endif
@stop
