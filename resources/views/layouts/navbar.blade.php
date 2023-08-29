<nav id="navbar_top" class="navbar navbar-expand-lg d-flex flex-column fixed-top">
    <div class="container-fluid d-inline-flex justify-content-between nav-background pt-2 px-4 pb-3">
        <div class="">
            <a class="navbar-brand fs-3 fw-bold d-flex align-items-center" style="color:white" href="/home">
                <img src="{{ asset('img/brigada-icon.png') }}" alt="/home" width="50" height="50"> 
                <span class="px-2">Brigada Healthline Corp. Daet</span>
            </a>
        </div> 
        <div class=""> 
            <form action="{{ route('search.item') }}" method="get">
                @csrf
                <div class="input-group">
                    <input type="text" id="search" name="search" class="form-control outline-secondary align-self-center" style="width: 350px; height: 50px" placeholder="Search bar" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary bg-white" type="submit" id="button-addon2">
                        <i class="fa-solid fa-magnifying-glass" style="color:black"></i>
                    </button>
                </div>
            </form>      
        </div> 
        <div class="d-flex align-items-center"> 
            <button type="button" class="btn" data-toggle="modal" data-target="#exampleModalCenter">
                <i class="fa fa-phone fa-2x" style="color:red"></i>
            </button> 
            @if(session()->has('Customer'))   
                <button type="button" class="btn" data-toggle="modal" data-target="#cart">
                    <i class="fa-solid fa-shopping-cart fa-2x" style="color:red"></i>
                </button>             
                <div class="nav-item dropdown">
                    <button type="button" id="navbarDropdown" data-bs-toggle="dropdown" class="btn">
                        <i class="fa-solid fa-user fa-2x" style="color:red"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="right: 0; left: auto;">
                        <li> 
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profileModal">Profile</a>
                        </li>                
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                        </li>
                    </ul>
                </div>
            @else
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#loginModal">
                    <i class="fa-solid fa-user fa-2x" style="color:red"></i>
                </button> 
            @endif
        </div> 
    </div>
            <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0 container-fluid d-flex justify-content-center bg-dark">
                <li class="nav-item">
                    <a class="nav-link active fs-5" aria-current="page" style="color:white" href="#">Brands</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5" style="color:white" href="#">Pricing</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fs-5" style="color:white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Products
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Immunity</a></li>
                        <li><a class="dropdown-item" href="#">Multivitamins</a></li>
                        <li><a class="dropdown-item" href="#">Sexual Health Vitamins</a></li>
                        <li><a class="dropdown-item" href="#">Nutritional Foods & Drinks</a></li>
                        <li><a class="dropdown-item" href="#">Pain Relief & Fever</a></li>
                        <li><a class="dropdown-item" href="#">Digestive Care</a></li>
                        <li><a class="dropdown-item" href="#">Lemon & Ginger Tea</a></li>
                        <li><a class="dropdown-item" href="#">Brain & Memory</a></li>
                        <li><a class="dropdown-item" href="#">Heart & Blood Pressure</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Health</a></li>
                    </ul>
                </li>
            </ul> -->
</nav>