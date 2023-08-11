<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.rawgit.com/michalsnik/aos/2.0.1/dist/aos.css" />
        <script src="https://cdn.rawgit.com/michalsnik/aos/2.0.1/dist/aos.js"></script>
        <link rel="stylesheet" href="css/home.css">
        <link rel="icon" type="image/x-icon" href="img/brigada-icon.png">
        <title></title>
    </head>
    <header>
        <nav id="navbar_top" class="navbar navbar-expand-lg navbar-light bg-light d-flex flex-column" data-aos="fade-u">
            <div class="container-fluid d-inline-flex justify-content-between">
                <div class="">
                    <a class="navbar-brand" href="/home">
                        <img src="img/brigada-icon.png" alt="/home" width="50" height="50"> 
                        Brigada Healthline Corp.
                    </a>
                </div> 
                <div class=""> 
                    <form>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search bar" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>      
                </div> 
                <div class=""> 
                    <a class="ms-3"><i class="fa-solid fa-comment"></i></a>
                    <a class="ms-3"><i class="fa-solid fa-cart-shopping"></i></a>
                    <a class="ms-3"><i class="fa-solid fa-user"></i></a>
                </div> 
            </div>
            <div class="">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Brands</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Products
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Skincare</a></li>
                            <li><a class="dropdown-item" href="#">Hair</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Health</a></li>
                        </ul>
                    </li>
                </ul>
            </div> 
        </nav>
    </header>
    <body>
        <div class="row d-flex">
            @yield('content')
        </div>
    </body>
</html>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
    AOS.init({
        duration: 1200,
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function(){
        const navBarElement = document.getElementById('navbar_top');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 200) {
                navBarElement.classList.add('fixed-top');
                // // add padding top to show content behind navbar
                navbar_height = document.querySelector('.navbar').offsetHeight;
                document.body.style.paddingTop = navbar_height + 'px';
            } else { 
                navBarElement.classList.add('fixed-top');
                document.getElementById('navbar_top').classList.remove('fixed-top');
                // remove padding top from body
                document.body.style.paddingTop = '0';
            } 
        });
    }); 
</script>