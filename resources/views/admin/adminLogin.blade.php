<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="css/admin/adminLogin.css">
<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first container-fluid">
      <img src="{{ asset('img/user-icon.png') }}" id="icon" alt="User Icon" />
      <h3>Admin</h3>
      @if(Session::get('fail'))
        <div class="alert alert-danger d-flex justify-content-center">
          {{ Session::get('fail') }}
        </div>
      @endif
    </div>
    <!-- Login Form -->
    <form action="{{ route('admin.login.request') }}" method="post">
      @csrf
      <div>
        <input type="text" id="username" name="username" class="fadeIn second"  placeholder="Username" required>        
      </div>
      <span class="text-danger">@error('username'){{ $message }} @enderror</span>
      <div>
        <input type="password" id="password" name="password" class="fadeIn third"  placeholder="Password" required>
      </div>
      <span class="text-danger">@error('password'){{ $message }} @enderror</span>
      <div>
        <button type="submit" class="btn btn-primary w-50 mt-3 mb-3" >Login</button>
      </div>
    </form>
  </div>
</div>