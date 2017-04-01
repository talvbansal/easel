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
@endif