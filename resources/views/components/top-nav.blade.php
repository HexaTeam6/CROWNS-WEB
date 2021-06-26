<!-- Topnav -->
<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            <ul class="navbar-nav align-items-center  ml-auto ml-md-auto ">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
                            <div class="media-body  ml-2  d-none d-lg-block">
                                <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->admin ? Auth::user()->admin->nama : 'Account' }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu  dropdown-menu-right ">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome!</h6>
                        </div>
                        <a href="{{ route('profile') }}" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>My profile</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <form role="form" method="POST" action="{{ route('logout') }}" class="dropdown-item">
                            @csrf
                            <i class="ni ni-user-run"></i>
                            <input type="submit" name="send" value="Log out" style="border:none; background:none;">
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>