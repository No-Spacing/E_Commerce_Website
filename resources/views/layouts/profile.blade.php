<div id="profileModal" class="modal fade" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">				
				<h5>Edit Profile</h5>
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button> -->
			</div>
			<div class="modal-body">
                <div class="container bootstrap snippets bootdey">
                    <h1 class="text-primary"></h1>
                    <div class="row">
                    <!-- left column -->
                        <div class="col-md-3 mt-2">
                            <div class="text-center">
                                <img src="{{ asset('img/user-icon.png') }}" class="avatar img-circle img-thumbnail" alt="avatar">
                            </div>
                        </div>
                    
                    <!-- edit form column -->
                        <div class="col-md-9 personal-info">
                            <h3>Personal info</h3>
                            @if(Session::get('successProfile'))
                                <div class="alert alert-success d-flex justify-content-center">
                                    {{ Session::get('successProfile') }}
                                </div>
                            @endif
                            @if(Session::get('checkProfile'))
                                <div class="alert alert-danger d-flex justify-content-center">
                                    {{ Session::get('checkProfile') }}
                                </div>
                            @endif
                            <form action="{{ route('save.profile') }}" method="post" class="form-horizontal modal-form" role="form">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="col-lg-3 control-label">Name:</label>
                                    <div class="col-lg-11">
                                        <input class="form-control" type="text" value="{{ $customerDetails->name }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="col-lg-3 control-label">Birthdate:</label>
                                    <div class="col-lg-11">
                                        <input class="form-control" id="birthdate" name="birthdate" type="date" value="{{ $customerDetails->birthdate }}">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="col-lg-3 control-label">Address:</label>
                                    <div class="col-lg-11">
                                        <input class="form-control" id="address" name="address" type="text" value="{{ old('address', $customerDetails->address) }}" placeholder="Address">
                                        <span class="text-danger">@error('address'){{ $message }} @enderror</span>                                    
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="col-lg-3 control-label">Email:</label>
                                    <div class="col-lg-11">
                                        <input class="form-control" type="text" value="{{ $customerDetails->email }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="col-lg-3 control-label">Mobile No.:</label>
                                    <div class="col-lg-11">
                                        <input class="form-control" id="number" name="number"  type="number" value="{{ old('number', $customerDetails->number) }}" placeholder="09271231234">
                                        <span class="text-danger">@error('number') {{ $message }} @enderror</span>
                                    </div>
                                </div>
                                <div class="form-group d-flex justify-content-center mt-4 mb-4">
                                    <input type="submit" class="save-btn btn btn-primary btn-block btn-lg w-50" value="Save">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>