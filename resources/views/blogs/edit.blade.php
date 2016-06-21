@extends('layout')
@section('header')
    <div class="page-header">
        <h1><i class="fa fa-edit"></i> Blogs / Edit #{{$blog->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @include('blogs._form')
            </form>

        </div>
    </div>
@endsection

