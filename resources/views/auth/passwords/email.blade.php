@extends('layouts.login')

@section('content')
<div class="limiter">
	<div class="row">
		<div class="container-login100">
			<div class="wrap-login100 p-t-50 p-b-90">
				<form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('password.email') }}">
					{{ csrf_field() }}

					<span class="login100-form-title p-b-51" style="text-align:center">Reset password</span>

					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} wrap-input100 validate-input m-b-16" data-validate = "Email is required">

						<input id="email" type="email" class="form-control input100" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
						<span class="focus-input100"></span>

						@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>

					{{-- <div class="form-group"> --}}
						<div class="container-login100-form-btn m-t-17">
							<button type="submit" class="login100-form-btn">
								Send Reset Password Link
							</button>
						</div>
					{{-- </div> --}}
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
