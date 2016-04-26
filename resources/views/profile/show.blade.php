@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Your Profile</div>
                    <div class="panel-body">

                        <ul class="list-unstyled">
                            <li>
                                <H4>Favorite Comic Character: {{ $profile->favorite_comic_character }}</H4>
                            </li>

                            <li><h4>Who are you?:</h4> <br>
                                @if($profile->profile_image == true)
                                    <img src="/{{Auth::user()->id}}/example_profile.jpg" alt="" class="img-thumbnail img-responsive">
                                @endif
                            </li>
                            <li>
                                <a href="{{ route('profile.edit') }}" class="btn btn-default">edit</a>
                            </li>
                        </ul>
                
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection