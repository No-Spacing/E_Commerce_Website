
<div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
    <a class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-5 d-none d-sm-inline">Menu</span>
    </a>
    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">

        <li>
            <a href="{{ route('admin.home') }}" class="nav-link px-0 align-middle">
                <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
            </a>
        </li>
        
        <li>
            <a href="{{ route('admin.ad.banner') }}" class="nav-link px-0 align-middle">
                <i class="fs-4 bi-badge-ad"></i> <span class="ms-1 d-none d-sm-inline">Banner</span>
            </a>
        </li>

        <li>
            <a href="{{ route('admin.sales') }}" class="nav-link px-0 align-middle">
                <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Sales</span>
            </a>
        </li>

        <li>
            <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Products</span>
            </a>
            <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                <li class="w-100">
                    <a href="{{ route('admin.add.products') }}" class="nav-link px-3"> <span class="d-none d-sm-inline">Add Product</span></a>
                </li>
                <li>
                    <a href="{{ route('admin.product.list') }}" class="nav-link px-3"> <span class="d-none d-sm-inline">List of Products</span></a>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{ route('admin.customer') }}" class="nav-link px-0 align-middle">
                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span> </a>
        </li>

    </ul>
    
    <hr>
    <div class="dropdown pb-4">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('img/brigada-icon.png') }}" alt="hugenerd" width="30" height="30" class="rounded-circle">
            <span class="d-none d-sm-inline mx-1">Brigada</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <!-- <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li>
                <hr class="dropdown-divider">
            </li> -->
            <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Sign out</a></li>
        </ul>
    </div>
</div>
   