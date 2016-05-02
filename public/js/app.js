(function(){
    'use strict';

    angular.module('app', []);


    function MainController()
    {
        var vm = this;
        vm.hello = "Hello Angular";

        activate();

        function activate()
        {
            console.log("Here is angular");
        }

    }

    angular.module('app')
        .controller('MainController', MainController);

})();