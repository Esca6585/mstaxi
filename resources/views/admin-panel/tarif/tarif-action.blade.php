<span class="dtr-data d-flex">
    <a href="{{ route(Request::segment(3) . '.show', [ app()->getlocale(), $tarif->id ] ) }}"
        class="btn btn-sm btn-clean btn-icon mr-2" title="{{ __('View') }}">
        <span class="svg-icon svg-icon-xl svg-icon-primary">
            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Stockholm-icons-/-General-/-Visible" stroke="none" stroke-width="1" fill="none"
                    fill-rule="evenodd">
                    <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                    <path
                        d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z"
                        id="Shape" fill="#000000" fill-rule="nonzero" opacity="0.4"></path>
                    <path
                        d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z"
                        id="Path" fill="#000000" opacity="1"></path>
                </g>
            </svg>
        </span>
    </a>
    <a href="{{ route(Request::segment(3) . '.edit', [ app()->getlocale(), $tarif->id ] ) }}"
        class="btn btn-sm btn-clean btn-icon mr-2 " title="{{ __('Edit') }}">
        <span class="svg-icon svg-icon-md svg-icon-warning">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"></rect>
                    <path
                        d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                        fill="#000000" fill-rule="nonzero"
                        transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)">
                    </path>
                    <path
                        d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                        fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                </g>
            </svg>
        </span>
    </a>

    <form action="{{ route(Request::segment(3) . '.destroy', [ app()->getlocale(), $tarif->id ] ) }}"
        method="post">
        @method('delete')
        @csrf

        <button type="button" class="btn btn-sm btn-clean btn-icon" title="{{ __('Delete') }}" data-toggle="modal"
            data-target="#exampleModalSizeSm-{{$tarif->id}}">
            <span class="svg-icon svg-icon-md svg-icon-danger">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path
                            d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                            fill="#000000" fill-rule="nonzero">
                        </path>
                        <path
                            d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 
                            5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                            fill="#000000" opacity="0.3">
                        </path>
                    </g>
                </svg>
            </span>
        </button>

        <div class="example-preview">
            <!--begin::Modal-->
            <div class="modal fade" id="exampleModalSizeSm-{{$tarif->id}}" tabindex="-1"
                aria-labelledby="exampleModalSizeSm-{{$tarif->id}}" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ __('Warning') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">{{ __('Are you sure you want to delete this resource?') }}</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary font-weight-bold"
                                data-dismiss="modal">{{ __('Close') }}</button>

                            <button type="submit"
                                class="btn btn-light-danger font-weight-bold">{{ __('Delete') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Modal-->
        </div>

    </form>
</span>
