<div id="datatable">
    <table class="table table-separate table-head-custom table-checkable">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{ __('First Name') }}</th>
                <th>{{ __('Last Name') }}</th>
                <th>{{ __('Username') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
            <tr id="datatable">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $admin->first_name  }}</td>
                <td>{{ $admin->last_name  }}</td>
                <td>{{ $admin->username  }}</td>
                <td>@include('admin-panel.admin.admin-action', [ $admin ])</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        <div>
            {{ $admins->links('layouts.pagination') }}
        </div>
    </div>                                
</div>
