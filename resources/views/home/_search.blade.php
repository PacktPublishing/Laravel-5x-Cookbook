<div ng-controller="MainController as vm">
    <form method="GET" class="form-horizontal" novalidate>
        <div class="input-group">
            <input type="text" name="name" class="form-control col-lg-10"
                   placeholder="Search for your comic..." ng-model="vm.search">
        <span class="input-group-btn">
            <input type="submit" class="btn btn-primary" ng-click="vm.searchFor()" ng-disabled="vm.disableSearch()">Search</input>
        </span>
        </div>
        <div class="help-block">You are going to search for ... @{{ vm.search }}</div>
        <div class="alert alert-info" ng-if="vm.searching">Searching for results will be right back...</div>
        <div class="alert alert-danger" ng-if="vm.error">Error getting results :( </div>
    </form>

    <div ng-repeat="result in vm.api_results.results">
        <div class="media">
            <div class="media-left col-lg-2 col-mg-2 col-sm-2">
                <a href="@{{ $result['urls'][0]['url']}}">foo</a>
            </div>
        </div>
    </div>

    @include('home._angular_search_results')
</div>
