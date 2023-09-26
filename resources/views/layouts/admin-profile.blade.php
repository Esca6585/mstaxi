<!-- begin::User Panel-->
<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
    <!--begin::Header-->
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
        <h3 class="font-weight-bold m-0">{{ __('Admin') }} {{ __('Profile') }}</h3>
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
            <i class="ki ki-close icon-xs text-muted"></i>
        </a>
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="offcanvas-content pr-5 mr-n5">
        <!--begin::Header-->
        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5">
                <div class="symbol-label" style="background-image:url('/metronic-template/v7/assets/media/users/300_21.jpg')"></div>
                <i class="symbol-badge bg-success"></i>
            </div>
            <div class="d-flex flex-column">
                <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{ Auth::guard('admin')->user()->first_name }} {{ Auth::guard('admin')->user()->last_name }}</a>
                <div class="text-muted mt-1">{{ __('Admin') }}</div>
                <div class="navi mt-2">
                    <form action="{{ route('admin.logout', app()->getlocale() ) }}" method="post">
                        @csrf
                        <button href="#" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">{{ __('Logout') }}</button>
                    </form>
                </div>
            </div>
        </div>
        <!--end::Header-->
    </div>
    <!--end::Content-->
</div>
<!-- end::User Panel-->