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
                                <td>

                                    <div class="media">
                                        <div class="media-left col-lg-2 col-mg-2 col-sm-2">
                                            <a href="{{ $wish_list->comic_data['urls'][0]['url']}}">
                                                @if(isset($wish_list->comic_data['thumbnail']['path']))
                                                    <img class="media-object img-thumbnail img-responsive"
                                                         src="{{ $wish_list->comic_data['thumbnail']['path'] . '.' .  $wish_list->comic_data['thumbnail']['extension']}}"
                                                         alt="...">
                                                @else
                                                    <img class="media-object" src="/images/placeholder.jpg" alt="...">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">{{ $wish_list->comic_data['title'] }}</h4>
                                            {{ $wish_list->comic_data['description'] }} <a
                                                    href="{{ $wish_list->comic_data['urls'][0]['url']}}">more...</a>
                                        </div>
                                    </div>

                                </td>
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