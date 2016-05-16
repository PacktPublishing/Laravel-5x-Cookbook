<div ng-repeat="favorite in vm.api_results.results.user.favorites">
    <div class="media">
        <div class="media-left col-lg-2 col-mg-2 col-sm-2">
            <a href="@{{ favorite.comic['urls'][0]['url']}}">
                <img ng-if="favorite.comic['thumbnail']['path']" class="media-object img-thumbnail img-responsive"
                     src="@{{ favorite.comic['thumbnail']['path'] + '.' + favorite.comic['thumbnail']['extension']}}"
                     alt="...">
                <img ng-if="!favorite.comic['thumbnail']['path']" class="media-object" src="/images/placeholder.jpg"
                     alt="...">
            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading">@{{ favorite.comic['title'] }}</h4>
            @{{ favorite.comic['description'] }} <a
                    href="@{{ favorite.comic['urls'][0]['url']}}">more...</a>
        </div>
    </div>
</div>
<div class="alert alert-success" ng-if="!vm.api_results.results.user.favorites"><i class="fa fa-lightbulb-o"></i>&nbsp; No Favorites :( go find some! </div>