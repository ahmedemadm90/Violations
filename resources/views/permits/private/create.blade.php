@extends('layouts.app')
@section('title')
    Request Private Permit
@endsection
@section('page-title')
    Request Private Permit
@endsection
@section('header')
    @include('layouts.header')
@endsection
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('content')
    <hr class="w-100 bg-dark">
    <div class="alert alert-danger text-center" id="errDriver">
        {{ __('Driver Permit Must Have At Least One Driver') }}
    </div>
    <div class="alert alert-danger text-center" id="dateerr">
        {{ __('Please Select Correct Dates To Procced') }}
    </div>
    <form class="row m-auto text-center overflow-hidden" action="{{ route('permits.private.store') }}" method="POST">
        @csrf
        @include('layouts.errors')
        <div class="row m-2">
            <div class="col-md m-auto">
                <div class="form-floating">
                    <select class="form-control text-capitalize form-select" name="type">
                        <option hidden selected>Choose permit type</option>
                        <option class="text-capitalize" value="daily">daily</option>
                        <option class="text-capitalize" value="monthly">monthly</option>
                    </select>
                    <label class="text-capitalize">{{ __('Permit Type') }}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="date" id="datefrm" name="date_from" class="form-control text-capitalize"
                        placeholder="From">
                    <label class="text-capitalize">{{ __('start date') }}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="date" id="dateto" name="date_to" class="form-control text-capitalize" placeholder="From">
                    <label class="text-capitalize">{{ __('end date') }}</label>
                </div>
            </div>
        </div>
        <hr class="w-100 bg-dark">
        <div class="row m-2">
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="text" name="vehicle_num" class="form-control text-capitalize" placeholder="Vehicle No."
                        maxlength="10">
                    <label class="text-capitalize">{{ __('Vehicle No.') }}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="text" name="vehicle_clr" class="form-control text-capitalize" placeholder="vehicle color"
                        maxlength="10">
                    <label class="text-capitalize">{{ __('Vehicle color') }}</label>
                </div>
            </div>
        </div>
        <hr class="w-100 bg-dark">
        <div id="permitInfo">
            <div class="row m-2" id="driver">
                <div class="col-md m-auto">
                    <div class="form-floating">
                        <select class="js-example-responsive" multiple="multiple" style="width: 75%"
                            name="vehicle_drivers_id[]" aria-placeholder="Select Driver">
                            {{-- <option selected disabled hidden>{{ __('Choose Driver') }}</option> --}}
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->nid }}" @if (isset($driver->permit_id))
                                    disabled
                                    @endif>{{ $driver->nid }} || {{ $driver->en_name }} @if (isset($driver->permit_id))
                                        || <span class="text-danger">On A Mission</span>
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        <label class="text-capitalize">{{ __('Choose Driver') }}</label>
                    </div>
                </div>

            </div>
        </div>
        <hr class=" w-100 m-auto mb-2 mt-2">
        <div class="row">
            <div class="col-md m-auto">
                <div class="form-floating">
                    {{-- <input type="text" name="company" class="form-control text-capitalize" placeholder="Driver"> --}}
                    <select name="company_id" class="form-select">
                        <option class="" disabled hidden selected>{{ __('Select Company') }}</option>
                        @foreach ($service_comps as $company)
                            <option class="" value="{{ $company->id }}" @if ($company->active != 1)
                                disabled
                                @endif>{{ $company->company_name }} @if ($company->active != 1)
                                    || No Permits Allowed On This Company Now
                                @endif
                            </option>
                        @endforeach
                    </select>
                    <label class="text-capitalize">{{ __('company') }}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="text" name="mission" class="form-control text-capitalize" placeholder="Driver">
                    <label class="text-capitalize">{{ __('mission') }}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <select name="group_id" id="" class="form-select">
                        <option value="" disabled hidden selected>{{ __('Please Select The Group') }}</option>
                        @if ($groups != null)
                            @foreach ($groups as $group_id)
                                <option value="{{ $group_id }}">{{ Auth::user()->group($group_id)->group_name }}
                                </option>
                            @endforeach
                        @else
                            <option value="" disabled selected hidden>Contact Your Admin Please</option>
                        @endif
                    </select>
                    <label class="text-capitalize">{{ __('Permit Group') }}</label>
                </div>
            </div>
        </div>
        <hr class=" w-100 m-auto mb-2 mt-2">
        <div class="row">
            <div class="container col-md-4">
                <h3 class="text-center text-capitalize text-decoration-underline m-3">allowed access gate</h3>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="access_gate[]" value="main gate">
                    <label class="form-check-label" for="inlineCheckbox1">{{ __('Main Gate') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="access_gate[]" value="NCB">
                    <label class="form-check-label" for="inlineCheckbox1">{{ __('NCB') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="access_gate[]" value="farm">
                    <label class="form-check-label" for="inlineCheckbox2">{{ __('Farm') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="access_gate[]" value="Old Fillas">
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('Old Fillas') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="access_gate[]" value="Logistics">
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('Logistics') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="access_gate[]" value="Contractors">
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('Contractors') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="access_gate[]" value="Materials">
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('Materials') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="access_gate[]" value="Gahdam">
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('Gahdam') }}</label>
                </div>

            </div>
            <div class="container col-md-4">
                <h3 class="text-center text-capitalize text-decoration-underline m-3">allowed planet sectors</h3>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="allowed_sectors[]" value="Quarries">
                    <label class="form-check-label" for="inlineCheckbox1">{{ __('Quarries') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="allowed_sectors[]" value="Materials WH">
                    <label class="form-check-label" for="inlineCheckbox2">{{ __('Materials WH') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="allowed_sectors[]" value="Clincker">
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('Clincker') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="allowed_sectors[]" value="Internal Farm">
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('Internal Farm') }}</label>
                </div>
            </div>
            <div class="container col-md-4">
                <h3 class="text-center text-capitalize text-decoration-underline m-3">movement Gate</h3>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="movement_gates[]" value="quarries">
                    <label class="form-check-label" for="inlineCheckbox1">{{ __('quarries') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="movement_gates[]" value="farm">
                    <label class="form-check-label" for="inlineCheckbox2">{{ __('farm') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="movement_gates[]" value="petcoke">
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('petcoke') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="movement_gates[]" value="fencies">
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('fincies') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="movement_gates[]" value="NCB">
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('NCB') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="movement_gates[]" value="materials WH">
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('materials wH') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="movement_gates[]" value="rock quarries">
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('rock quarries') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="movement_gates[]" value="clay gate">
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('clay gate') }}</label>
                </div>
            </div>
        </div>
        <hr class=" w-100 m-auto mb-2 mt-2">
        <div class="col-md-6 m-auto mb-2">
            <button type="submit" class="btn btn-success w-100 m-3">Submit</button>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        /* $('#permitInfo')=''; */
        $(document).ready(function() {
            $('#type').attr('disabled', 'disabled');
            $('#dateerr').hide();
            $('#errDriver').hide();
            $('#drivers-count').val(1);

            $(document).on('change', '#dateto', function() {
                if ($('#datefrm').val() > $('#dateto').val()) {
                    $('#dateerr').show();
                    $('#datefrm').val('');
                    $('#dateto').val('');
                    $('#datefrm').focus();
                }
                if ($('#dateerr').is(':visible')) {
                    setTimeout(function() {
                        $('#dateerr').fadeOut();
                    }, 5000);
                };

            });
        });
        $(".js-example-responsive").select2({
            width: 'resolve' // need to override the changed default
        });
    </script>
@endsection
