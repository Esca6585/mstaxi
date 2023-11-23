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
                <th>{{ __('every minute price outside') }}</th>
                <th>{{ __('every km price outside') }}</th>
                <th>{{ __('additional tarif') }}</th>
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
                <td>
                    <span class="badge badge-warning">
                        {{ $tarif->minimum_price }} TMT
                    </span>
                </td>
                <td>
                    <span class="badge badge-primary">
                        {{ $tarif->every_minute_price }} TMT
                    </span>
                </td>
                <td>
                    <span class="badge badge-primary">
                        {{ $tarif->every_km_price }} TMT
                    </span>
                </td>
                <td>
                    <span class="badge badge-success">
                        {{ $tarif->every_waiting_price }} TMT
                    </span>
                </td>
                <td>
                    <span class="badge badge-danger">
                        {{ $tarif->every_minute_price_outside }} TMT
                    </span>
                </td>
                <td>
                    <span class="badge badge-danger">
                        {{ $tarif->every_km_price_outside }} TMT
                    </span>
                </td>
                <td>
                    @if($tarif->additional_tarif)
                    <span class="badge badge-secondary">
                        {{ __('additional tarif') }}
                    </span>
                    @else
                    <span class="badge badge-warning">
                        {{ __('not additional tarif') }}
                    </span>
                    @endif
                </td>
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