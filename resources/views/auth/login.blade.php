@extends('easel::backend.layout')

@section('title')
    <title>{{ config('blog.title') }} | Sign In</title>
@stop

@section('login')
    <section id="main">
        <section id="content">
            <div class="col-md-4 col-md-offset-4">
                <div class="card">
                    <br>
                    <div class="card-header">
                        <div class="text-center">
                            <img src="{{ asset('images/canvas-logo.gif') }}" style="width: 120px">
                        </div>
                    </div>

                    <div class="card-body card-padding" id="login-ch">
                        <p class="f-20 f-300 text-center">Please sign in to continue</p>

                        @include('auth.partials.login-form')
                        <br>
                    </div>
                </div>
                <p class="text-center"><a href="/"><i class="zmdi zmdi-long-arrow-return"></i> Go back home</a></p>
            </div>
        </section>
    </section>
@endsection

@section('unique-js')
    {!! JsValidator::formRequest('App\Http\Requests\LoginRequest', '#login'); !!}
@stop