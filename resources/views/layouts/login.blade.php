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
					@csrf
					<div class="form-group">
						<i class="fa fa-user"></i>&nbsp;
                        Email &nbsp;<span class="text-danger">@error('emailLogin'){{ $message }} @enderror</span>
						<input type="text" id="emailLogin" name="emailLogin" class="form-control mb-3" placeholder="juandelacruz@gmail.com" required>
					</div>
					<div class="form-group mb-4">
						<i class="fa fa-lock"></i>&nbsp;
                        Password &nbsp;<span class="text-danger">@error('passwordLogin'){{ $message }} @enderror</span>
						<input type="password" id="passwordLogin" name="passwordLogin" class="form-control" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                        <!-- <a href="#" class="d-flex justify-content-end">Forgot Password?</a> -->
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