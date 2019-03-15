@extends('layouts.login')

@section('content')
<div class="limiter">
	<div class="row">
		<div class="container-login100">
			<div class="wrap-login100 p-t-50 p-b-90">
				<form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('login') }}">
					{{ csrf_field() }}

					<span class="login100-form-title p-b-51" style="text-align:center">Login</span>

					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} wrap-input100 validate-input m-b-16" data-validate = "Email is required">

						<input id="email" type="email" class="form-control input100" name="email" value="{{ old('email') }}" required autofocus>
						<span class="focus-input100"></span>

						@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} wrap-input100 validate-input m-b-16" data-validate = "Password is required">

						<input id="password" type="password" class="form-control input100" name="password" required>
						<span class="focus-input100"></span>

						@if ($errors->has('password'))
							<span class="help-block">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group">
						<div class="flex-sb-m w-full p-t-3 p-b-24">
							<div class="contact100-form-checkbox">
								<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 
								<label class="label-checkbox100" for="ckb1"> Remember Me</label>
							</div>
						</div>
					</div>

					{{-- <div class="form-group">
						<a class="txt1" href="{{ route('password.request') }}">
							Forgot?
						</a>
					</div> --}}

					{{-- <div class="form-group"> --}}
						<div class="container-login100-form-btn m-t-17">
							<button type="submit" class="login100-form-btn">
								Login
							</button>
						</div>
					{{-- </div> --}}
				</form>
			</div>
		</div>
	</div>
</div>
@endsection