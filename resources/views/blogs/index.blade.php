@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>ICDB Latest News and Features</h1>
    </div>
@endsection

@section('content')
    <div class="content" >
        <div class="container">
            <div class="col-lg-12">
                <div class="posts">
                    @foreach($blogs as $blog)
                        <div class="post">

                            <div class="post-aside">
                                <div class="post-date">
                                    <span class="post-date-day">{{ $blog->created_at->day }}</span>
                                    <span class="post-date-month">{{ $blog->created_at->month }}</span>
                                    <span class="post-date-year">{{ $blog->created_at->year }}</span>
                                </div>
                            </div> <!-- /.post-aside -->

                            <div class="post-main">
                                <h3 class="post-title"><a href="/blogs/{{ $blog->url }}">{{ $blog->title }}</a></h3>

                                <div class="col-lg-3">
                                    @if($blog->image)
                                        <img src="/uploads/{{$blog->image}}" class="post-img img-responsive" alt="">
                                    @else
                                        <img src="/place_holder.png" class="post-img img-responsive" alt="">
                                    @endif
                                </div>

                                <div class="post-content">
                                    <p>{{ $blog->intro }}</p>
                                    <a href="/blogs/{{ $blog->url }}" class="btn btn-default">Read More...</a>

                                </div> <!-- /.post-content -->

                                @if(!Auth::guest() && Auth::user()->id == 1)
                                    <br>
                                    <div class="form-group">
                                        <a class="btn btn-primary" href="{{ route('blogs.show', $blog->id) }}">View</a>
                                        <a class="btn btn-warning " href="{{ route('blogs.edit', $blog->id) }}">Edit</a>
                                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="btn btn-danger" type="submit">Delete</button></form>
                                    </div>
                                @endif
                            </div> <!-- /.post-main -->



                        </div> <!-- /.post -->
                    @endforeach

                    {!! $blogs->render() !!}


                    <hr>

                    @if(!Auth::guest() && Auth::user()->id == 1)
                        <a class="btn btn-success" href="{{ route('blogs.create') }}">Create</a>
                    @endif

                </div>


            </div>
        </div>
    </div>

@endsection