<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="{{ route('home') }}" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- User details -->
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <i class="fas fa-user"></i>
                <span class="d-none d-md-inline">{{ auth()->user()->getFullname() }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header">
                    <img src="{{ asset('images/user.jpeg') }}" class="img-circle elevation-2" alt="User Image">
                    <p>
                        {{ auth()->user()->getFullname() }}
                        <small>{{ auth()->user()->username }}</small>
                        <small>{{ auth()->user()->email }}</small>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="float-right">
                        <a href="#" class="btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
                    </div>
                </li>

                <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                    @csrf
                </form>
            </ul>
        </li>
    </ul>

    <style>
            .btn {
            background-color: #5541D7;
            color: #fff;
            font-family: 'Roboto', sans-serif;
            border: 1px solid #5541D7; /* Add an outline */
            }

            /* Button hover styles */
            .btn:hover {
                background-color: #fff;
                color: #5541D7;
                border: 1px solid #5541D7; /* Add an outline */
            }
    </style>
</nav>
<!-- /.navbar -->
