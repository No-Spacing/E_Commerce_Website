<!DOCTYPE html>
<style>
    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        z-index: 999;

    }
</style>
<html>
    <head>
        @yield('head')
    </head>
    <header>
        @include('layouts.navbar')
    </header>
    <body> 
        @include('layouts.contactus')
        @if(session()->has('Customer'))
            @include('layouts.cart')
            @include('layouts.profile')
        @else
            @include('layouts.login')
        @endif
        @yield('content')
        <div class="footer footer-copyright">
            <div class="d-flex flex-row bg-dark pt-3 container-fluid">
                <div class="col-md-12 text-center ">
                    <p style="color: white;">Copyright Brigada Healthline Corp. © 2022. All rights reserved.</p>
                </div>
            </div>
        </div>
    </body>
</html>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
<script> 
    AOS.init({
        duration: 1200,
    });
</script>
@if($errors->get('emailLogin') || $errors->get('passwordLogin') || Session::get('fail'))
    <script>
        $(document).ready(function() {             
            $('#loginModal').modal('show');  
        });
    </script>
@endif

@if(Session::get('successCart'))
    <script>
        $(document).ready(function() {             
            $('#cart').modal('show');  
        });
    </script>
@endif

@if(Session::get('failOrder'))
    <script>
        $(document).ready(function() {             
            $('#cart').modal('show');  
        });
    </script>
@endif

@if($errors->get('address') || $errors->get('number'))
    <script>
        $(document).ready(function() {             
            $('#profileModal').modal('show');  
        });
    </script>
@endif

@if(Session::get('successProfile'))
    <script>
        $(document).ready(function() {             
            $('#profileModal').modal('show');  
        });
    </script>
@endif

@if(Session::get('checkProfile'))
    <script>
        $(document).ready(function() {             
            $('#profileModal').modal('show');  
        });
    </script>
@endif

