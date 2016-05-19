var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix
        .styles(
            [
                "vendor/*.css", 
                "core/bootstrap.min.css",
                "custom/custom.css"
            ], "public/css/all.css")
        .scripts(
            [
                "core/jquery-1.12.3.js",
                "core/angular.js",
                "core/angular-animate.js",
                "core/bootstrap.min.js",
                "core/ui-bootstrap.js",
                "vendor/*.js",
                "custom/app.js"
            ], "public/js/all.js")
        .version( ["css/all.css", "js/all.js"]);
});