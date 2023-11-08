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
            @foreach ($users as $user)
            <tr id="datatable">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->first_name  }}</td>
                <td>{{ $user->last_name  }}</td>
                <td>{{ $user->username  }}</td>
                <td>
                    <img src="{{ asset('metronic-template/v8/assets/media/flags/turkmenistan.svg') }}" alt="{{ asset('metronic-template/v8/assets/media/flags/turkmenistan.svg') }}" width="20px" >
                    <span class="car__number">{{ $user->car_number  }}</span>
                </td>
                <td>{{ $user->car_model  }}</td>
                <td>
                    <span class="badge badge-primary">
                        {{ $user->birthday  }}
                    </span>
                </td>
                <td>
                    <span class="badge badge-warning">
                        {{ $user->start_working }}
                    </span>
                </td>
                <td>
                    <span class="badge badge-{{ $user->status ? 'success' : 'danger' }}">
                        {{ $user->status ? __('active') : __('inactive') }}
                    </span>
                </td>
                <td>@include('admin-panel.user.user-action', [ $user ])</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        <div>
            {{ $users->links('layouts.pagination') }}
        </div>
    </div>                                
</div>
