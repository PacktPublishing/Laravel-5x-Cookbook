<form action="{{ route('home') }}" method="GET" class="form-horizontal" ng-controller="MainController as vm">
    <div class="input-group">
        <input type="text" name="name" class="form-control col-lg-10"
               placeholder="Search for your comic...">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Search</button>
        </span>
    </div>
    <div class="help-block">@{{ vm.hello }}</div>
</form>
