(function(){
    'use strict';

    angular.module('app', ['ui.bootstrap']);

    MainController.$inject = ['$http', '$httpParamSerializer', '$window'];

    function MainController($http, $httpParamSerializer, $window)
    {
        var vm = this;
        vm.hello = "Hello Angular";
        vm.search = '';
        vm.searchFor = searchFor;
        vm.disableSearch = disableSearch;
        vm.searching = false;
        vm.error = false;
        vm.api_results = {};
        vm.currentPage = 1;
        vm.smallnumPages = 0;
        vm.maxSize = 10;
        vm.offset = 0;
        vm.totalPerRequest = 20;
        vm.paginate = paginate;

        activate();

        function activate()
        {
            console.log("Here is angular");
            vm.api_results = $window.api_results;
            console.log(vm.api_results);
            vm.smallnumPages = vm.api_results.total / vm.api_results.limit;
        }

        function disableSearch()
        {
            return vm.search.length < 3;
        }
        
        function searchFor() {
            searchApiForComics(vm.search);
        }

        function paginate()
        {
            searchApiForComics();    
        }
        
        /**
         * @NOTE we can pull this out into a service as well
         */
        function searchApiForComics()
        {
            vm.offset = (vm.currentPage - 1) * vm.totalPerRequest;
            vm.searching = true;
            vm.error = false;
            var query = $httpParamSerializer({ 'name': vm.search });

            var req = {
                'headers': {
                    'Content-Type': 'application/json',
                    'charset': 'utf-8',
                    'Accept': 'application/json'
                },
                'method': 'GET',
                'data': [],
                'url': '/api/v1/search?offset=' + vm.offset + '&' + query
            };

            $http(req).success(function(response) {
                    console.log(response);
                    vm.searching = false;
                    vm.api_results = response.data;
                })
                .error(function(response) {
                    console.log("Error getting results");
                    vm.error = true;
                    vm.searching = false;
                    console.log(response);
                });
        }
    }


    angular.module('app')
        .controller('MainController', MainController);

})();