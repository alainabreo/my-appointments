@extends('layouts.form')

@section('title', 'Register')
@section('subtitle', 'No obligation, no credit card required.')

@section('content')
<div class="container mt--8 pb-5">
	<!-- Table -->
	<div class="row justify-content-center">
		<div class="col-lg-6 col-md-8">
			<div class="card bg-secondary shadow border-0">
				<div class="card-header bg-transparent pb-5">
					<div class="text-muted text-center mt-2 mb-4"><small>Sign up with</small></div>
					<div class="text-center">
						<a href="#" class="btn btn-neutral btn-icon mr-4">
							<span class="btn-inner--icon"><img src="{{ asset('img/icons/common/github.svg') }}"></span>
							<span class="btn-inner--text">Github</span>
						</a>
						<a href="#" class="btn btn-neutral btn-icon">
							<span class="btn-inner--icon"><img src="{{ asset('img/icons/common/google.svg') }}"></span>
							<span class="btn-inner--text">Google</span>
						</a>
					</div>
				</div>
				<div class="card-body px-lg-5 py-lg-5">
					<div class="text-center text-muted mb-4">
						<small>Or sign up with credentials</small>
					</div>
					<form role="form"method="POST" action="{{ route('register') }}">
						@csrf
						@if ($errors->any())
						<div class="alert alert-danger" role="alert">
							<strong>Opps</strong> {{ $errors->first() }}
						</div>
						@endif            
						<div class="form-group">
							<div class="input-group input-group-alternative mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="ni ni-hat-3"></i></span>
								</div>
								<input class="form-control" placeholder="Name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group input-group-alternative mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="ni ni-email-83"></i></span>
								</div>
								<input class="form-control" placeholder="Email" type="email"  name="email" value="{{ old('email') }}" required autocomplete="email">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
								</div>
								<input class="form-control" placeholder="Password" type="password" name="password" required autocomplete="new-password">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
								</div>
								<input class="form-control" placeholder="Confirm password" type="password" name="password_confirmation" required autocomplete="new-password">
							</div>
						</div>            
						<div class="text-muted font-italic"><small>password strength: <span class="text-success font-weight-700">strong</span></small></div>
						<div class="row my-4">
							<div class="col-12">
								<div class="custom-control custom-control-alternative custom-checkbox">
									<input class="custom-control-input" id="customCheckRegister" type="checkbox">
									<label class="custom-control-label" for="customCheckRegister">
										<span class="text-muted">I agree with the <a href="#!">Privacy Policy</a></span>
									</label>
								</div>
							</div>
						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-primary mt-4">Create account</button>
						</div>
					</form>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-6">
				</div>
				<div class="col-6 text-right">
					<a href="{{ route('login') }}" class="text-light">
						<small>{{ __('Already have an account?') }}</small>
					</a>
				</div>      
			</div>
		</div>
	</div>
</div>
@endsection
