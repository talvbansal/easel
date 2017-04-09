@extends('easel::backend.layout')

@section('title')
    <title>{{ config('easel.title') }} | Users</title>
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
                            'Users' => '',
                        ]])

                        @include('easel::shared.errors')
                        @include('easel::shared.success')

                        <h2>Manage Users&nbsp;
                            <a href="{{ url('/admin/user/create') }}"><i class="zmdi zmdi-plus-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Create a new user"></i></a>

                            <small>This page provides a comprehensive overview of all the current users. Click the <span class="zmdi zmdi-edit text-primary"></span> icon next to each user to update their site access or remove them from the system.</small>
                        </h2>
                    </div>

                    <div class="table-responsive">
                        <table id="users" class="table table-condensed table-vmiddle">
                            <thead>
                            <tr>
                                <th data-column-id="id" data-type="numeric" data-order="asc">ID</th>
                                <th data-column-id="display_name">Name</th>
                                <th data-column-id="email">Email</th>
                                <th data-column-id="posts">Posts</th>
                                <th data-column-id="commands" data-formatter="commands" data-sortable="false">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->display_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->postCount() }}</td>
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
    @include('easel::backend.user.partials.datatable')

    @if(Session::get('_new-user'))
        @include('easel::backend.shared.notifications.notify', ['section' => '_new-user'])
        {{ \Session::forget('_new-user') }}
    @endif


@stop
