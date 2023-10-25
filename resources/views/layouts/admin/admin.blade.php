<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="icon" href="img/brigada-icon.png">
    @yield('head')
    <title>Brigada</title>
</head>
<header>
<style>        
    .sidenav {
    height: 100%;
    width: 230px;
    position: fixed;
    }

    .main {
    margin-left: 230px; /* Same as the width of the sidenav */
    }
</style>
</header>
<body>
    <div class="container-fluid">
        <div class="row flex-nowrap" >
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark sidenav">
                @include('layouts.admin.sidebar')
            </div>
            <div class="col content py-3 main">
                @yield('content')
            </div>
        </div>
    </div>
</body>
@yield('scripts')
</html>