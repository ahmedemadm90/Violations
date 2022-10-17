@extends('layouts.app')
@section('title')
    {{ __('تسجيل شاحنة') }}
@endsection
@section('page-title')
    {{ __('تسجيل شاحنة') }}
@endsection
@section('header')
    @include('layouts.header')
@endsection
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('content')
    <hr class="w-100 bg-dark">
    @include('layouts.sessions')
    <div class="row">
        <div class="col-lg-12 mb-3">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('records.index') }}">{{ __('Back') }}</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col border-right">
            <form class="form-floating text-center col-md-8 m-auto" action="{{ route('records.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating m-3 w-auto">
                            <input type="text" class="form-control text-capitalize" id="floatingInput"
                                placeholder="title Name" name="truck_no">
                            <label for="floatingInput" class="text-capitalize">{{ __('رقم الشاحنة') }}</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating m-3 w-auto">
                            <input type="text" class="form-control text-capitalize" id="floatingInput"
                                placeholder="Driver Name" name="driver_name">
                            <label for="floatingInput" class="text-capitalize">{{ __('السائق') }}</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating m-3 w-auto">
                            <input type="text" class="form-control text-capitalize" id="floatingInput"
                                placeholder="driver id" name="driver_id">
                            <label for="floatingInput" class="text-capitalize">{{ __('رقم الرخصة') }}</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating m-3 w-auto">
                            <input type="text" class="form-control text-capitalize" id="floatingInput" placeholder="company"
                                name="company">
                            <label for="floatingInput" class="text-capitalize">{{ __('الشركة') }}</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating m-3 w-auto">
                            <input type="text" class="form-control text-capitalize" id="floatingInput"
                                placeholder="Driver Name" name="carage">
                            <label for="floatingInput" class="text-capitalize">{{ __('الحمولة') }}</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating m-3 w-auto">
                            <input type="text" class="form-control text-capitalize" id="floatingInput"
                                placeholder="driver id" name="permit_id">
                            <label for="floatingInput" class="text-capitalize">{{ __('رقم التصريح') }}</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-lg-2 col-sm-2 m-auto">
                        <button class="btn btn-success text-capitalize ">تسجيل</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col border-right">
            <form class="form-floating text-center col-md-8 m-auto" action="{{ route('records.store') }}" method="POST">
                @csrf


            </form>
        </div>
    </div>

@endsection
