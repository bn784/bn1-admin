@extends('layouts.auth')
<?php
$locale = Auth::user()->preferred_language;
App::setLocale($locale);
?>
@section('content')
	<div class="content">
		@if(session('success'))
				<!-- If password successfully show message -->
		<div class="row">
			<div class="alert alert-success">
				{{ session('success') }}
			</div>
		</div>
		@else
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div class="card">
						<div class="card-header">@lang('messages.change_password')</div>

						<div class="card-body">
							<form method="POST" action="{{ route('change_password') }}">
								@csrf

								<div class="form-group row">
									<label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Current password') }}</label>

									<div class="col-md-6">
										<input id="current_password" type="password" class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}" name="current_password" required autocomplete="current_password" >

										@if ($errors->has('current_password'))
											<span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
										@endif
									</div>
								</div>

								<div class="form-group row">
									<label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('New password') }}</label>

									<div class="col-md-6">
										<input id="new_password" type="password" class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" name="new_password" required autocomplete="new-password">

										@if ($errors->has('new_password'))
											<span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
										@endif
									</div>
								</div>

								<div class="form-group row">
									<label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

									<div class="col-md-6">
										<input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required autocomplete="new-password">

										@if ($errors->has('new_password_confirmation'))
											<span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                                    </span>
										@endif
									</div>
								</div>

								<div class="form-group row mb-0">
									<div class="col-md-6 offset-md-4">
										<button type="submit" class="btn btn-primary">
											 @lang('messages.change_password')
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	@endif
@stop

