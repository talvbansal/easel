@extends('vendor.easel.frontend.layout', [
  'title' => $post->title,
  'meta_description' => $post->meta_description ?: config('easel.description'),
])

@if ($post->page_image)
    @section('og-image')
        <meta property="og:image" content="{{ $post->page_image }}">
    @stop
@endif

@section('og-title')
    <meta property="og:title" content="{{ $post->title }}"/>
@stop

@section('og-description')
    <meta property="og:description" content="{{ $post->meta_description }}"/>
@stop

@section('title')
    <title>{{ $title or config('easel.title') }}</title>
@stop

@section('content')
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    @if ($post->page_image)
                        <div class="text-center">
                            <img src="{{ asset('storage/' . $post->page_image) }}" class="post-hero">
                        </div>
                    @endif
                    <p class="post-page-meta">
                        {{ $post->published_at->toFormattedDateString() }}
                        @if ($post->tags->count())
                            in
                            {!! join(', ', $post->tagLinks()) !!}
                        @endif
                    </p>
                    <h1 class="post-page-title">{{ $post->title }}</h1>
                    <hr>
                    {!! $post->content_html !!}
                </div>
            </div>
        </div>
    </article>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <ul class="pager">
                    @if ($tag && $tag->reverse_direction)
                        @if ($post->olderPost($tag))
                            <li class="previous">
                                <a href="{!! $post->olderPost($tag)->url($tag) !!}">
                                    <i class="fa fa-angle-left fa-lg"></i>
                                    Previous {{ $tag->tag }}
                                </a>
                            </li>
                        @endif
                        @if ($post->newerPost($tag))
                            <li class="next">
                                <a href="{!! $post->newerPost($tag)->url($tag) !!}">
                                    Next {{ $tag->tag }}
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        @endif
                    @else
                        @if ($post->newerPost($tag))
                            <li class="previous">
                                <a href="{!! $post->newerPost($tag)->url($tag) !!}">
                                    <i class="fa fa-angle-left fa-lg"></i>
                                    Newer
                                </a>
                            </li>
                        @endif
                        @if ($post->olderPost($tag))
                            <li class="next">
                                <a href="{!! $post->olderPost($tag)->url($tag) !!}">
                                    Older
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </div>

    @include('vendor.easel.frontend.blog.partials.author')


    @if(config('easel.disqus_name'))

        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    @include('vendor.easel.frontend.blog.partials.disqus')
                </div>
            </div>
        </div>
        <br>

    @endif

@stop