<div id="loginModal" class="modal fade" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">				
				<h4 class="modal-title">Login</h4>
				<!-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
			</div>
			<div class="modal-body">
				<form action="{{ route('submit.login') }}" method="post">
					@if(Session::get('fail'))
						<div class="alert alert-danger d-flex justify-content-center">
							{{ Session::get('fail') }}
						</div>
					@endif
					@if(session('changedPassword'))
						<div class="alert alert-success d-flex justify-content-center">
							{{ session("changedPassword")}}
						</div>
					@endif
					@csrf
					<div class="form-group">
						<i class="fa fa-user"></i>&nbsp;
                        Email &nbsp;<span class="text-danger">@error('emailLogin'){{ $message }} @enderror</span>
						<input type="text" id="emailLogin" name="emailLogin" class="form-control mb-3" placeholder="Email" required>
					</div>
					<div class="form-group mb-4">
						<i class="fa fa-lock"></i>&nbsp;
                        Password &nbsp;<span class="text-danger">@error('passwordLogin'){{ $message }} @enderror</span>
						<input type="password" id="passwordLogin" name="passwordLogin" class="form-control" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                        <a href="" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" data-bs-dismiss="modal"  class="d-flex justify-content-end btn-next">Forgot Password?</a>
					</div>
					<div class="form-group d-flex justify-content-center">
						<input type="submit" class="btn btn-primary btn-block btn-lg w-50" value="Login">
					</div>
				</form>
			</div>
			<div class="modal-footer d-flex justify-content-center py-3">	
                Don't have an account?&nbsp;
                <a href="{{ route('register') }}" class="">Signup</a>		
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="forgotPasswordModal" aria-hidden="true" aria-labelledby="forgotPasswordModalLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
		</div>
		<div class="modal-body">	
			<div class="form-group">
				<form action="{{ route('send.code') }} " method="post">
					@csrf
					<i class="fa fa-user"></i>&nbsp;
					@if(Session::get('sendCodeSuccess'))
						<div class="alert alert-success d-flex justify-content-center">
							{{ Session::get('sendCodeSuccess') }}
						</div>
					@endif
					@if(Session::get('errorCode'))
						<div class="alert alert-danger d-flex justify-content-center">
							{{ Session::get('errorCode') }}
						</div>
					@endif
					Email &nbsp;<span class="text-danger">@error('email'){{ $message }} @enderror</span>
					<div class="input-group mb-3">
						<input type="text" name="email" class="form-control" placeholder="juandelacruz@gmail.com" aria-label="Recipient's username" aria-describedby="basic-addon2">
						<button type="submit" class="input-group-text" id="basic-addon2">Send Code</button>
					</div>
				</form>
			</div>
			<form action="{{ route('submit.code') }}" method="post">
				@csrf
				<div class="form-group mb-4">
					<i class="fa fa-lock"></i>&nbsp;
					Code &nbsp;<span class="text-danger">@error('code'){{ $message }} @enderror</span>
					<input type="text" id="code" placeholder="Code" name="code" class="form-control">
				</div>
				<div class="form-group d-flex justify-content-center">
					<input type="submit" class="btn btn-primary btn-block btn-lg w-50" value="Reset Password">
				</div>	
			</form>
		</div>
		<div class="modal-footer">
			<button class="btn btn-primary" data-bs-target="#loginModal" data-bs-toggle="modal" data-bs-dismiss="modal">Back</button>
		</div>
    </div>
  </div>
</div>

