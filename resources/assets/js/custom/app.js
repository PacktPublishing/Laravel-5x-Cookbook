(function(){
    'use strict';

    angular.module('app', ['ui.bootstrap', 'ngAnimate', 'toastr', 'googlechart']);

    ChartController.$inject = ['$window'];

    function ChartController($window) {
        var vm = this;
        vm.myChartObject = {};


        activate();

        function activate()
        {
            myChartObject();
        }

        function myChartObject()
        {

            var levels = $window.levels;

            vm.myChartObject = {};

            vm.myChartObject.type = "PieChart";

            vm.myChartObject.data = {"cols": [
                {id: "t", label: "Name", type: "string"},
                {id: "s", label: "Total", type: "number"}
            ], "rows": [
                {c: [
                    {v: levels.level1.name},
                    {v: levels.level1.total}
                ]},
                {c: [
                    {v: levels.level2.name},
                    {v: levels.level2.total}
                ]},
                {c: [
                    {v: levels.fan.name},
                    {v: levels.fan.total}
                ]}
            ]};

            vm.myChartObject.options = {
                'title': 'Memberships'
            };
        }
    }


    MainController.$inject = ['$http', '$httpParamSerializer', '$window', 'toastr'];

    function MainController($http, $httpParamSerializer, $window, toastr)
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
        vm.favorite = favorite;
        vm.favorites = [];
        vm.favoriteRemove = favoriteRemove;

        activate();

        function activate()
        {
            console.log("Here is angular");
            vm.api_results = $window.api_results;

            console.log(vm.api_results);

            vm.smallnumPages = vm.api_results.total / vm.api_results.limit;
            vm.favorites = $window.user.favorites;
            console.log(vm.favorites);
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

        function favoriteRemove(comic_id, index) {

            var req = {
                'headers': {
                    'Content-Type': 'application/json',
                    'charset': 'utf-8',
                    'Accept': 'application/json'
                },
                'method': 'DELETE',
                'data': [],
                'url': '/api/v1/favorite/' + comic_id
            };

            $http(req).success(function(response) {

                    //Was having an issue with splice off
                    //so resorted to this for now
                    toastr.success('Removed Favorite');
                    angular.forEach(vm.favorites, function(v,i) {
                        if(i == index)
                        {
                            vm.favorites.splice(i, 1);
                        }
                    })
                })
                .error(function(response) {
                    vm.error = true;
                });
        }

        function favorite(comic)
        {
            toastr.success('Adding Favorite');

            var req = {
                'headers': {
                    'Content-Type': 'application/json',
                    'charset': 'utf-8',
                    'Accept': 'application/json'
                },
                'method': 'POST',
                'data': { 'comic': comic },
                'url': '/api/v1/favorite'
            };

            $http(req).success(function(response) {
                    toastr.success('Added Favorite');

                    vm.favorites.push(response.data);
                })
                .error(function(response) {
                    toastr.error('Error Adding Favorite', 'Error');

                    angular.forEach(response, function(v, i) {

                        angular.forEach(v, function(message, index) {
                            toastr.error(message, 'Error');
                        })

                    });

                    vm.error = true;
                });
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
        .controller('MainController', MainController)
        .controller('ChartController', ChartController);

})();