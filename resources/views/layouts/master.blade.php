<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdn.rawgit.com/michalsnik/aos/2.0.1/dist/aos.css" />
        <script src="https://cdn.rawgit.com/michalsnik/aos/2.0.1/dist/aos.js"></script>
        <link rel="stylesheet" href="css/home.css">
        <link rel="icon" type="image/x-icon" href="img/brigada-icon.png">
        <title></title>
    </head>
    <header>
        <nav id="navbar_top" class="navbar navbar-expand-lg navbar-light bg-white" data-aos="fade-up">
            <div class="container-fluid">
                <a class="navbar-brand" href="/home">
                    <img src="img/brigada-icon.png" alt="/home" width="50" height="50"> 
                    Brigada Healthline Corp.
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <body>
   
        <div class="row d-flex justify-content-center">
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