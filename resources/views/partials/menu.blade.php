<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/addresses*") ? "menu-open" : "" }} {{ request()->is("admin/payments*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('address_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.addresses.index") }}" class="nav-link {{ request()->is("admin/addresses") || request()->is("admin/addresses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-home">

                                        </i>
                                        <p>
                                            {{ trans('cruds.address.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('payment_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.payments.index") }}" class="nav-link {{ request()->is("admin/payments") || request()->is("admin/payments/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-invoice-dollar">

                                        </i>
                                        <p>
                                            {{ trans('cruds.payment.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('site_specific_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/newsletters*") ? "menu-open" : "" }} {{ request()->is("admin/minute-datas*") ? "menu-open" : "" }} {{ request()->is("admin/todos*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.siteSpecific.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('newsletter_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.newsletters.index") }}" class="nav-link {{ request()->is("admin/newsletters") || request()->is("admin/newsletters/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-newspaper">

                                        </i>
                                        <p>
                                            {{ trans('cruds.newsletter.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('minute_data_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.minute-datas.index") }}" class="nav-link {{ request()->is("admin/minute-datas") || request()->is("admin/minute-datas/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-bookmark">

                                        </i>
                                        <p>
                                            {{ trans('cruds.minuteData.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('todo_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.todos.index") }}" class="nav-link {{ request()->is("admin/todos") || request()->is("admin/todos/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-check-circle">

                                        </i>
                                        <p>
                                            {{ trans('cruds.todo.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('amenity_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/boats*") ? "menu-open" : "" }} {{ request()->is("admin/stickers*") ? "menu-open" : "" }} {{ request()->is("admin/reservations*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-table">

                            </i>
                            <p>
                                {{ trans('cruds.amenity.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('boat_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.boats.index") }}" class="nav-link {{ request()->is("admin/boats") || request()->is("admin/boats/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-ship">

                                        </i>
                                        <p>
                                            {{ trans('cruds.boat.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('sticker_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.stickers.index") }}" class="nav-link {{ request()->is("admin/stickers") || request()->is("admin/stickers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tags">

                                        </i>
                                        <p>
                                            {{ trans('cruds.sticker.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('reservation_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.reservations.index") }}" class="nav-link {{ request()->is("admin/reservations") || request()->is("admin/reservations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-calendar-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.reservation.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>