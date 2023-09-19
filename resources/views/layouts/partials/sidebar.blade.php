<aside class="main-sidebar elevation-4" style="background-color: #fff;">
<script src="https://kit.fontawesome.com/f83c02dda9.js" crossorigin="anonymous"></script>

    <a href="#" class="brand-link">
        <img src="{{ asset('images/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light" style="font-family: 'Roboto', sans-serif; color: #333; font-size: 20px;">{{ config('app.name') }}</span>
    </a>

    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                @hasanyrole('superadmin|admin')
                <li class="nav-item {{ 'admin' == request()->path() ? 'menu-open active' : '' }}">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-chart-simple {{ 'admin' == request()->path() ? 'active' : '' }}"></i>
                        <p style="font-family: 'Roboto', sans-serif; {{ 'admin' == request()->path() ? 'color: #5541D7;' : '' }} font-size: 16px;">Dashboard</p>
                    </a>
                </li>
                @endhasanyrole

                <!-- Categories -->
                @hasanyrole('superadmin|admin|inventory')
                <li class="nav-item {{ 'categories' == request()->path() ? 'menu-open active' : '' }}">
                    <a href="{{ route('categories.index') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-tag {{ 'categories' == request()->path() ? 'active' : '' }}"></i>
                        <p style="font-family: 'Roboto', sans-serif; {{ 'categories' == request()->path() ? 'color: #5541D7;' : '' }} font-size: 16px;">Kategori</p>
                    </a>
                </li>
                @endhasanyrole

                <!-- Products -->
                @hasanyrole('superadmin|admin|inventory')
                <li class="nav-item {{ 'products' == request()->path() ? 'menu-open active' : '' }}">
                    <a href="{{ route('products.index') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-box-open {{ 'products' == request()->path() ? 'active' : '' }}"></i>
                        <p style="font-family: 'Roboto', sans-serif; {{ 'products' == request()->path() ? 'color: #5541D7;' : '' }} font-size: 16px;">Produk</p>
                    </a>
                </li>
                @endhasanyrole

                <!-- Cashier -->
                @hasanyrole('superadmin|cashier')
                <li class="nav-item {{ 'cart' == request()->path() ? 'menu-open active' : '' }}">
                    <a href="{{ route('cart.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-calculator {{ 'cart' == request()->path() ? 'active' : '' }}"></i>
                        <p style="font-family: 'Roboto', sans-serif; {{ 'cart' == request()->path() ? 'color: #5541D7;' : '' }} font-size: 16px;">Kasir</p>
                    </a>
                </li>
                @endhasanyrole

                <!-- Sales Orders -->
                @hasanyrole('superadmin|admin|cashier')
                <li class="nav-item {{ 'orders' == request()->path() ? 'menu-open active' : '' }}">
                    <a href="{{ route('orders.index') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-cart-flatbed {{ 'orders' == request()->path() ? 'active' : '' }}"></i>
                        <p style="font-family: 'Roboto', sans-serif; {{ 'orders' == request()->path() ? 'color: #5541D7;' : '' }} font-size: 16px;">Penjualan</p>
                    </a>
                </li>
                @endhasanyrole

                <!-- Users -->
                @hasrole('superadmin')
                <li class="nav-item {{ 'users' == request()->path() ? 'menu-open active' : '' }}">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user {{ 'users' == request()->path() ? 'active' : '' }}"></i>
                        <p style="font-family: 'Roboto', sans-serif; {{ 'users' == request()->path() ? 'color: #5541D7;' : '' }} font-size: 16px;">Users</p>
                    </a>
                </li>
                @endhasrole

                <!-- Customers -->
                @hasanyrole('')
                <li class="nav-item {{ 'customers' == request()->path() ? 'menu-open active' : '' }}">
                    <a href="{{ route('customers.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users {{ 'customers' == request()->path() ? 'active' : '' }}"></i>
                        <p style="font-family: 'Roboto', sans-serif; {{ 'customers' == request()->path() ? 'color: #5541D7;' : '' }} font-size: 16px;">Pelanggan</p>
                    </a>
                </li>
                @endhasanyrole

                <!-- Settings -->
                @hasrole('superadmin')
                <li class="nav-item {{ 'settings' == request()->path() ? 'menu-open active' : '' }}">
                    <a href="{{ route('settings.index') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-gears {{ 'settings' == request()->path() ? 'active' : '' }}"></i>
                        <p style="font-family: 'Roboto', sans-serif; {{ 'settings' == request()->path() ? 'color: #5541D7;' : '' }} font-size: 16px;">Pengaturan</p>
                    </a>
                </li>
                @endhasrole

            </ul>
        </nav>
    </div>
</aside>

<style>
    .nav-link:hover {
        color: #5541D7 !important;
    }

    .nav-link:hover i {
        color: #5541D7 !important;
    }

    .nav-item.active > .nav-link {
        color: #5541D7 !important;
    }

    .nav-item.active > .nav-icon {
        color: #5541D7 !important;
    }
</style>
