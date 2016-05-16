@extends('layout')

@section('content')
    <div class="container" ng-controller="MainController as vm">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Find some comics!</div>
                    <div class="panel-body">
                        <uib-tabset active="active">
                            <uib-tab index="0" >
                                <uib-tab-heading>
                                    <i class="fa fa-search"></i> Search Results
                                </uib-tab-heading>
                                @include('home._search')
                            </uib-tab>

                            <uib-tab index="2">
                                <uib-tab-heading>
                                    <i class="fa fa-star"></i> Favorites
                                </uib-tab-heading>

                                @include('home._favorites')

                            </uib-tab>
                        </uib-tabset>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection