@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">

                @include('home._search')
                <hr>

                <div class="panel panel-default">
                    <div class="panel-heading">Find some comics!</div>
                    <div class="panel-body">
                        @if(empty($results['results']))
                            <p>What are you waiting for?</p>
                        @else
                            @foreach($results['results'] as $result)
                                <div class="media">
                                    <div class="media-left col-lg-2 col-mg-2 col-sm-2">
                                        <a href="{{ $result['urls'][0]['url']}}">
                                            @if(isset($result['thumbnail']['path']))
                                                <img class="media-object img-thumbnail img-responsive"
                                                     src="{{ $result['thumbnail']['path'] . '.' .  $result['thumbnail']['extension']}}"
                                                     alt="...">
                                            @else
                                                <img class="media-object" src="/images/placeholder.jpg" alt="...">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{ $result['title'] }}</h4>
                                        {{ $result['description'] }} <a
                                                href="{{ $result['urls'][0]['url']}}">more...</a>
                                    </div>
                                </div>
                            @endforeach

                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection