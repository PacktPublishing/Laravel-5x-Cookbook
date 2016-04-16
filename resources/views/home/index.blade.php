@extends('layout')



@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">

                @include('error')

                @include('home._search')

                <hr>
                
                <div class="panel panel-default">
                    <div class="panel-heading">Find some comics!</div>
                    <div class="panel-body">
                        What are you waiting for?
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection