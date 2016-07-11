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
                    <h2>{{ $data['display_name'] }}
                        <small>{{ $data['job'] }}, {{ $data['city'] }}, {{ $data['country'] }}</small>
                    </h2>
                </div>

                <div class="card" id="profile-main">
                    @include('vendor.easel.backend.profile.partials.sidebar')

                    <div class="pm-body clearfix">
                        <ul class="tab-nav tn-justified">
                            <li class="active"><a href="/admin/profile">Profile</a></li>
                            <li><a href="/admin/profile/{{ $data['id'] }}/edit">Settings</a></li>
                        </ul>

                        @if(isset($data['bio']) && !empty($data['bio']))
                            <div class="pmb-block">
                                <div class="pmbb-header">
                                    <h2><i class="zmdi zmdi-equalizer m-r-10"></i> Summary</h2>
                                </div>
                                <div class="pmbb-body p-l-30">
                                    <div class="pmbb-view">
                                        {{ $data['bio'] }}
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
                                        <dd>{{ $data['first_name'] . ' ' . $data['last_name']}}</dd>
                                    </dl>
                                    @if(isset($data['gender']) && !empty($data['gender']))
                                        <dl class="dl-horizontal">
                                            <dt>Gender</dt>
                                            <dd>{{ $data['gender'] }}</dd>
                                        </dl>
                                    @endif
                                    @if(isset($data['birthday']) && !empty($data['birthday']))
                                        <dl class="dl-horizontal">
                                            <dt>Birthday</dt>
                                            <dd>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data['birthday'])->format('M d, Y') }}</dd>
                                        </dl>
                                    @endif
                                    @if(isset($data['relationship']) && !empty($data['relationship']) )
                                        <dl class="dl-horizontal">
                                            <dt>Relationship Status</dt>
                                            <dd>{{ $data['relationship'] }}</dd>
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
                                    @if(isset($data['phone']) && strlen($data['phone']))
                                        <dl class="dl-horizontal">
                                            <dt>Mobile Phone</dt>
                                            <dd>{{ $data['phone'] }}</dd>
                                        </dl>
                                    @endif
                                    <dl class="dl-horizontal">
                                        <dt>Email Address</dt>
                                        <dd>{{ $data['email'] }}</dd>
                                    </dl>
                                    @if(isset($data['twitter']) && strlen($data['twitter']))
                                        <dl class="dl-horizontal">
                                            <dt>Twitter</dt>
                                            <dd><a href="http://twitter.com/{{ $data['twitter'] }}" target="_blank">{{ '@' . $data['twitter'] }}</a></dd>
                                        </dl>
                                    @endif
                                    @if(isset($data['facebook']) && strlen($data['facebook']))
                                        <dl class="dl-horizontal">
                                            <dt>Facebook</dt>
                                            <dd><a href="http://facebook.com/{{ $data['facebook'] }}" target="_blank">{{ $data['facebook'] }}</a></dd>
                                        </dl>
                                    @endif
                                    @if(isset($data['github']) && strlen($data['github']))
                                        <dl class="dl-horizontal">
                                            <dt>GitHub</dt>
                                            <dd><a href="http://github.com/{{ $data['github'] }}" target="_blank">{{ $data['github'] }}</a></dd>
                                        </dl>
                                    @endif
                                    @if(isset($data['address']) && !empty($data['address']))
                                        <dl class="dl-horizontal">
                                            <dt>Address</dt>
                                            <dd>{{ $data['address'] }}</dd>
                                        </dl>
                                    @endif
                                    @if(isset($data['city']) && !empty($data['city']))
                                        <dl class="dl-horizontal">
                                            <dt>City</dt>
                                            <dd>{{ $data['city'] }}</dd>
                                        </dl>
                                    @endif
                                    @if(isset($data['country']) && !empty($data['country']))
                                        <dl class="dl-horizontal">
                                            <dt>Country</dt>
                                            <dd>{{ $data['country'] }}</dd>
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
