<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="burger-wrapper wide-screen-only">
        <button class="navbar-toggler navbar-toggler-right align-self-center sidebar-burger" type="button" data-toggle="offcanvas" id="sidebar_burger" onclick="toggleSidebar()">
            <div class="navigation button-collapse">
                <input type="checkbox" id="burger_toggle" name="">
                <span class="burger-span bs-top"></span>
                <span class="burger-span bs-bottom"></span>
                <span class="burger-span bs-middle"></span>
            </div>
        </button>
    </div>
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="{{ route('user.profile') }}" class="nav-link">
                <div class="profile-image">
                    <img class="img-mdm rounded-circle"
                        src='{{ empty($user->emp_image) ? asset("assets/images/faces/profile/default.png")  : $user->emp_image  }}'
                        alt="profile image">
                </div>
                <div class="text-wrapper sidebar-active-user-name">
                    <p class="profile-name" title="{{ $user->first_name.' '.$user->last_name }}">
                        {{ $user->first_name.' '.$user->last_name }}
                    </p>
                    <p class="designation">
                        {{ str_replace('_', ' ', M_Employee::ROLE[$user->user_role]) }}
                    </p>
                </div>
            </a>
        </li>
        <li class="nav-item" id="today-side-menu">
            <a class="nav-link" href="{{route('home')}}">
                <i class="fa fa-pencil fa-lg"></i>
                <span class="menu-title">Today's Tracker</span>
            </a>
        </li>
        <li class="nav-item" id="mytracker-side-menu">
            <a class="nav-link" href="{{route('user.tracker')}}">
                <i class="fa fa-list-alt fa-lg"></i>
                <span class="menu-title">My Tracker</span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="nav-item" id="calendar-side-menu">
            <a class="nav-link" href="{{ route('calendar.list') }}">
                <i class="fa fa-calendar fa-lg"></i>
                <span class="menu-title">My Calendar Tracker</span>
            </a>
        </li>
        @if($user->user_role == array_search('ADMIN', M_Employee::ROLE) || $user->user_role ==
        array_search('REPORT_MANAGER', M_Employee::ROLE))
        <li class="nav-item" id="attendance-side-menu">
            <a class="nav-link" href="{{ route('attendance.list') }}">
                <i class="fa fa-address-book-o fa-lg"></i>
                <span class="menu-title">Attendances</span>
            </a>
        </li>
        <li class="nav-item" id="emp-side-menu">
            <a class="nav-link" href="{{ route('employee.list')}}">
                <i class="fa fa-user-o fa-lg"></i>
                <span class="menu-title">Employee</span>
            </a>
        </li>
        @endif
        @if($user->user_role == array_search('WFM', M_Employee::ROLE))
        <li class="nav-item" id="attendance-side-menu">
            <a class="nav-link" href="{{ route('attendance.list') }}">
                <i class="fa fa-address-book-o fa-lg"></i>
                <span class="menu-title">Attendances</span>
            </a>
        </li>
        @endif
        @if($user->user_role == array_search('ADMIN', M_Employee::ROLE))
        <li class="nav-item" id="account-side-menu">
            <a class="nav-link" href="{{ route('account.list')}}">
                <i class="fa fa-users fa-lg"></i>
                <span class="menu-title">Accounts</span>
            </a>
        </li>
        <li class="nav-item" id="sched-side-menu">
            <a class="nav-link" href="{{ route('schedule.list')}}">
                <i class="fa fa-calendar-check-o fa-lg"></i>
                <span class="menu-title">Schedules</span>
            </a>
        </li>
        <li class="nav-item" id="leaves-side-menu">
            <a class="nav-link" href="{{ route('leaves.list')}}">
                <i class="fa fa-podcast fa-lg"></i>
                <span class="menu-title">Leaves</span>
            </a>
        </li>
        @endif
        @if($user->user_role != array_search('USER', M_Employee::ROLE))
        <li class="nav-item" id="overbreak-side-menu">
            <a class="nav-link" href="{{ route('overbreak.list')}}">
                <i class=" test fa fa-clock-o fa-lg"></i>
                <span class="menu-title">Over Breaks</span>
            </a>
        </li>
        @endif
        @if($user->user_role == array_search('ADMIN', M_Employee::ROLE))
        <li class="nav-item" id="logs-side-menu">
            <a class="nav-link" href="{{ route('logs')}}">
                <i class="fa fa-file-text-o fa-lg"></i>
                <span class="menu-title">Logs</span>
            </a>
        </li>
        @endif
        @if($user->user_role == array_search('ADMIN', M_Employee::ROLE))
        <li class="nav-item" id="holiday-side-menu">
            <a class="nav-link" href="{{ route('calendar.holidayList')}}">
                <i class="fa fa-calendar-times-o fa-lg"></i>
                <span class="menu-title">Holidays</span>
            </a>
        </li>
        @endif
        @if($user->user_role == array_search('ADMIN', M_Employee::ROLE))
        <li class="nav-item" id="client-info-side-menu">
            <a class="nav-link" href="{{ route('client.list')}}">
                <i class="fa fa-laptop fa-lg"></i>
                <span class="menu-title">Client Info</span>
            </a>
        </li>
        @endif
        <div class="logout-media-query">
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)" onclick="$('#logout-form').submit();">
                    <i class=" test fa fa-sign-out fa-lg"></i>
                    <span class="menu-title" id="">Logout</span>
                </a>
            </li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </div>
    </ul>
</nav>
<!-- ALL js, script declare here -->
