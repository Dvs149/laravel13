<nav class="nxl-navigation">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="{{ route('admin.dashboard') }}" class="b-brand">
                    <!-- ========   change your logo hear   ============ -->
                    <img src="{{ asset('assets/images/logo-full.png') }}" alt="" class="logo logo-lg" />
                    <img src="{{ asset('assets/images/logo-abbr.png') }}" alt="" class="logo logo-sm" />
                </a>
            </div>
            <div class="navbar-content">
                <ul class="nxl-navbar">
                    <li class="nxl-item nxl-caption">
                        <label>Navigation</label>
                    </li>
                    <li class="nxl-item"><a class="nxl-link" href="{{ auth()->user()->role=== 'admin' ? route('admin.dashboard') : route('dashboard') }}"><span class="nxl-micon">Dashboard</span></a></li>
                    <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.customers.index') }}"><span class="nxl-micon">Customer</span></a></li>
                    
                    <!-- <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-airplay"></i></span>
                            <span class="nxl-mtext">Dashboards</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="index.html">CRM</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="analytics.html">Analytics</a></li>
                        </ul>
                    </li> -->
                    
                </ul>
            </div>
        </div>
    </nav>