<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <h2>Written By</h2>
            <hr>

            <div class="profile-pic col-sm-2">
                <img src="//www.gravatar.com/avatar/{{ md5( strtolower($post->author->email) ) }}?d=identicon&s=130" class="img-responsive center-block img-circle">
            </div>

            <div class="profile-info col-sm-10">
                <h5 class="lead">
                    <a href="{{ url(config('easel.blog_base_url').'/author/'. $post->author->id) }}">{{ $post->author->display_name }}</a>
                </h5>
                <p> {{ $post->author->bio }}

                <ul class="list-inline">
                    @foreach( $post->author->social_media as $network => $url )
                        @if( !empty($url) )
                            <li>
                                <a href="{{ $url }}" target="_blank" class="social">
                                    <i class="fa fa-{{ $network }}"></i>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
                </p>
            </div>
        </div>
    </div>
</div>