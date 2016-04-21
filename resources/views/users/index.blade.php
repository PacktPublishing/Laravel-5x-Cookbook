@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="fa fa-group"></i> Users
        </h1>
        <p>
            <a class="btn btn-success pull-right" href="{{ route('users.create') }}"><i
                        class="glyphicon glyphicon-plus"></i> Create</a>
        </p>
    </div>
@endsection

@section('content')
    @if($users->count())
        <table class="table table-condensed table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th class="text-right">OPTIONS</th>
            </tr>
            </thead>

            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td class="text-right">
                        <a class="btn btn-xs btn-primary" href="{{ route('users.show', $user->id) }}">
                            <i class="fa fa-eye"></i> View</a>
                        <a class="btn btn-xs btn-warning" href="{{ route('users.edit', $user->id) }}">
                            <i class="fa fa-edit"></i> Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;"
                              onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $users->render() !!}
    @else
        <h3 class="text-center">Empty!</h3>
    @endif


@endsection