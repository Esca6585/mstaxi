<!--begin::Alert-->
@if(session()->has('success-create'))
<div class="alert alert-fixed alert-custom alert-light-primary fade show mb-5" id="alert-message" role="alert">
    <div class="alert-icon">
        <i class="flaticon2-plus text-primary"></i>
    </div>
    <div class="alert-text">{{ __(session()->get('success-create')) }}</div>
    <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
                <i class="ki ki-close"></i>
            </span>
        </button>
    </div>
</div>
@endif

@if(session()->has('success-update'))
<div class="alert alert-fixed alert-custom alert-light-warning fade show mb-5" id="alert-message" role="alert">
    <div class="alert-icon">
        <i class="flaticon2-edit text-warning"></i>
    </div>
    <div class="alert-text">{{ __(session()->get('success-update')) }}</div>
    <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
                <i class="ki ki-close"></i>
            </span>
        </button>
    </div>
</div>
@endif

@if(session()->has('success-delete'))
<div class="alert alert-fixed alert-custom alert-light-danger fade show mb-5" id="alert-message" role="alert">
    <div class="alert-icon">
        <i class="flaticon-delete text-danger"></i>
    </div>
    <div class="alert-text">{{ __(session()->get('success-delete')) }}</div>
    <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
                <i class="ki ki-close"></i>
            </span>
        </button>
    </div>
</div>
@endif

@if(session()->has('warning'))
<div class="alert alert-fixed alert-custom alert-light-danger fade show mb-5" id="alert-message" role="alert">
    <div class="alert-icon">
        <i class="flaticon-warning text-danger"></i>
    </div>
    <div class="alert-text">{{ __(session()->get('warning')) }}</div>
    <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
                <i class="ki ki-close"></i>
            </span>
        </button>
    </div>
</div>
@endif
<!--end::Alert-->