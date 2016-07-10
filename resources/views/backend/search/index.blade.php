@extends('backend.layout')

@section('title')
    <title>{{ config('blog.title') }} | Search</title>
@stop

@section('content')
    <section id="main">
        @include('backend.partials.sidebar-navigation')
        <section id="content">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb">
                            <li><a href="/admin">Home</a></li>
                            <li class="active">Search</li>
                        </ol>
                        <ul class="actions">
                            <li class="dropdown">
                                <a href="" data-toggle="dropdown">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="">Refresh Search</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                        <h2>Search Results for <em>{{ $params }}</em></h2>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-condensed table-vmiddle">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Title</th>
                                        <th>Created</th>
                                        <th>Last Updated</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(empty($posts->toArray()) && empty($tags->toArray()))
                                        <tr>
                                            <td>No results found.</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @else
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td>Post</td>
                                                <td><a href="/admin/post/{{ $post->id }}/edit">{{ $post->title }}</a></td>
                                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('M d, Y') }}</td>
                                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->updated_at)->format('M d, Y') }}</td>
                                            </tr>
                                        @endforeach

                                        @foreach ($tags as $tag)
                                            <tr>
                                                <td>Tag</td>
                                                <td><a href="/admin/tag/{{ $tag->id }}/edit">{{ $tag->title }}</a></td>
                                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tag->created_at)->format('M d, Y') }}</td>
                                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tag->updated_at)->format('M d, Y') }}</td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@stop
