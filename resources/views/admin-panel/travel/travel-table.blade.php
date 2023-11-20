<div id="datatable">
    <table class="table table-separate table-head-custom table-checkable">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{ __('First Name') }}</th>
                <th>{{ __('Last Name') }}</th>
                <th>{{ __('Username') }}</th>
                <th>{{ __('Car Number') }}</th>
                <th>{{ __('Car Model') }}</th>
                <th>{{ __('Price') }}</th>
                <th>{{ __('Km') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Time') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($travels as $travel)
            <tr id="datatable">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $travel->user->first_name  }}</td>
                <td>{{ $travel->user->last_name  }}</td>
                <td>{{ $travel->user->username  }}</td>
                <td>
                    <img src="{{ asset('metronic-template/v8/assets/media/flags/turkmenistan.svg') }}" alt="{{ asset('metronic-template/v8/assets/media/flags/turkmenistan.svg') }}" width="20px" >
                    <span class="car__number">{{ $travel->user->car_number  }}</span>
                </td>
                <td>{{ $travel->user->car_model  }}</td>
                <td>{{ $travel->price  }} TMT</td>
                <td>{{ $travel->km  }} km</td>
                <td>
                    <span class="badge badge-{{ $travel->status == 'go' ? 'success' : 'warning' }}">
                        {{ $travel->status }}
                    </span>
                </td>
                <td>
                    <span class="badge badge-warning">
                        {{ $travel->created_at }}
                    </span>
                </td>
                <td>@include('admin-panel.travel.travel-action', [ $travel ])</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        <div>
            {{ $travels->links('layouts.pagination') }}
        </div>
    </div>                                
</div>
