<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="#">
            <img src="{{ asset('assets/images/logo.gif') }}" alt="logo">
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block">@yield('title')</li>
        </ul>
        @php
            $message = '';
            foreach ($dates as $key => $value) {
                $dePluralized = substr($key,0,strlen($key)-1);
                $message .= ($value > 0)? ($value < 2)? "<b>$value </b>$dePluralized ": "<b>$value </b>$key ": '';
            }
        @endphp
        <div class="work-duration-wrapper">
            <span class="">{!!$message!!}</span>
        </div>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
                    aria-expanded="false">
                    <img class="img-xs rounded-circle"
                        src='{{ empty($user->emp_image) ? asset("assets/images/faces/profile/default.png")  : $user->emp_image }}'
                        alt="Profile image"> </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <img class="img-md rounded-circle"
                            src='{{ empty($user->emp_image) ? asset("assets/images/faces/profile/default.png")  :$user->emp_image }}'
                            alt="Profile image">
                        <p class="mb-1 mt-3 font-weight-semibold">{{ $user->first_name .' '. $user->last_name }}</p>
                        <p class="font-weight-light text-muted mb-0">{{ $user->email }}</p>
                    </div>
                    <a class="dropdown-item" href="{{route('user.profile')}}">My Profile</a>
                    <a href="javascript:void(0)" onclick="$('#logout-form').submit();" class="dropdown-item">Sign
                        Out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
<div class="small-screen-only">
    <button class="navbar-toggler navbar-toggler-right align-self-center sidebar-burger" type="button" data-toggle="offcanvas">
        <div class="navigation button-collapse">
            <input type="checkbox" id="burger_toggle" name="">
            <span class="burger-span bs-top"></span>
            <span class="burger-span bs-bottom"></span>
            <span class="burger-span bs-middle"></span>
        </div>
    </button>
</div>
