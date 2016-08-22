@extends('easel::backend.layout')

@section('title')
    <title>{{ config('easel.title') }} | Sign In</title>
@stop

@section('login')
    <section id="main">
        <section id="content">
            <div class="col-md-4 col-md-offset-4">
                <div class="card">
                    <br>
                    <div class="card-header">
                        <div class="text-center">
                            <h1 class="brand" id="logo">Easel</h1>
                        </div>
                    </div>

                    <div class="card-body card-padding" id="login-ch">
                        <p class="f-20 f-300 text-center">Please sign in to continue</p>

                        @include('easel::auth.partials.login-form')
                        <br>
                    </div>
                </div>
                <p class="text-center"><a href="{{ url('/') }}"><i class="zmdi zmdi-long-arrow-return"></i> Go back home</a></p>
            </div>
        </section>
    </section>
@endsection

@section('unique-js')
    {!! JsValidator::formRequest(\Easel\Http\Requests\LoginRequest::class, '#login') !!}
@stop
