@extends('layouts.app')
@section('title')
    {{ __('الارشيف') }}
@endsection
@section('page-title')
    <div class="row">
        <h2 class="col-lg col-md col-sm pull-left">{{ __('ارشيف البوابة') }}</h2>
    </div>
@endsection
@section('header')
    @include('layouts.header')
@endsection
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('content')
    <hr>
    @can('Hauler Create')
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right m-2">
                    <a class="btn btn-success" href="{{ route('records.create') }}"> {{ __('تسجيل') }}</a>
                </div>
            </div>
        </div>
    @endcan
    @include('layouts.sessions')
    <table class="table table-hover text-center text-capitalize">
        <tr>
            <th>#</th>
            <th>{{ __('رقم الشاحنة') }}</th>
            <th>{{ __('اسم السائق') }}</th>
            <th>{{ __('رقم الرخصة') }}</th>
            <th>{{ __('الشركة') }}</th>
            <th>{{ __('الحمولة') }}</th>
            <th>{{ __('تسجيل خروج') }}</th>
        </tr>
        @foreach ($records as $record)
            <tr>
                <td>{{ ++$i }}</td>
                <td class="text-capitalize">{{ $record->truck_no }}</td>
                <td class="text-capitalize">{{ $record->driver_name }}</td>
                <td class="text-capitalize">{{ $record->driver_id }}</td>
                <td class="text-capitalize">{{ $record->company }}</td>
                <td class="text-capitalize">{{ $record->carage }}</td>
                @if (!isset($record->time_out))
                    <td class="text-capitalize">
                        <form action="{{ route('records.out', $record->id) }}"><button
                                class="btn btn-danger">خروج</button></form>
                    </td>
                @else
                    <td class="text-capitalize">{{ $record->time_out }}</td>
                @endif

            </tr>
        @endforeach
    </table>

@endsection
