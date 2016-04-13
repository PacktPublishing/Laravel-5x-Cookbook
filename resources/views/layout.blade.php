<!DOCTYPE html>
<head>
    <title>ICDB: Internet Comic Database</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Google Font: Open Sans -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,800,800italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:400,300,700">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <!-- App CSS -->
    <link rel="stylesheet" href="/css/mvpready-landing.css">
    <link rel="stylesheet" href="/css/custom.css">
    <link href="/css/animate.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="./css/custom.css"> -->

    <meta name="theme-color" content="#ffffff">
</head>

<body class="">

<div id="wrapper">

    <header class="navbar" role="banner">

        <div class="container">

            <div class="navbar-header">
                <a href="/" class="navbar-brand">
                    <h1>ICDB</h1>
                </a>

                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="fa fa-bars"></i>
                </button>
            </div> <!-- /.navbar-header -->


            @include('nav_layout')

        </div> <!-- /.container -->

    </header>

    @include('title')

    <div class="row">
        <div class="container">
            @include('error')
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            @yield('header')
            @yield('content')
        </div>
    </div>

</div> <!-- /#wrapper -->

<footer class="footer">

    <div class="container">

        <div class="row">

            <div class="col-sm-3">

                <div class="heading-block">
                    <h4>ICDB</h4>
                </div> <!-- /.heading-block -->

                <p>Comics made searchable!</p>
            </div> <!-- /.col -->


            <div class="col-sm-3">

                <div class="heading-block">
                    <h4>Keep In Touch</h4>
                </div> <!-- /.heading-block -->

                <ul class="icons-list">
                    <li>
                        <i class="icon-li fa fa-envelope"></i>
                        <a href="mailto:info@icdb.com">info@icdb.com</a>
                    </li>
                </ul>
            </div> <!-- /.col -->


            <div class="col-sm-3">

                <div class="heading-block">
                    <h4>Connect With Us</h4>
                </div> <!-- /.heading-block -->

                <ul class="icons-list">

                    <li>
                        <i class="icon-li fa fa-twitter"></i>
                        <a href="https://twitter.com/icdb">Twitter</a>
                    </li>

                </ul>

            </div> <!-- /.col -->


            <div class="col-sm-3">

                <div class="heading-block">
                    <h4>Stay Updated</h4>
                </div> <!-- /.heading-block -->

                <p>Get emails about new theme launches &amp;  future updates.</p>

            </div> <!-- /.col -->

        </div> <!-- /.row -->

    </div> <!-- /.container -->

</footer>

<footer class="copyright">
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <p>Copyright &copy; 2015 <a href="https://alfrednutile.info"> &nbsp;Alfred Nutile, Inc</a></p>
            </div> <!-- /.col -->
        </div> <!-- /.row -->

    </div>
</footer>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Core JS -->
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>


<!-- App JS -->
<script src="/js/mvpready-core.js"></script>
<script src="/js/mvpready-helpers.js"></script>
<script src="/js/mvpready-landing.js"></script>

</body>
</html>