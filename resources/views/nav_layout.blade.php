<nav class="collapse navbar-collapse" role="navigation">

    <ul class="nav navbar-nav navbar-right mainnav-menu">

        <li class="dropdown ">
            <a href="/about">
                About
            </a>
        </li>

        @if(!Auth::guest())
            <li class="dropdown ">
            <a href="/wish_lists">
                Wish List
            </a>
        </li>
        @endif

        <li class="dropdown ">
            <a href="/login">
                Login
            </a>
        </li>


    </ul>

</nav>