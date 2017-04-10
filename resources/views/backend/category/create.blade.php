@extends('easel::backend.layout')

@section('title')
    <title>{{ config('easel.title') }} | New Category</title>
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
                            'Categories' => url('/admin/category'),
                            'New Category' => '',
                        ]])

                        @include('easel::shared.errors')

                        @include('easel::shared.success')

                        <h2>Create a New Category</h2>

                    </div>
                    <div class="card-body card-padding">
                        <form class="keyboard-save" role="form" method="POST" id="categoryUpdate" action="/admin/category">
                            {{ csrf_field() }}

                            @include('easel::backend.category.partials.form')

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-icon-text"><i class="zmdi zmdi-floppy"></i> Save</button>
                                &nbsp;
                                <a href="{{ url('/admin/category') }}"><button type="button" class="btn btn-link">Cancel</button></a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </section>
@stop

@section('unique-js')
    {!! JsValidator::formRequest('Easel\Http\Requests\CategoryCreateRequest', '#categoryUpdate') !!}
    @include('easel::backend.category.partials.script')

    @include('easel::backend.shared.notifications.protip')
@stop
