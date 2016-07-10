@foreach ($files as $file)
    <tr>
        <td>
            <a href="{{ $file['webPath'] }}" target="_blank">
                @if (is_image($file['mimeType']))
                    <i class="zmdi zmdi-image"></i>
                @else
                    <i class="zmdi zmdi-file"></i>
                @endif
                &nbsp;{{ $file['name'] }}
            </a>
        </td>
        <td>{{ $file['mimeType'] or 'Unknown' }}</td>
        <td>{{ human_filesize($file['size']) }}</td>
        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $file['modified'])->format('M d, Y') }}</td>
        <td>
            @if (is_image($file['mimeType']))
                <a><button type='button' class='btn btn-icon command-edit waves-effect waves-circle' onclick="preview_image('{{ $file['webPath'] }}')"><span class='zmdi zmdi-search'></span></button></a>
            @endif
            <a><button type='button' class='btn btn-icon command-edit waves-effect waves-circle' onclick="delete_file('{{ $file['name'] }}')"><span class='zmdi zmdi-delete'></span></button></a>
        </td>
    </tr>
@endforeach