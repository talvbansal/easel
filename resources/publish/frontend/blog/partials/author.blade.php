<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <h2>Written By</h2>
            <hr>

            <div class="profile-pic col-sm-3">
                <br/>
                <img src="//www.gravatar.com/avatar/{{ md5( strtolower($post->author->email) ) }}?d=identicon&s=300" class="img-responsive center-block">
            </div>

            <div class="profile-info col-sm-9">
                <h5 class="lead">{{ $post->author->display_name }}</h5>
                <p>
                    {{ $post->author->bio }}
                </p>
                <p>
                    View all posts by <a href="{{ url(config('easel.blog_base_url').'/author/'. $post->author->id) }}">{{ $post->author->display_name }}</a>
                </p>

                Follow {{ $post->author->display_name }}:
                @foreach( $post->author->social_media as $network => $url )
                    <a href="{{ $url }}" target="_blank" class="social">
                        <i class="zmdi zmdi-{{ $network }}"></i>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>