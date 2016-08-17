<header id="header" class="clearfix" data-current-skin="blue">
    <ul class="header-inner">
        <li id="menu-trigger" data-trigger="#sidebar">
            <div class="line-wrap">
                <div class="line top"></div>
                <div class="line center"></div>
                <div class="line bottom"></div>
            </div>
        </li>
        <li class="logo">
            <a href="{{ url('/admin') }}"><h1 class="brand light logo logo-sidebar hidden-xs">Easel</h1></a>
        </li>
        <li class="pull-right">
            <ul class="top-menu">
                <li id="top-search">
                    <a href=""><i class="tm-icon zmdi zmdi-search"></i></a>
                </li>
                <li class="dropdown hidden-xs">
                    <a data-toggle="dropdown" href=""><i class="tm-icon zmdi zmdi-more-vert"></i></a>
                    <ul class="dropdown-menu dm-icon pull-right">
                        <li class="hidden-xs">
                            <a target="_blank" href="{{ url('/') }}"><i class="zmdi zmdi-view-web"></i> View Site </a>
                        </li>
                        <li class="hidden-xs">
                            <a data-action="fullscreen" href=""><i class="zmdi zmdi-fullscreen"></i> Toggle Fullscreen</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="zmdi zmdi-power"></i>Sign out
                            </a>
                        </li>s
                        {!! Form::open(['url' => url('/logout'), 'id' => 'logout-form', 'class' => 'hidden' ]) !!} {!! Form::close() !!}
                    </ul>
                </li>
            </ul>
        </li>
    </ul>


    <!-- Top Search Content -->
    {!! Form::open(['method' => 'GET', 'url' => route('admin.search.index'), 'name' => 'search', 'id' => 'search']) !!}
        <div id="top-search-wrap">
            <div class="tsw-inner">
                <i id="top-search-close" class="zmdi zmdi-arrow-left"></i>
                <input type="text" placeholder="Search" name="search">
            </div>
        </div>
    {!! Form::close() !!}
</header>