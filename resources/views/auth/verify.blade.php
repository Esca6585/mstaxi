@extends('layouts.app')

@section('title')
{{ __('Verify Your Email Address') }}
@endsection

@section('content')
	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Two-stes -->
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/development-hd.png)">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<!--begin::Logo-->
					<a href="../../demo1/dist/index.html" class="mb-12">
						<img alt="Logo" src="{{ asset('metronic-template/v7/assets/media/logos/logo-2-dark.svg') }}" class="h-45px" />
					</a>
					<!--end::Logo-->
					<!--begin::Wrapper-->
					<div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
						<!--begin::Form-->
						<form action="" method="get" class="form w-100 mb-10" >
							<!--begin::Icon-->
							<div class="text-center mb-10">
								<img alt="Logo" class="mh-125px" src="{{ asset('metronic-template/v8/assets/media/svg/misc/open-mail.svg') }}" />
							</div>
							<!--end::Icon-->
							<!--begin::Heading-->
							<div class="text-center mb-10">
								<!--begin::Mobile no-->
								<div class="fw-bolder text-primary fs-3"></div>
								<!--end::Mobile no-->
								<div style="border-bottom: 1px solid #eeeeee; margin: 10px 0;"></div>
								<!--begin::Title-->
								<h1 class="text-dark mb-3">{{ __('Email Address') }} tassyklama kody ugradyldy</h1>
								<!--end::Title-->
							</div>
							<!--end::Heading-->
							<!--begin::Section-->
							<div class="mb-10 px-md-10">
								<!--begin::Label-->
								<div class="fw-bolder text-center text-muted fs-4 mb-5 ms-1">{{ __('Before proceeding, please check your email for a verification link.') }}</div>
								<!--end::Label-->
							</div>
							<!--end::Section-->
						</form>
						<!--end::Form-->
						<!--begin::Notice-->
						<div class="text-center fw-bold fs-5">
							<span class="text-muted me-1">{{ __('If you did not receive the email') }}</span>
                            <form method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary link-primary fw-bolder fs-5 me-1 mt-5">{{ __('Resend') }}</button>
                            </form>
						</div>
						<!--end::Notice-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Authentication - Two-stes-->
		</div>
		<!--end::Main-->

        <!--begin::Alert-->
        @if(session()->has('resent'))
        <div class="alert alert-fixed alert-success fade show mb-5" id="alert-message">
			{{ __('A fresh verification link has been sent to your email address.') }}
        </div>
        @endif
        <!--end::Alert-->

	</body>
	<!--end::Body-->
@endsection
