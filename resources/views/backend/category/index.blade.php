@extends('easel::backend.layout')

@section('title')
    <title>{{ config('easel.title') }} | Categories</title>
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
                            'Categories' => '',
                        ]])

                        @include('easel::shared.errors')
                        @include('easel::shared.success')

                        <h2>Manage Categories&nbsp;
                            <a href="{{ url('/admin/category/create') }}"><i class="zmdi zmdi-plus-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Create a new category"></i></a>

                            <small>
                                <p>Categories are a set of topics that you discuss on your blog.</p>
                                This page provides a comprehensive overview of all current blog categories. Click the edit link next to each category to modify specific meta details or information.</small>
                        </h2>
                    </div>

                    <div class="table-responsive">
                        <table id="data-table-categories" class="table table-condensed table-vmiddle">
                            <thead>
                            <tr>
                                <th data-column-id="id" data-type="numeric" data-sortable="false">Id</th>
                                <th data-column-id="title" data-order="desc">Title</th>
                                <th data-column-id="slug">Slug</th>
                                <th data-column-id="commands" data-formatter="commands" data-sortable="false">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </section>
@stop

@section('unique-js')
    @include('easel::backend.category.partials.datatable')

    @if(Session::get('_new-category'))
        @include('easel::backend.shared.notifications.notify', ['section' => '_new-category'])
        {{ \Session::forget('_new-category') }}
    @endif

    @if(Session::get('_delete-category'))
        @include('easel::backend.shared.notifications.notify', ['section' => '_delete-category'])
        {{ \Session::forget('_delete-category') }}
    @endif
@stop
