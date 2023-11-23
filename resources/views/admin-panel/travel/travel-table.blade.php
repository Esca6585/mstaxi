<div id="datatable">
    <table class="table table-separate table-head-custom table-checkable">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{ __('First Name') }} {{ __('Last Name') }}</th>
                <th>{{ __('Car Number') }}</th>
                <th>{{ __('Car Model') }}</th>
                <th>{{ __('Price') }}</th>
                <th>{{ __('Km') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Time') }}</th>
                <th>{{ __('Latitude and Longitude') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($travels as $travel)
            <tr id="datatable">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $travel->user->first_name  }} {{ $travel->user->last_name  }}</td>
                <td>
                    <img src="{{ asset('metronic-template/v8/assets/media/flags/turkmenistan.svg') }}" alt="{{ asset('metronic-template/v8/assets/media/flags/turkmenistan.svg') }}" width="20px" >
                    <span class="car__number">{{ $travel->user->car_number  }}</span>
                </td>
                <td>{{ $travel->user->car_model  }}</td>
                <td>{{ $travel->price  }} TMT</td>
                <td>{{ $travel->km  }} km</td>
                <td>
                    <span class="@if($travel->status == 'go') badge badge-success @elseif($travel->status == 'waiting') badge badge-warning @else badge badge-primary @endif">
                        {{ $travel->status }}
                    </span>
                </td>
                <td>
                    <span class="badge badge-warning">
                        {{ $travel->created_at }}
                    </span>
                    @if($travel->time_of_waiting)
                    <hr>
                    <span class="badge badge-secondary">
                        {{ $travel->time_of_waiting }}
                    </span>
                    @endif
                </td>
                <td>
                    <a href="http://www.google.com/maps/place/{{ $travel->lat }}, {{ $travel->lon }}/{{ '@' . $travel->lat }}, {{ $travel->lon }},17z/data=!3m1!1e3" target="_blank">start: {{ $travel->lat }}, {{ $travel->lon }}</a>    
                    @if($travel->lat_finish && $travel->lon_finish)
                    <hr>
                    <a href="http://www.google.com/maps/place/{{ $travel->lat_finish }}, {{ $travel->lon_finish }}/{{ '@' . $travel->lat_finish }}, {{ $travel->lon_finish }},17z/data=!3m1!1e3" target="_blank">finish: {{ $travel->lat_finish }}, {{ $travel->lon_finish }}</a>    
                    @endif
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
