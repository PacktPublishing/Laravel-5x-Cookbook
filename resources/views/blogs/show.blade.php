@extends('layout')
@section('header')
<div class="page-header">
        <h1>{{ $blog->title }}</h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div>
                {!! $blog->html !!}
            </div>


            <a class="btn btn-link" href="{{ route('blogs.index') }}"><i class="glyphicon glyphicon-backward"></i>
                Back to all Blog Posts</a>

        </div>
    </div>

@endsection