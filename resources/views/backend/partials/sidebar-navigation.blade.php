<aside id="sidebar" class="sidebar c-overflow">
    <div class="profile-menu">
        <a href="">
            <div class="profile-pic">
                <img src="//www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?d=identicon">
            </div>
            <div class="profile-info">
                {{ Auth::user()->display_name }}
                <i class="zmdi zmdi-caret-down"></i>
            </div>
        </a>
        <ul class="main-menu">
            <li @if (Request::is('admin/profile')) class="active" @endif><a href="/admin/profile"><i class="zmdi zmdi-account"></i> Profile</a></li>
            <li @if (Request::is('admin/profile/*')) class="active" @endif><a href="/admin/profile/{{ Auth::user()->id }}/edit"><i class="zmdi zmdi-settings"></i> Settings</a></li>
            <li><a href="/auth/logout" name="logout"><i class="zmdi zmdi-power"></i> Sign out</a></li>
        </ul>
    </div>
    <ul class="main-menu">
        <li @if (Request::is('admin/post*')) class="active" @endif><a href="/admin/post"><i class="zmdi zmdi-view-compact"></i> Posts <span class="label label-default label-totals">{{ Easel\Models\Post::count() }}</span></a></li>
        <li @if (Request::is('admin/tag*')) class="active" @endif><a href="/admin/tag"><i class="zmdi zmdi-tag"></i> Tags <span class="label label-default label-totals">{{ Easel\Models\Tag::count() }}</span></a></li>
        <li @if (Request::is('admin/upload*')) class="active" @endif><a href="/admin/upload"><i class="zmdi zmdi-cloud-upload"></i> Uploads</a></li>
    </ul>
</aside>