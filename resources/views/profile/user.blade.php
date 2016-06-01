@extends('layout')

@section('content')

    <div class="row clearfix">
        <div class="col-md-10 col-lg-offset-1 column">


            @include('stripe.status')

            @include('stripe.history')



            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <a class="btn btn-success" href="{{ route('profile') }}">
                                <i class="fa fa-user"></i>&nbsp;Profile</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>

@endsection
