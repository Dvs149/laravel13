<header class="nxl-header">
        <div class="header-wrapper">
            
            <!--! [Start] Header Right !-->
            <div class="header-right ms-auto">
                <div class="d-flex align-items-center">
                    <div class="dropdown nxl-h-item">
                        <a href="javascript:void(0);" data-bs-toggle="dropdown" role="button" data-bs-auto-close="outside">
                            <img src="{{ asset('assets/images/avatar/1.jpg') }}" alt="user-image" class="img-fluid user-avtar me-0" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-user-dropdown">
                            <div class="dropdown-header">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('assets/images/avatar/1.jpg') }}" alt="user-image" class="img-fluid user-avtar" />
                                    <div>
                                        <h6 class="text-dark mb-0">{{auth()->user()->name}} <span class="badge bg-soft-success text-success ms-1">PRO</span></h6>
                                        <span class="fs-12 fw-medium text-muted">{{auth()->user()->email}}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">
                                    <i class="feather-log-out"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--! [End] Header Right !-->
        </div>
    </header>