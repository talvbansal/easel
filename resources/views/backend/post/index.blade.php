@extends('easel::backend.layout')

@section('title')
    <title>{{ config('easel.title') }} | Posts</title>
@stop

@section('content')
    <section id="main">
        @include('easel::backend.partials.sidebar-navigation')
        <section id="content">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb">
                            <li><a href="{{ url('/admin') }}">Home</a></li>
                            <li class="active">Posts</li>
                        </ol>
                        <ul class="actions">
                            <li class="dropdown">
                                <a href="" data-toggle="dropdown">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="">Refresh Posts</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                        @include('easel::shared.errors')
                        @include('easel::shared.success')

                        <h2>Manage Posts&nbsp;
                            <a href="{{ route('admin.post.create') }}"><i class="zmdi zmdi-plus-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Create a new post"></i></a>

                            <small>This page provides a comprehensive overview of all current blog posts. Click the edit or preview links next to each post to modify specific details, publish a post or view any changes from the browser.</small>
                        </h2>
                    </div>

                    <div class="table-responsive">
                        <table id="data-table-posts" class="table table-condensed table-vmiddle">
                            <thead>
                                <tr>
                                    <th data-column-id="id" data-type="numeric" data-sortable="false">Id</th>
                                    <th data-column-id="title">Title</th>
                                    <th data-column-id="subtitle"
                                        data-css-class="hidden-xs"
                                        data-header-css-class="hidden-xs"
                                    >Subtitle</th>
                                    <th data-column-id="slug"
                                        data-css-class="hidden-xs"
                                        data-header-css-class="hidden-xs"
                                    >Slug</th>
                                    <th data-column-id="status">Status</th>
                                    <th data-column-id="published" data-formatter="ukdate" data-type="date" data-order="desc">Published</th>
                                    <th data-column-id="commands"
                                        data-formatter="commands"
                                        data-sortable="false"
                                        data-css-class="text-center"
                                    >Actions</th>
                                                                    </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->subtitle }}</td>
                                        <td>{{ $post->slug }}</td>
                                        <td>{{ ($post->is_draft)? '<span class="label label-default">Draft</span>' : '<span class="label label-primary">Published</span>' }}</td>
                                        <td>{{ $post->published_at }}</td>
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
    @if(Session::get('_login'))
        @include('easel::backend.post.partials.notifications.login')
        {{ \Session::forget('_login') }}
    @endif

    @if(Session::get('_new-post'))
        @include('easel::backend.post.partials.notifications.create-post')
        {{ \Session::forget('_new-post') }}
    @endif

    @if(Session::get('_delete-post'))
        @include('easel::backend.post.partials.notifications.delete-post')
        {{ \Session::forget('_delete-post') }}
    @endif

    @include('easel::backend.post.partials.datatable')
@stop
