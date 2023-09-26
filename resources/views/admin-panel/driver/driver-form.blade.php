@extends('layouts.admin-template-app')

@section('title')
{{ __('Drivers') }} {{ __( ucfirst(request()->segment(count(request()->segments())))) }}
@endsection

@section('style')
<!--begin::Fonts-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
<!--end::Fonts-->
<!--begin::Page Vendors Styles(used by this page)-->
<link href="{{ asset('metronic-template/v7/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}"
    rel="stylesheet" type="text/css" />
<!--end::Page Vendors Styles-->
<!--begin::Global Theme Styles(used by all pages)-->
<link href="{{ asset('metronic-template/v7/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('metronic-template/v7/assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('metronic-template/v7/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<!--end::Global Theme Styles-->
<!--begin::Layout Themes(used by all pages)-->
<link href="{{ asset('metronic-template/v7/assets/css/themes/layout/header/base/light.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('metronic-template/v7/assets/css/themes/layout/header/menu/light.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('metronic-template/v7/assets/css/themes/layout/brand/dark.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('metronic-template/v7/assets/css/themes/layout/aside/dark.css') }}" rel="stylesheet"
    type="text/css" />

@endsection

@section('body')
<!--begin::Body-->

<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->
    <!--begin::Header Mobile-->
    <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
        <!--begin::Logo-->
        @include('layouts.logo')
        <!--end::Logo-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Aside Mobile Toggle-->
            <button class="btn p-0 burger-icon" id="kt_aside_mobile_toggle">
                <span></span>
            </button>
            <!--end::Aside Mobile Toggle-->
            <!--begin::Header Menu Mobile Toggle-->
            <!-- <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
                <span></span>
            </button> -->
            <!--end::Header Menu Mobile Toggle-->
            <!--begin::Topbar Mobile Toggle-->
            <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                <span class="svg-icon svg-icon-xl">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path
                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                            <path
                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
            </button>
            <!--end::Topbar Mobile Toggle-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Aside-->
            <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
                <!--begin::Brand-->
                <div class="brand flex-column-auto" id="kt_brand">
                    <!--begin::Logo-->
                    @include('layouts.logo')
                    <!--end::Logo-->
                    <!--begin::Toggle-->
                    <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                        <span class="svg-icon svg-icon svg-icon-xl">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path
                                        d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                                    <path
                                        d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3"
                                        transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </button>
                    <!--end::Toolbar-->
                </div>
                <!--end::Brand-->
                <!--begin::Aside Menu-->
                @include('layouts.sidebar')
                <!--end::Aside Menu-->
            </div>
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->
                @include('layouts.header')
                <!--end::Header-->
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Subheader-->
                    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
                        <div
                            class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center flex-wrap mr-1">
                                <!--begin::Page Heading-->
                                <div class="d-flex align-items-baseline flex-wrap mr-5">
                                    <!--begin::Page Title-->
                                    <h5 class="text-dark font-weight-bold my-1 mr-5">

                                    </h5>
                                    <!--end::Page Title-->
                                    <!--begin::Breadcrumb-->
                                    <ul
                                        class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                                        <li class="breadcrumb-item text-muted">
                                            <a href="{{ route('driver.index', [ app()->getlocale() ]) }}"
                                                class="text-muted">{{ __('Drivers') }}</a>
                                        </li>

                                        <li class="breadcrumb-item text-muted">
                                            <a href="{{ route('driver.index', [ app()->getlocale() ]) }}"
                                                class="text-muted"> {{ __( ucfirst(request()->segment(count(request()->segments())))) }}
                                            </a>
                                        </li>
                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page Heading-->
                            </div>
                            <!--end::Info-->
                        </div>
                    </div>
                    <!--end::Subheader-->
                    <!--begin::Entry-->
                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->
                        <div class="container">
                            <!--begin::Card-->
                            <div class="card card-custom">
                                <div class="card-header flex-wrap py-5">
                                    <div class="card-title">
                                        <h3 class="card-label">{{ __('Brands') }}
                                            <span class="d-block text-muted pt-2 font-size-sm">
                                                {{ __( ucfirst(request()->segment(count(request()->segments())))) }}
                                            </span>
                                        </h3>
                                    </div>

                                </div>
                                <!--begin::Form-->
                                @if($driver->id)
                                <form
                                    action="{{ route(Request::segment(3) . '.update', [ app()->getlocale(), $driver->id ] ) }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    @else
                                    <form
                                        action="{{ route(Request::segment(3) . '.store', [ app()->getlocale() ] ) }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        @endif

                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>{{ __('First Name') }}</label>

                                                            <input type="text"
                                                                class="form-control @error('first_name') is-invalid @enderror"
                                                                name="first_name"
                                                                placeholder="{{ __('First Name') }}"
                                                                value="{{ $driver->first_name }}{{ request()->segment(count(request()->segments())) == 'create' ? old('first_name') : '' }}" />

                                                            @error('first_name')
                                                            <div class="fv-plugins-message-container invalid-feedback">
                                                                <div data-field="first_name" data-validator="notEmpty">
                                                                    {{ $message }}
                                                                </div>
                                                            </div>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>{{ __('Last Name') }}</label>

                                                            <input type="text"
                                                                class="form-control @error('last_name') is-invalid @enderror"
                                                                name="last_name"
                                                                placeholder="{{ __('Last Name') }}"
                                                                value="{{ $driver->last_name }}{{ request()->segment(count(request()->segments())) == 'create' ? old('last_name') : '' }}" />

                                                            @error('last_name')
                                                            <div class="fv-plugins-message-container invalid-feedback">
                                                                <div data-field="last_name" data-validator="notEmpty">
                                                                    {{ $message }}
                                                                </div>
                                                            </div>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>{{ __('Car Number') }}</label>

                                                            <input type="text"
                                                                class="form-control @error('car_number') is-invalid @enderror"
                                                                name="car_number"
                                                                placeholder="{{ __('Car Number') }}"
                                                                value="{{ $driver->car_number }}{{ request()->segment(count(request()->segments())) == 'create' ? old('car_number') : '' }}" />

                                                            @error('car_number')
                                                            <div class="fv-plugins-message-container invalid-feedback">
                                                                <div data-field="car_number" data-validator="notEmpty">
                                                                    {{ $message }}
                                                                </div>
                                                            </div>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>{{ __('Car Model') }}</label>

                                                            <input type="text"
                                                                class="form-control @error('car_model') is-invalid @enderror"
                                                                name="car_model"
                                                                placeholder="{{ __('Car Model') }}"
                                                                value="{{ $driver->car_model }}{{ request()->segment(count(request()->segments())) == 'create' ? old('car_model') : '' }}" />

                                                            @error('car_model')
                                                            <div class="fv-plugins-message-container invalid-feedback">
                                                                <div data-field="car_model" data-validator="notEmpty">
                                                                    {{ $message }}
                                                                </div>
                                                            </div>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>{{ __('Birthday') }}</label>

                                                            <input type="date"
                                                                id="dateFieldBirthday"
                                                                class="form-control @error('birthday') is-invalid @enderror"
                                                                name="birthday"
                                                                placeholder="{{ __('Birthday') }}" />
                                                                

                                                            @error('birthday')
                                                            <div class="fv-plugins-message-container invalid-feedback">
                                                                <div data-field="birthday" data-validator="notEmpty">
                                                                    {{ $message }}
                                                                </div>
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <script>
                                                            document.getElementById("dateFieldBirthday").value = new Date("{{ $driver->birthday }}").toISOString().substring(0, 10)
                                                        </script>

                                                    </div>

                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>{{ __('Start Working') }}</label>

                                                            <input type="date"
                                                                id="dateFieldStartWorking"
                                                                class="form-control @error('start_working') is-invalid @enderror"
                                                                name="start_working"
                                                                placeholder="{{ __('Start Working') }}" />

                                                            @error('start_working')
                                                            <div class="fv-plugins-message-container invalid-feedback">
                                                                <div data-field="start_working" data-validator="notEmpty">
                                                                    {{ $message }}
                                                                </div>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        
                                                        <script>
                                                            document.getElementById("dateFieldStartWorking").value = new Date("{{ $driver->start_working }}").toISOString().substring(0, 10)
                                                        </script>

                                                    </div>

                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label>{{ __('Username') }}</label>

                                                            <input type="text"
                                                                class="form-control @error('username') is-invalid @enderror"
                                                                name="username"
                                                                placeholder="{{ __('Username') }}"
                                                                value="{{ $driver->username }}{{ request()->segment(count(request()->segments())) == 'create' ? old('username') : '' }}" />

                                                            @error('username')
                                                            <div class="fv-plugins-message-container invalid-feedback">
                                                                <div data-field="username" data-validator="notEmpty">
                                                                    {{ $message }}
                                                                </div>
                                                            </div>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label>{{ __('Password') }}</label>

                                                            <input
                                                                class="form-control @error('password') is-invalid @enderror"
                                                                type="password"
                                                                placeholder="{{ __('Password') }}..."
                                                                name="password"
                                                                value="{{ old('password') }}" />

                                                            @error('password')
                                                            <div class="fv-plugins-message-container invalid-feedback">
                                                                <div data-field="password" data-validator="notEmpty">
                                                                    {{ $message }}
                                                                </div>
                                                            </div>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label>{{ __('Confirm Password') }}</label>

                                                            <input
                                                                class="form-control @error('password') is-invalid @enderror"
                                                                type="password"
                                                                placeholder="{{ __('Confirm Password') }}..."
                                                                name="password_confirmation"
                                                                value="{{ old('password_confirmation') }}" />

                                                            @error('password')
                                                            <div class="fv-plugins-message-container invalid-feedback">
                                                                <div data-field="password" data-validator="notEmpty">
                                                                    {{ $message }}
                                                                </div>
                                                            </div>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label>{{ __('Status') }}</label>

                                                            <select
                                                                class="form-control @error('status') is-invalid @enderror"
                                                                name="status"
                                                                placeholder="{{ __('Status') }}"
                                                                value="{{ $driver->status }}{{ request()->segment(count(request()->segments())) == 'create' ? old('status') : '' }}" >
                                                                <option value="1">{{ __('active') }}</option>
                                                                <option value="0">{{ __('inactive') }}</option>
                                                            </select>

                                                            @error('status')
                                                            <div class="fv-plugins-message-container invalid-feedback">
                                                                <div data-field="status" data-validator="notEmpty">
                                                                    {{ $message }}
                                                                </div>
                                                            </div>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer d-flex justify-content-between">
                                            <a href="{{ url()->previous() }}"
                                                class="btn btn-sm btn-clean btn-icon mr-2">
                                                <span class="svg-icon svg-icon-xl">
                                                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M8.42034438,20 L21,20 C22.1045695,20 23,19.1045695 23,18 L23,6 C23,4.8954305 22.1045695,4 21,4 L8.42034438,4 C8.15668432,4 7.90369297,4.10412727 7.71642146,4.28972363 L0.653241109,11.2897236 C0.260966303,11.6784895 0.25812177,12.3116481 0.646887666,12.7039229 C0.648995955,12.7060502 0.651113791,12.7081681 0.653241109,12.7102764 L7.71642146,19.7102764 C7.90369297,19.8958727 8.15668432,20 8.42034438,20 Z"
                                                            id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                                                        <path
                                                            d="M12.5857864,12 L11.1715729,10.5857864 C10.7810486,10.1952621 10.7810486,9.56209717 11.1715729,9.17157288 C11.5620972,8.78104858 12.1952621,8.78104858 12.5857864,9.17157288 L14,10.5857864 L15.4142136,9.17157288 C15.8047379,8.78104858 16.4379028,8.78104858 16.8284271,9.17157288 C17.2189514,9.56209717 17.2189514,10.1952621 16.8284271,10.5857864 L15.4142136,12 L16.8284271,13.4142136 C17.2189514,13.8047379 17.2189514,14.4379028 16.8284271,14.8284271 C16.4379028,15.2189514 15.8047379,15.2189514 15.4142136,14.8284271 L14,13.4142136 L12.5857864,14.8284271 C12.1952621,15.2189514 11.5620972,15.2189514 11.1715729,14.8284271 C10.7810486,14.4379028 10.7810486,13.8047379 11.1715729,13.4142136 L12.5857864,12 Z"
                                                            id="Combined-Shape" fill="#000000"></path>
                                                    </svg>
                                                </span>
                                            </a>

                                            <button type="submit"
                                                title="{{ $driver->id ? __('Edit') : __('Create') }}"
                                                class="btn {{ $driver->id ? 'btn-warning' : 'btn-primary' }} font-weight-bolder">
                                                <span class="svg-icon svg-icon-md">
                                                    @if($driver->id)
                                                    <span
                                                        class="svg-icon svg-icon-md {{ $driver->id ? 'svg-icon-dark' : '' }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                <path
                                                                    d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                                    fill="#000000" fill-rule="nonzero"
                                                                    transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)">
                                                                </path>
                                                                <path
                                                                    d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                                    fill="#000000" fill-rule="nonzero" opacity="0.3">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                    </span>
                                                    @else
                                                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                                        <!-- Generator: Sketch 50.2 (55047) - http://www.bohemiancoding.com/sketch -->
                                                        <title>Stockholm-icons / Code / Plus</title>
                                                        <desc>Created with Sketch.</desc>
                                                        <defs></defs>
                                                        <g id="Stockholm-icons-/-Code-/-Plus" stroke="none"
                                                            stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                                            <circle id="Oval-5" fill="#000000" opacity="0.3" cx="12"
                                                                cy="12" r="10"></circle>
                                                            <path
                                                                d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z"
                                                                id="Combined-Shape" fill="#000000"></path>
                                                        </g>
                                                    </svg>
                                                    @endif
                                                </span>
                                                <span class="{{ $driver->id ? 'text-dark' : '' }}">
                                                    {{ $driver->id ? __('Edit') : __('Create') }}
                                                </span>
                                            </button>
                                        </div>
                                    </form>
                                    <!--end::Form-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Entry-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
                @include('layouts.footer')
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Main-->
    <!-- begin::User Panel-->
    @include('layouts.admin-profile')
    <!-- end::User Panel-->

    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };

    </script>

    <script src="{{ asset('metronic-template/v7/assets/js/ajax/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('metronic-template/v7/assets/js/ajax/getdata.js') }}"></script>

    <script src="{{ asset('metronic-template/v7/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('metronic-template/v7/assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
    <script src="{{ asset('metronic-template/v7/assets/js/scripts.bundle.js') }}"></script>

</body>
<!--end::Body-->
@endsection
