<div class="pm-overview c-overflow">
    <div class="pmo-pic">
        <div class="p-relative">
            <a href="http://gravatar.com" target="_blank" rel="noopener">
                <img class="img-responsive" src="//www.gravatar.com/avatar/{{ md5($user->email) }}?d=identicon&s=500">
            </a>
            <div class="dropdown pmop-message">
                <a href="mailto:{{ $user->email }}" target="_blank" rel="noopener" class="btn bgm-white btn-float z-depth-1">
                    <i class="zmdi zmdi-email"></i>
                </a>
            </div>
            <a href="http://gravatar.com" target="_blank" rel="noopener" class="pmop-edit">
                <i class="zmdi zmdi-camera"></i> <span class="hidden-xs">Update Profile Picture</span>
            </a>
        </div>
        <div class="pmo-stat">
            <h2 class="m-0 c-white">{{ $user->display_name }}</h2>
            Member since {{ $user->created_at->format('M d, Y') }}
        </div>
    </div>
    <div class="pmo-block pmo-contact hidden-xs">
        <h2>Contact</h2>
        <ul>
            @if(isset($user->phone) && strlen($user->phone))
                <li><i class="zmdi zmdi-phone"></i> {{ $user->phone }}</li>
            @endif

            @foreach( $user->social_media as $network => $url )
                @if(!empty($url))
                    <li>
                        <i class="zmdi zmdi-{{ $network }}"></i>
                        <a href="{{ $url }}" target="_blank" rel="noopener">{{ last( explode('/', $url) ) }}</a>
                    </li>
                @endif
            @endforeach

            <li>
                @if(isset($user->address) || isset($user->city) || isset($user->country))
                    <i class="zmdi zmdi-pin"></i>
                @endif
                <address class="m-b-0 ng-binding">
                    @if(isset($user->address) && !empty($user->address) )
                        {{ $user->address }},<br>
                    @endif
                    @if(isset($user->city) && !empty($user->city))
                        {{ $user->city }},<br>
                    @endif
                    @if(isset($user->country) && !empty($user->country))
                        {{ $user->country }}
                    @endif

                </address>
            </li>
        </ul>
    </div>
</div>
