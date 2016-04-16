<form action="{{ route('home') }}" method="GET" class="form-horizontal">
    <div class="input-group">
        <input type="text" name="search" class="form-control col-lg-10"
               placeholder="Search for your comic...">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Search</button>
        </span>

    </div>
</form>
