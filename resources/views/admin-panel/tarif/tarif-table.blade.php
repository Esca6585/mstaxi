<div id="datatable">
    <table class="table table-separate table-head-custom table-checkable">
        <thead>
            <tr>
                <th>ID</th>
                @foreach (Config::get('languages') as $lang => $language)
                <th>{{ __('Name') }} ({{ $language['name'] }})</th>
                @endforeach
                <th>{{ __('Img') }}</th>
                <th>{{ __('minimum price') }}</th>
                <th>{{ __('every minute price') }}</th>
                <th>{{ __('every km price') }}</th>
                <th>{{ __('every waiting price') }}</th>
                <th>{{ __('every waiting price free') }}</th>
                <th>{{ __('every minute price outside') }}</th>
                <th>{{ __('every km price outside') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tarifs as $tarif)
            <tr id="datatable">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $tarif->name_tm }}</td>
                <td>{{ $tarif->name_ru }}</td>
                <td><img src="{{ asset($tarif->image) }}" alt="{{ $tarif->image }}" width="50px"></td>
                <td>{{ $tarif->minimum_price }}</td>
                <td>{{ $tarif->every_minute_price }}</td>
                <td>{{ $tarif->every_km_price }}</td>
                <td>{{ $tarif->every_waiting_price }}</td>
                <td>{{ $tarif->every_waiting_price_free }}</td>
                <td>{{ $tarif->every_minute_price_outside }}</td>
                <td>{{ $tarif->every_km_price_outside }}</td>
                <td>@include('admin-panel.tarif.tarif-action', [ $tarif ])</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        <div>
            {{ $tarifs->links('layouts.pagination') }}
        </div>
    </div>                                
</div>