@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="fa fa-user"></i> Profile Edit</h1>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-8 col-lg-offset-2">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('profile_image')) has-error @endif">
                    <label for="profile_image">Profile Image</label>
                    <input type="file" id="profile_image" name="profile_image"/>
                    <p>Upload your image?</p>
                    @if($errors->has("profile_image"))
                        <span class="help-block">{{ $errors->first("profile_image") }}</span>
                    @endif
                </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('profile') }}"><i class="fa fa-backward"></i>  Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection