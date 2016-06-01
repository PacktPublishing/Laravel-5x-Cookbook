@extends('layout')

@section('header')

    <h1>Example here</h1>
@endsection

@section('content')



    <h1>{{ $data['label'] }}</h1>
    <h2>{{ $data['value'] }}</h2>


@endsection

