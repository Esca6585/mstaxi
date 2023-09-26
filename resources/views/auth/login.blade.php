@extends('layouts.app')

@section('title')
    {{ __('Login') }}
@endsection

@section('content')
    	<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url({{ asset('metronic-template/v8/assets/media/illustrations/development-hd.png') }})">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<!--begin::Logo-->
					<a href="#" class="mb-12">
						<img alt="Logo" src="{{ asset('mstaxi/mstaxi_logo.svg') }}" class="h-45px" />
						<img alt="Logo" src="{{ asset('mstaxi/mstaxi_logo_name.svg') }}" class="h-45px" />
					</a>
					<!--end::Logo-->
					<!--begin::Wrapper-->
					<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
						<!--begin::Form-->
						<form method="POST" action="{{ route('login', app()->getLocale()) }}" class="form w-100" >
							@csrf
							<!--begin::Heading-->
							<div class="text-center mb-10">
								<!--begin::Title-->
								<h1 class="text-dark mb-3">{{ __('Login') }}</h1>
								<!--end::Title-->
								<!--begin::Link-->
								<div class="text-gray-400 fw-bold fs-4">{{ __('New Here?') }}
								<a href="{{ route('register', app()->getLocale()) }}" class="link-primary fw-bolder">{{ __('Create an Account') }}</a></div>
								<!--end::Link-->
							</div>
							<!--begin::Heading-->
							<!--begin::Input group-->
							<div class="fv-row mb-10">
								<!--begin::Label-->
								<label class="form-label fs-6 fw-bolder text-dark">{{ __('Email Address') }}</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input id="email" class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" type="email" name="email" autocomplete="on" placeholder="{{ __('Email Address') }}"  required />
								<!--end::Input-->
				
								@error('email')
									<div class="fv-plugins-message-container invalid-feedback">
										<div data-field="email" data-validator="notEmpty">{{ $message }}</div>
									</div>
								@enderror

							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-10">
								<!--begin::Wrapper-->
								<div class="d-flex flex-stack mb-2">
									<!--begin::Label-->
									<label class="form-label fw-bolder text-dark fs-6 mb-0">{{ __('Password') }}</label>
									<!--end::Label-->
									<!--begin::Link-->
									<a href="{{ route('password.request', app()->getlocale() ) }}" class="link-primary fs-6 fw-bolder">{{ __('Forgot Your Password?') }}</a>
									<!--end::Link-->
								</div>
								<!--end::Wrapper-->
								<!--begin::Input-->
								<input id="password" class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror" type="password" name="password" autocomplete="on" placeholder="{{ __('Password') }}" required />
								<!--end::Input-->

								@error('password')
									<div class="fv-plugins-message-container invalid-feedback">
										<div data-field="email" data-validator="notEmpty">{{ $message }}</div>
									</div>
								@enderror
								
							</div>
							<!--end::Input group-->
							<!--begin::Actions-->
							<div class="text-center">
								<!--begin::Submit button-->
								<button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
									<span class="indicator-label">{{ __('Login') }}</span>
									{{-- <span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span> --}}
								</button>
								<!--end::Submit button-->
								<!--begin::Separator-->
								<div class="text-center text-muted text-uppercase fw-bolder mb-5">{{ __('or') }}</div>
								<!--end::Separator-->
								<!--begin::Google link-->
								<a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
								<img alt="Logo" src="{{ asset('metronic-template/v8/assets/media/svg/brand-logos/google-icon.svg') }}" class="h-20px me-3" />{{ trans('Continue with', ['social' => 'Google']); }}</a>
								<!--end::Google link-->
								<!--begin::GitHub link-->
								<a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
								<img alt="Logo" src="{{ asset('metronic-template/v8/assets/media/svg/brand-logos/github.svg') }}" class="h-20px me-3" />{{ __('Continue with', ['social' => 'GitHub']) }}</a>
								<!--end::GitHub link-->
							</div>
							<!--end::Actions-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
				<!--begin::Footer-->
				<div class="d-flex flex-center flex-column-auto">
					<!--begin::Links-->
					<div class="d-flex align-items-center fw-bold fs-6">
						<select class="form-select" id="changeLanguage">
							@foreach (Config::get('languages') as $lang => $language)
								<option value="{{ $lang }}" {{ Request::segment(1) == $lang ? 'selected' : '' }}>{{ $language['name'] }}</option>
							@endforeach
						</select>
					</div>
					<!--end::Links-->
				</div>
				<div class="p-19"></div>
				<!--end::Footer-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Main-->
@endsection
