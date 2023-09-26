@extends('layouts.app')

@section('title')
    {{ __('Register') }}
@endsection

@section('content')
    <!--begin::Body-->
	<body id="kt_body" class="bg-body">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-up -->
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url({{ asset('metronic-template/v8/assets/media/illustrations/development-hd.png') }})">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<!--begin::Logo-->
					<a href="#" class="mb-12">
						<img alt="Logo" src="{{ asset('metronic-template/v8/assets/media/logos/logo-2-dark.svg') }}" class="h-45px" />
					</a>
					<!--end::Logo-->
					<!--begin::Wrapper-->
					<div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
						<!--begin::Form-->
						<form action="{{ route('register', app()->getlocale() ) }}" method="POST" class="form w-100" >
						
							<!--begin::Heading-->
							@csrf
							<div class="mb-10 text-center">
								<!--begin::Title-->
								<h1 class="text-dark mb-3">{{ __('Create an Account') }}</h1>
								<!--end::Title-->
								<!--begin::Link-->
								<div class="text-gray-400 fw-bold fs-4">{{ __('Have An Account?') }}
								<a href="{{ route('login', app()->getlocale() ) }}" class="link-primary fw-bolder">{{ __('Login') }}</a></div>
								<!--end::Link-->
							</div>
							<!--end::Heading-->
							<!--begin::Action-->
							<a href="{{ route('login.google', app()->getlocale() ) }}" class="btn btn-light-primary fw-bolder w-100 mb-10">
							    <img alt="Logo" src="{{ asset('metronic-template/v8/assets/media/svg/brand-logos/google-icon.svg') }}" class="h-20px me-3" />
                                    {{ __('Sign in with', ['social' => 'Google']) }}
                            </a>
                            <a href="{{ route('login.github', app()->getlocale() ) }}" class="btn btn-light-primary fw-bolder w-100 mb-10">
							    <img alt="Logo" src="{{ asset('metronic-template/v8/assets/media/svg/brand-logos/github.svg') }}" class="h-20px me-3" />
                                    {{ __('Sign in with', ['social' => 'GitHub']) }}
                            </a>
							<!--end::Action-->
							<!--begin::Separator-->
							<div class="d-flex align-items-center mb-10">
								<div class="border-bottom border-gray-300 mw-50 w-100"></div>
								<span class="fw-bold text-gray-400 fs-7 mx-2">{{ __('or') }}</span>
								<div class="border-bottom border-gray-300 mw-50 w-100"></div>
							</div>
							<!--end::Separator-->
							<!--begin::Input group-->
							<div class="row fv-row mb-7">
								<!--begin::Col-->
								<div class="col-xl-6">
									<label class="form-label fw-bolder text-dark fs-6">{{ __('First Name') }}</label>
									<input class="form-control form-control-lg form-control-solid @error('first_name') is-invalid @enderror" type="text" placeholder="{{ __('First Name') }}" name="first_name" autocomplete="on" required value="{{ old('first_name') }}" />

									@error('first_name')
										<div class="fv-plugins-message-container invalid-feedback">
											<div data-field="first_name" data-validator="notEmpty">{{ $message }}</div>
										</div>
									@enderror
								</div>
								<!--end::Col-->
								<!--begin::Col-->
								<div class="col-xl-6">
									<label class="form-label fw-bolder text-dark fs-6">{{ __('Last Name') }}</label>
									<input class="form-control form-control-lg form-control-solid @error('last_name') is-invalid @enderror" type="text" placeholder="{{ __('Last Name') }}" name="last_name" autocomplete="on" required value="{{ old('last_name') }}" />

									@error('last_name')
										<div class="fv-plugins-message-container invalid-feedback">
											<div data-field="last_name" data-validator="notEmpty">{{ $message }}</div>
										</div>
									@enderror
								</div>
								<!--end::Col-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-7">
								<label class="form-label fw-bolder text-dark fs-6">{{ __('Email Address') }}</label>
								<input class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" type="email" placeholder="{{ __('Email Address') }}" name="email" autocomplete="on" required value="{{ old('email') }}" />
								
								@error('email')
									<div class="fv-plugins-message-container invalid-feedback">
										<div data-field="email" data-validator="notEmpty">{{ $message }}</div>
									</div>
								@enderror
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="mb-10 fv-row" data-kt-password-meter="true">
								<!--begin::Wrapper-->
								<div class="mb-1">
									<!--begin::Label-->
									<label class="form-label fw-bolder text-dark fs-6">{{ __('Password') }}</label>
									<!--end::Label-->
									<!--begin::Input wrapper-->
									<div class="position-relative mb-3">
										<input class="form-control form-control-lg form-control-solid " type="password" placeholder="{{ __('Password') }}" name="password" autocomplete="on" required value="{{ old('password') }}" />
										<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
											<i class="bi bi-eye-slash fs-2 @error('password') text-danger @enderror"></i>
											<i class="bi bi-eye fs-2 d-none @error('password') text-danger @enderror"></i>
										</span>
									</div>
									

									<!--end::Input wrapper-->
									<!--begin::Meter-->
									<div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
										<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
										<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
										<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
										<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
									</div>
									<!--end::Meter-->
								</div>
								<!--end::Wrapper-->
								<!--begin::Hint-->
								<div class="text-muted">{{ __('Hint') }}</div>
								<!--end::Hint-->

								<!--begin::Error-->
								@error('password')
									<div class="fv-plugins-message-container invalid-feedback">
										<div data-field="password" data-validator="notEmpty">{{ $message }}</div>
									</div>
								@enderror
								<!--end::Error-->


							</div>
							<!--end::Input group=-->
							<!--begin::Input group-->
							<div class="fv-row mb-5">
								<label class="form-label fw-bolder text-dark fs-6">{{ __('Confirm Password') }}</label>
								<input class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror" type="password" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" autocomplete="on" required />

								@error('password')
									<div class="fv-plugins-message-container invalid-feedback">
										<div data-field="password" data-validator="notEmpty">{{ $message }}</div>
									</div>
								@enderror
							</div>

							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-10">
								<label class="form-check form-check-custom form-check-solid form-check-inline">
									<input class="form-check-input" type="checkbox" name="agree" value="1" checked="checked" />
									<span class="form-check-label fw-bold text-gray-700 fs-6">{{ __('Agree') }}
									<a href="#terms" class="ms-1 link-primary">{{ __('Terms') }}</a>.</span>
								</label>
							</div>
							<!--end::Input group-->
							<!--begin::Actions-->
							<div class="text-center">
								<button type="submit" class="btn btn-lg btn-primary">
									<span class="indicator-label">{{ __('Submit') }}</span>
								</button>
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
				<div class="p-16"></div>
				<!--end::Footer-->
			</div>
			<!--end::Authentication - Sign-up-->
		</div>
		<!--end::Main-->
	</body>
	<!--end::Body-->
@endsection
