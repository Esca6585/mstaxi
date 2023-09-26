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
                <th>{{ __('Birthday') }}</th>
                <th>{{ __('Start Working') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($drivers as $driver)
            <tr id="datatable">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $driver->first_name  }}</td>
                <td>{{ $driver->last_name  }}</td>
                <td>{{ $driver->username  }}</td>
                <td>
                    <img src="{{ asset('metronic-template/v8/assets/media/flags/turkmenistan.svg') }}" alt="{{ asset('metronic-template/v8/assets/media/flags/turkmenistan.svg') }}" width="20px" >
                    <span class="car__number">{{ $driver->car_number  }}</span>
                </td>
                <td>{{ $driver->car_model  }}</td>
                <td>
                    <span class="badge badge-primary">
                        {{ $driver->birthday  }}
                    </span>
                </td>
                <td>
                    <span class="badge badge-warning">
                        {{ $driver->start_working }}
                    </span>
                </td>
                <td>
                    <span class="badge badge-{{ $driver->status ? 'success' : 'danger' }}">
                        {{ $driver->status ? __('active') : __('inactive') }}
                    </span>
                </td>
                <td>@include('admin-panel.driver.driver-action', [ $driver ])</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        <div>
            {{ $drivers->links('layouts.pagination') }}
        </div>
    </div>                                
</div>
