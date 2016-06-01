@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1><i class="fa fa-group"></i> Admin Memberships</h1>
    </div>
@endsection

@section('content')
    <div ng-controller="ChartController as vm">
        <div google-chart chart="vm.myChartObject" style="height:400px; width:100%;"></div>

        @if($users->count())
            <table class="table table-condensed table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Plan</th>
                    <th>Created At</th>
                    <th>Ends At</th>
                    <th>Trail</th>
                </tr>
                </thead>

                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->subscriptions->first()->name}}</td>
                        <td>{{$user->subscriptions->first()->created_at->format('M d Y')}}</td>
                        <td>
                            @if($user->subscriptions->first()->ends_at)
                                {{ $user->subscriptions->first()->ends_at->format('M d Y') }}
                            @endif
                        </td>
                        <td>
                            @if($user->subscriptions->first()->trial_ends_at)
                                {{ $user->subscriptions->first()->trial_ends_at->format('M d Y') }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h3 class="text-center">No Subscriptions!</h3>
        @endif
    </div>
@endsection