@extends('easel::backend.profile.layout')

@section('profile-content')

    @if( !empty($user->bio) )
        <div class="pmb-block">
            <div class="pmbb-header">
                <h2><i class="zmdi zmdi-equalizer m-r-10"></i> Summary</h2>
            </div>
            <div class="pmbb-body p-l-30">
                <div class="pmbb-view">
                    {{ $user->bio }}
                </div>
            </div>
        </div>
    @endif

    <div class="pmb-block">
        <div class="pmbb-header">
            <h2><i class="zmdi zmdi-account m-r-10"></i> Basic Information</h2>
        </div>
        <div class="pmbb-body p-l-30">
            <div class="pmbb-view">
                <dl class="dl-horizontal">
                    <dt>Full Name</dt>
                    <dd>{{ $user->first_name . ' ' . $user->last_name}}</dd>
                </dl>

                @if( !empty($user->display_name) )
                    <dl class="dl-horizontal">
                        <dt>Display Name</dt>
                        <dd>{{ $user->display_name }}</dd>
                    </dl>
                @endif

                @if( !empty($user->job) )
                    <dl class="dl-horizontal">
                        <dt>Job</dt>
                        <dd>{{ $user->job }}</dd>
                    </dl>
                @endif

            </div>
        </div>
    </div>

    <div class="pmb-block">
        <div class="pmbb-header">
            <h2><i class="zmdi zmdi-phone m-r-10"></i> Contact Information</h2>
        </div>
        <div class="pmbb-body p-l-30">
            <div class="pmbb-view">

                <dl class="dl-horizontal">
                    <dt>Email Address</dt>
                    <dd>{{ $user->email }}</dd>
                </dl>

                @foreach( $user->social_media as $network => $url )
                    <dl class="dl-horizontal">
                        @if( !empty($url) )
                            <dt>{{ ucfirst($network) }}</dt>
                            <dd><a href="{{ $url }}" target="_blank" rel="noopener">{{ last( explode('/', $url) ) }}</a></dd>
                        @endif
                    </dl>
                @endforeach

                @if( !empty($user->city) )
                    <dl class="dl-horizontal">
                        <dt>City</dt>
                        <dd>{{ $user->city }}</dd>
                    </dl>
                @endif

                @if( !empty($user->country) )
                    <dl class="dl-horizontal">
                        <dt>Country</dt>
                        <dd>{{ $user->country }}</dd>
                    </dl>
                @endif
            </div>
        </div>
    </div>
@stop
