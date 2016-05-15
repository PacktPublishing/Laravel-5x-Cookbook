<div class="panel panel-default">
    <div class="panel-heading">Find some comics!</div>
    <div class="panel-body">

        <div ng-repeat="result in vm.api_results.results">
            <div class="media">
                <div class="media-left col-lg-2 col-mg-2 col-sm-2">
                    <a href="@{{ $result['urls'][0]['url']}}">
                        <img ng-if="result['thumbnail']['path']" class="media-object img-thumbnail img-responsive"
                             src="@{{ result['thumbnail']['path'] + '.' + result['thumbnail']['extension']}}"
                             alt="...">
                        <img ng-if="!result['thumbnail']['path']" class="media-object" src="/images/placeholder.jpg"
                             alt="...">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">@{{ result['title'] }}</h4>
                    @{{ result['description'] }} <a
                            href="@{{ result['urls'][0]['url']}}">more...</a>
                </div>
            </div>
        </div>
    </div>
</div>