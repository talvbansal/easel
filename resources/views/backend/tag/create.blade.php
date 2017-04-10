@extends('easel::backend.layout')

@section('title')
    <title>{{ config('easel.title') }} | New Tag</title>
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
                            'Tags' => url('/admin/tag') ,
                            'New Tag' =>'' ,
                        ]])

                        @include('easel::shared.errors')

                        @include('easel::shared.success')

                        <h2>Create a New Tag</h2>

                    </div>
                    <div class="card-body card-padding">
                        <form class="keyboard-save" role="form" method="POST" id="tagUpdate" action="/admin/tag">
                            {{ csrf_field() }}

                            @include('easel::backend.tag.partials.form')

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-icon-text"><i class="zmdi zmdi-floppy"></i> Save</button>
                                &nbsp;
                                <a href="{{ url('/admin/tag') }}"><button type="button" class="btn btn-link">Cancel</button></a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </section>
@stop

@section('unique-js')
    {!! JsValidator::formRequest('Easel\Http\Requests\TagCreateRequest', '#tagUpdate') !!}
    @include('easel::backend.tag.partials.script')
    @include('easel::backend.shared.notifications.protip')
@stop
