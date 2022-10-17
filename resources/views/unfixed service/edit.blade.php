@extends('layouts.app')
@section('title')
    Edit VP
@endsection

@section('header')
    @include('layouts.header')
@endsection
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('page-title')
    Edit Worker <span class="text-danger">{{ $worker->en_name }}</span>
@endsection
@section('content')
    <hr class="w-100 bg-dark">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('unfixed.emps.index') }}">Back</a>
            </div>
        </div>
    </div>
    <form class="form-floating text-center col-md-12 m-auto text-capitalize"
        action="{{ route('unfixed.emp.update', $worker->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('layouts.errors')
        <div class="row m-2">
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" placeholder="worker name" name="en_name"
                        value="{{ $worker->en_name }}">
                    <label for=" floatingInput">{{ __('En Worker Name') }}</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" placeholder="worker name" name="ar_name"
                        value="{{ $worker->ar_name }}">
                    <label for="floatingInput">{{ __('Ar Worker Name') }}</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" placeholder="En Worker job" name="en_job"
                        value="{{ $worker->en_job }}">
                    <label for="floatingInput">{{ __('En Worker job') }}</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Ar Worker job" name="ar_job"
                        value="{{ $worker->ar_job }}">
                    <label for="floatingInput">{{ __('Ar Worker job') }}</label>
                </div>
            </div>

        </div>
        <div class="row m-2">
            <div class="col-md">
                <div class="form-floating m-auto">
                    <input type="number" class="form-control" id="floatingInput" placeholder="national ID" name="nid"
                        value="{{ $worker->nid }}">
                    <label for="floatingInput">{{ __('National ID') }}</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating m-auto">
                    <input type="number" class="form-control" id="floatingInput" placeholder="phone number 1"
                        name="phone1" value="{{ $worker->phone1 }}">
                    <label for="floatingInput">{{ __('Phone Number 1') }}</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating m-auto">
                    <input type="number" class="form-control" id="floatingInput" placeholder="phone number 2"
                        name="phone2" value="{{ $worker->phone2 }}">
                    <label for="floatingInput">{{ __('Phone Number 2') }}</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating m-auto">
                    <input type="text" class="form-control" id="floatingInput" placeholder="mobile" name="address"
                        value="{{ $worker->address }}">
                    <label for="floatingInput">{{ __('address') }}</label>
                </div>
            </div>
        </div>
        <div class="row m-2">
            <div class="col-md">
                <div class="form-floating">
                    <select class="form-select text-capitalize" id="floatingSelect"
                        aria-label="Floating label select example" name="gender">
                        <option selected hidden>{{ $worker->gender }}</option>
                        <option value="male">male</option>
                        <option value="female">female</option>
                    </select>
                    <label for="floatingSelect">Gender</label>
                </div>
            </div>

            <div class="col-md m-2">
                <div class="form-check form-switch">
                    <input class="form-check-input fs-3" type="checkbox" role="switch" id="Active" value="1" name="active"
                        @if ($worker->active == '1')
                    checked
                    @endif>
                    <label class="form-check-label" for="Active">Active</label>
                </div>
            </div>
            <div class="col-md m-2">
                <div class="form-check form-switch">
                    <input class="form-check-input fs-3" type="checkbox" role="switch" id="blacklist" value="1"
                        name="blacklist" @if ($worker->blacklist == '1')
                    checked
                    @endif>
                    <label class="form-check-label" for="blacklist">blacklist</label>
                </div>
            </div>
        </div>
        <div class="row m-2">
            <button class="btn btn-success text-capitalize col-md-3 m-auto">{{ __('Submit') }}</button>
        </div>
    </form>
@endsection
