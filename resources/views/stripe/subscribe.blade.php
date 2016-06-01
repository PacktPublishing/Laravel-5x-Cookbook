@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="fa fa-money"></i> Sign up for membership</h1>
    </div>
@endsection


@section('content')

    <div role="tabpanel">


        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="monthly">
                @include('stripe.monthly')
            </div>
        </div>

    </div>


@endsection
