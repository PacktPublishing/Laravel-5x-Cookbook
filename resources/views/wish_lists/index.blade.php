@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="fa fa-list"></i> Your WishList
            <a class="btn btn-success pull-right" href="{{ route('wish_lists.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($wish_lists->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>Comic Info</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($wish_lists as $wish_list)
                            <tr>
                                <td>{{$wish_list->comic_data}}</td>
                                <td class="text-right">
                                    <form action="{{ route('wish_lists.destroy', $wish_list->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $wish_lists->render() !!}
            @else
                <h3 class="text-center alert alert-info">No Wishes :(</h3>
            @endif

        </div>
    </div>

@endsection