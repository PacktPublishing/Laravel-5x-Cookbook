<div ng-repeat="result in vm.api_results.results">
    <div class="media">
        <div class="media-left col-lg-2 col-mg-2 col-sm-2">
            <a href="@{{ $result['urls'][0]['url']}}">foo</a>
        </div>
    </div>
</div>