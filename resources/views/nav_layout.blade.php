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
            <li class="dropdown ">
                <a href="/profile">
                    Profile
                </a>
            </li>
            <li class="dropdown ">
                <a href="/admin/feature_flags">
                    Admin Feature Flags
                </a>
            </li>
        @endif

        @if(Auth::guest())
            <li class="dropdown ">
                <a href="/login">
                    Login
                </a>
            </li>
        @endif


    </ul>

</nav>