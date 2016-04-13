
@extends('layout')

@section('content')

    @include('masthead')

    <div class="content">
        @include('features')

        @include('benefits')

        <!-- testimonials -->

        <section id="section-contact" class="home-section" style="background-color: #f3f3f3;">

            <div class="container">

                <div class="heading-block heading-minimal heading-center">
                    <h1>
                        Questions?
                    </h1>
                </div> <!-- /.heading-block -->

                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <p class="text-center text-xl">
                            <em>Send us your questions!</em>
                            <br><br>
                            <a href="/contact" class="btn btn-primary btn-lg">Send us an email</a>
                        </p>
                    </div>
                </div>
                <br><br>

            </div> <!-- /.container -->

        </section>

    </div> <!-- /.content -->

@endsection

