<!DOCTYPE html>
<style>
html {
  position: relative;
  min-height: 100%;
  padding-bottom:50px;
}
body {
  margin-bottom: 160px;
}
.footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  height: 50px;
}

</style>
<html>
    <head>
        @yield('head')
        <link rel="icon" type="image/x-icon" href="img/E_Commerce_Icon.jpg">
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
        <div class="footer"> 
            <div class="d-flex flex-row bg-dark pt-3 container-fluid ">
                <div class="col-md-12 container">
                    <!-- <div class="col col-xl-2">
                        <h4 style="color: white;">Daet Branch</h4>
                        <p style="color: white;">Kenboy Bldg, Central Plaza Complex, Brgy Lag-on, Daet Camarines Norte.</p>
                    </div> -->
                    <div class=" d-flex justify-content-center">
                        <p style="color: white;">COPYRIGHT © 2023 E-Commerce Website.</p>
                    </div>   
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
    var botmanWidget = {
        title: 'BotMan',
        introMessage: 'Hello! Please edit the BotManController.php to edit the message content of botman.',
    };
</script>
<script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>

@if($errors->get('emailLogin') || $errors->get('passwordLogin') || Session::get('fail'))
    <script>
        $(document).ready(function() {             
            $('#loginModal').modal('show');  
        });
    </script>
@endif

@if($errors->get('email'))
    <script>
        $(document).ready(function() {             
            $('#forgotPasswordModal').modal('show');  
        });
    </script>
@endif

@if(Session::get('sendCodeSuccess'))
    <script>
        $(document).ready(function() {             
            $('#forgotPasswordModal').modal('show');  
        });
    </script>   
@endif

@if($errors->get('code'))
    <script>
        $(document).ready(function() {             
            $('#forgotPasswordModal').modal('show');  
        });
    </script>
@endif

@if(Session::get('errorCode'))
    <script>
        $(document).ready(function() {             
            $('#forgotPasswordModal').modal('show');  
        });
    </script>
@endif

@if(session('changedPassword'))
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

