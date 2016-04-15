@if (count($errors) > 0)
    <div class="alert alert-danger">
        <p>There where some errors on the page</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::get('message'))
    <div class="alert alert-danger">
        <p>{{ Session::get('message') }}</p>

    </div>
@endif