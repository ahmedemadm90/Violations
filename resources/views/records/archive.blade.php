@extends('layouts.app')
@section('title')
    {{ __('Gates Archive') }}
@endsection
@section('page-title')
    <div class="row">
        <span class="col-md-6">{{ __('Gates Archive') }}</span>
        @can('Dashboard Date Statics')
            <div class="col-md-6">
                <form action="{{ route('records.search') }}" class="row form form-inline" method="post">
                    @csrf
                    <div class="col-md m-auto">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingInputGrid" name="search"
                                placeholder="violation Date" id="date_from">
                            <label for="floatingInputGrid" class="fs-5">{{ __('Search') }}</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success" id="dashboardjson">{{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
        @endcan
    </div>
@endsection
@section('header')
    @include('layouts.header')
@endsection
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('content')
    @include('layouts.sessions')
    <table class="table table-hover text-center text-capitalize">
        <tr>
            <th>#</th>
            <th>{{ __('Truck No') }}</th>
            <th>{{ __('Driver Name') }}</th>
            <th>{{ __('License No') }}</th>
            <th>{{ __('Company') }}</th>
            <th>{{ __('Payload') }}</th>
            <th>{{ __('Gate') }}</th>
            <th>{{ __('Time In') }}</th>
            <th>{{ __('Time Out') }}</th>
        </tr>
        @foreach ($records as $record)
            <tr id="table_row">
                <td>{{ ++$i }}</td>
                <td class="text-capitalize">{{ $record->truck_no }}</td>
                <td class="text-capitalize">{{ $record->driver_name }}</td>
                <td class="text-capitalize">{{ $record->driver_id }}</td>
                <td class="text-capitalize">{{ $record->company }}</td>
                <td class="text-capitalize">{{ $record->carage }}</td>
                <td class="text-capitalize">{{ $record->user_id }}</td>
                <td class="text-capitalize">
                    <span class="badge bg-success">{{ $record->created_at }}</span>
                </td>

                @if (isset($record->time_out))
                    <td class="text-capitalize">
                        <span class="badge bg-info">{{ $record->time_out }}</span>
                    </td>
                @else
                    <td class="text-capitalize">مازالت بالداخل</td>
                @endif

            </tr>
        @endforeach
    </table>

@endsection
