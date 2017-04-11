@extends('easel::backend.layout')

@section('title')
    <title>{{ config('easel.title') }} | Tags</title>
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
                            'Tags' => '',
                        ]])

                        @include('easel::shared.errors')
                        @include('easel::shared.success')

                        <h2>Manage Tags&nbsp;
                            <a href="{{ url('/admin/tag/create') }}"><i class="zmdi zmdi-plus-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Create a new tag"></i></a>

                            <small>This page provides a comprehensive overview of all current blog tags. Click the edit link next to each tag to modify specific meta details or information.</small>
                        </h2>
                    </div>

                    <div class="table-responsive">
                        <table id="data-table-tags" class="table table-condensed table-vmiddle">
                            <thead>
                                <tr>
                                    <th data-column-id="id" data-type="numeric" data-sortable="false">Id</th>
                                    <th data-column-id="name" data-order="desc">Name</th>
                                    <th data-column-id="slug" data-order="desc">Slug</th>
                                    <th data-column-id="commands"
                                        data-formatter="commands"
                                        data-sortable="false"
                                        data-css-class="text-center"
                                    >Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $tag)
                                    <tr>
                                        <td>{{ $tag->id }}</td>
                                        <td>{{ $tag->name }}</td>
                                        <td>{{ $tag->slug }}</td>
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
    @include('easel::backend.tag.partials.datatable')

    @if(Session::get('_new-tag'))
        @include('easel::backend.shared.notifications.notify', ['section' => '_new-tag'])
        {{ \Session::forget('_new-tag') }}
    @endif

    @if(Session::get('_delete-tag'))
        @include('easel::backend.shared.notifications.notify', ['section' => '_update-tag'])
        {{ \Session::forget('_delete-tag') }}
    @endif
@stop
