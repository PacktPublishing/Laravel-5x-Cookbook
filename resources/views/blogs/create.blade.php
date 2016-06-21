@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Blogs / Create </h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('blogs.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                @include('blogs._form')
            </form>

        </div>
    </div>
@endsection

