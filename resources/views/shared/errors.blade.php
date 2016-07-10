@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong><i class="zmdi zmdi-close-circle"></i>&nbsp;Whoops! </strong>There were some problems with your input.
        <br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif