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
                <th>{{ __('Lon') }}</th>
                <th>{{ __('Lat') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($routes as $route)
            <tr id="datatable">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $route->user->first_name  }}</td>
                <td>{{ $route->user->last_name  }}</td>
                <td>{{ $route->user->username  }}</td>
                <td>
                    <img src="{{ asset('metronic-template/v8/assets/media/flags/turkmenistan.svg') }}" alt="{{ asset('metronic-template/v8/assets/media/flags/turkmenistan.svg') }}" width="20px" >
                    <span class="car__number">{{ $route->user->car_number  }}</span>
                </td>
                <td>{{ $route->user->car_model  }}</td>
                <td>{{ $route->price  }} TMT</td>
                <td>{{ $route->km  }} km</td>
                <td>
                    <span class="badge badge-{{ $route->travel->status == 'go' ? 'success' : 'warning' }}">
                        {{ $route->travel->status }}
                    </span>
                </td>
                <td>
                    <span class="badge badge-warning">
                        {{ $route->created_at }}
                    </span>
                </td>
                <td>{{ $route->lat  }}</td>
                <td>{{ $route->lon  }}</td>
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
