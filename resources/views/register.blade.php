@extends('layouts.master')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/michalsnik/aos/2.0.1/dist/aos.css" />
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.0.1/dist/aos.js"></script>
    <link rel="stylesheet" href="css/register.css">
    <link rel="icon" type="image/x-icon" href="img/brigada-icon.png">
    <title>Registration</title>
@stop

@section('content')
    <div class="container formBackground" style="padding: 5%; padding-top: 120px;">
        <form action="{{ route('submit.register') }}" method="POST">
            @csrf
            <h1>Register</h1>
            <p>Please fill in this form to create an account.</p>
            <hr>
            @if(Session::get('success'))
                <div class="alert alert-success d-flex justify-content-center">
                    {{ Session::get('success') }}
                </div>
            @elseif(Session::get('unsuccess'))
                <div class="alert alert-danger d-flex justify-content-center">
                    {{ Session::get('unsuccess') }}
                </div>
            @endif
            <label for="email"><b>Name</b></label>
            &nbsp;<span class="text-danger">@error('name'){{ $message }} @enderror</span>
            <input type="text" placeholder="Juan Dela Cruz" name="name" id="name" required>
               
            <label for="email"><b>Email</b></label>
            &nbsp;<span class="text-danger">@error('email'){{ $message }} @enderror</span>
            <input type="text" placeholder="juandelacruz@gmail.com" name="email" id="email" required>

            <label for="psw"><b>Password</b></label>
            &nbsp;<span class="text-danger">@error('password'){{ $message }} @enderror</span>
            <input type="password" placeholder="Enter Password" name="password" id="password" required>
        
            <hr>
            <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

            <div class="form-group d-flex justify-content-center">
                <input type="submit" class="btn btn-primary btn-block btn-lg w-75" value="Register">
            </div>       
        </form>
    </div>
@stop

