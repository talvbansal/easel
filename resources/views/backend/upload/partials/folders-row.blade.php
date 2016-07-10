@foreach ($subfolders as $path => $name)
    <tr>
        <td>
            <a href="/admin/upload?folder={{ $path }}"><i class="zmdi zmdi-folder-outline"></i>&nbsp;&nbsp;{{ $name }}
            </a>
        </td>
        <td>Folder</td>
        <td>-</td>
        <td>-</td>
        <td>
            <a><button type='button' class='btn btn-icon command-edit waves-effect waves-circle' onclick="delete_folder('{{ $name }}')"><span class='zmdi zmdi-delete'></span></button></a>
        </td>
    </tr>
@endforeach