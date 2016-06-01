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
            @if(Auth::user()->is_admin)
                <li class="dropdown ">
                    <a href="/admin/feature_flags">
                        Admin Feature Flags
                    </a>
                </li>

                <li class="dropdown ">
                    <a href="{{ route('admin.memberships') }}">
                        Admin Subscriptions
                    </a>
                </li>
            @endif
        @endif


        <li class="dropdown ">
            <a href="/subscribe">
                Support the Site!
            </a>
        </li>

        @if(Auth::guest())
            <li class="dropdown ">
                <a href="/login">
                    Login
                </a>
            </li>
        @endif


    </ul>

</nav>