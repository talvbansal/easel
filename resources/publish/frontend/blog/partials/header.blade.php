<div class="container" id="head-c">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <h1><a href="{{url('/')}}">{{ config('easel.title') }}</a></h1>

            @if( isset($post) )
                @foreach( $post->author->social_media as $network => $url )
                    @if( !empty($url) )
                        <a href="{{ $url }}" target="_blank" class="social">
                            <i class="fa fa-fw fa-{{ $network }}"></i>
                        </a>
                    @endif
                @endforeach
            @endif

        </div>
    </div>
</div>
