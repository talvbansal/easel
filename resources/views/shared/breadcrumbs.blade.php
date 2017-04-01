@if( !empty($links) )
    <ol class="breadcrumb">
        @foreach($links as $name => $url )
            @if( ! empty( $url) )
                <li><a href="{{ $url }}">{{ $name }}</a></li>
            @else
                <li class="active">{{ $name }}</li>
            @endif
        @endforeach
    </ol>

    <ul class="actions">
        <li class="dropdown">
            <a href="" data-toggle="dropdown">
                <i class="zmdi zmdi-more-vert"></i>
            </a>

            <ul class="dropdown-menu dm-icon pull-right">
                <li>
                    <a href="">Refresh</a>
                </li>
            </ul>
        </li>
    </ul>

@endif