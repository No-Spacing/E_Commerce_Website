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
    <title>Change Password</title>
@stop

@section('content')
    <div class="container formBackground" style="padding: 5%; padding-top: auto;">
        <form action="{{ route('submit.change.password') }}" method="POST">
            @csrf
            <h1>Change Password</h1>
            <p>Please remember your password when changing.</p>
            <hr>
            @if(Session::get('changePasswordSuccess'))
                <div class="alert alert-success d-flex justify-content-center">
                    {{ Session::get('changePasswordSuccess') }}
                </div>
            @endif
            <label for="password"><b>Password</b></label>
            &nbsp;<span class="text-danger">@error('password'){{ $message }} @enderror</span>
            <input class="form-control mb-4" type="password" placeholder="Password" name="password" id="password" required>

            <label for="retypePassword"><b>Re-Type Password</b></label>
            &nbsp;<span class="text-danger">@error('retypePassword'){{ $message }} @enderror</span>
            <input class="form-control" type="password" placeholder="Password" name="retypePassword" id="retypePassword" required>

            <hr>

            <div class="form-group d-flex justify-content-center">
                <input type="submit" class="btn btn-primary btn-block btn-lg w-50" value="Change Password">
            </div>       
        </form>
    </div>
@stop

