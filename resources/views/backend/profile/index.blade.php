@extends('vendor.easel.backend.layout')

@section('title')
    <title>{{ config('blog.title') }} | Profile</title>
@stop

@section('content')
    <section id="main">
        @include('vendor.easel.backend.partials.sidebar-navigation')
        <section id="content">
            <div class="container container-alt">

                <div class="block-header">
                    <h2>{{ $user->display_name }}
                        <small>{{ $user->job }}, {{ $user->city }}, {{ $user->country }}</small>
                    </h2>
                </div>

                <div class="card" id="profile-main">
                    @include('vendor.easel.backend.profile.partials.sidebar')

                    <div class="pm-body clearfix">
                        <ul class="tab-nav tn-justified">
                            <li class="active"><a href="/admin/profile">Profile</a></li>
                            <li><a href="/admin/profile/{{ $user->id }}/edit">Settings</a></li>
                        </ul>

                        @if(isset($user->bio) && !empty($user->bio))
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
                                    @if(isset($user->gender) && !empty($user->gender))
                                        <dl class="dl-horizontal">
                                            <dt>Gender</dt>
                                            <dd>{{ $user->gender }}</dd>
                                        </dl>
                                    @endif
                                    @if(isset($user->birthday) && !empty($user->birthday))
                                        <dl class="dl-horizontal">
                                            <dt>Birthday</dt>
                                            <dd>{{ $user->birthday->format('M d, Y') }}</dd>
                                        </dl>
                                    @endif
                                    @if(isset($user->relationship) && !empty($user->relationship) )
                                        <dl class="dl-horizontal">
                                            <dt>Relationship Status</dt>
                                            <dd>{{ $user->relationship }}</dd>
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
                                    @if(isset($user->phone) && strlen($user->phone))
                                        <dl class="dl-horizontal">
                                            <dt>Mobile Phone</dt>
                                            <dd>{{ $user->phone }}</dd>
                                        </dl>
                                    @endif
                                    <dl class="dl-horizontal">
                                        <dt>Email Address</dt>
                                        <dd>{{ $user->email }}</dd>
                                    </dl>
                                    @if(isset($user->twitter) && strlen($user->twitter))
                                        <dl class="dl-horizontal">
                                            <dt>Twitter</dt>
                                            <dd><a href="http://twitter.com/{{ $user->twitter }}" target="_blank">{{ '@' . $user->twitter }}</a></dd>
                                        </dl>
                                    @endif
                                    @if(isset($user->facebook) && strlen($user->facebook))
                                        <dl class="dl-horizontal">
                                            <dt>Facebook</dt>
                                            <dd><a href="http://facebook.com/{{ $user->facebook }}" target="_blank">{{ $user->facebook }}</a></dd>
                                        </dl>
                                    @endif
                                    @if(isset($user->github) && strlen($user->github))
                                        <dl class="dl-horizontal">
                                            <dt>GitHub</dt>
                                            <dd><a href="http://github.com/{{ $user->github }}" target="_blank">{{ $user->github }}</a></dd>
                                        </dl>
                                    @endif
                                    @if(isset($user->address) && !empty($user->address))
                                        <dl class="dl-horizontal">
                                            <dt>Address</dt>
                                            <dd>{{ $user->address }}</dd>
                                        </dl>
                                    @endif
                                    @if(isset($user->city) && !empty($user->city))
                                        <dl class="dl-horizontal">
                                            <dt>City</dt>
                                            <dd>{{ $user->city }}</dd>
                                        </dl>
                                    @endif
                                    @if(isset($user->country) && !empty($user->country))
                                        <dl class="dl-horizontal">
                                            <dt>Country</dt>
                                            <dd>{{ $user->country }}</dd>
                                        </dl>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@stop
