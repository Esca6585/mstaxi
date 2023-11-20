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
            @foreach ($routes as $route)
            <tr id="datatable">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $route->first_name  }}</td>
                <td>{{ $route->last_name  }}</td>
                <td>{{ $route->username  }}</td>
                <td>
                    <img src="{{ asset('metronic-template/v8/assets/media/flags/turkmenistan.svg') }}" alt="{{ asset('metronic-template/v8/assets/media/flags/turkmenistan.svg') }}" width="20px" >
                    <span class="car__number">{{ $route->car_number  }}</span>
                </td>
                <td>{{ $route->car_model  }}</td>
                <td>
                    <span class="badge badge-primary">
                        {{ $route->birthday  }}
                    </span>
                </td>
                <td>
                    <span class="badge badge-warning">
                        {{ $route->start_working }}
                    </span>
                </td>
                <td>
                    <span class="badge badge-{{ $route->status ? 'success' : 'danger' }}">
                        {{ $route->status ? __('active') : __('inactive') }}
                    </span>
                </td>
                <td>@include('admin-panel.route.route-action', [ $route ])</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        <div>
            {{ $routes->links('layouts.pagination') }}
        </div>
    </div>                                
</div>
