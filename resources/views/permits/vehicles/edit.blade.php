@extends('layouts.app')
@section('title')
    {{ __('Edit Vehicle Permit') }} || {{ $permit->id }}
@endsection
@section('page-title')
    {{ __('Edit Vehicle Permit') }} || <span class="text-danger">{{ $permit->id }}</span>
@endsection
@section('header')
    @include('layouts.header')
@endsection
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('page-title-desc')
@endsection
@section('content')
    <hr class="w-100 bg-dark">
    <div class="alert alert-danger text-center" id="dateerr">
        {{ __('Please Select Correct Dates To Procced') }}
    </div>
    <div class="text-center" id="dateerr">
        @include('layouts.sessions')
    </div>
    <form class="row m-auto text-center overflow-hidden" action="{{ route('permits.vehicle.store') }}" method="POST">
        @csrf
        @include('layouts.errors')
        <div class="row m-2">
            <div class="col-md m-auto">
                <div class="form-floating">
                    <select class="form-control text-capitalize form-select" name="type">
                        <option hidden selected>{{ $permit->type }}</option>
                        <option class="text-capitalize" value="daily">{{ __('daily') }}</option>
                        <option class="text-capitalize" value="monthly">{{ __('monthly') }}</option>
                    </select>
                    <label class="text-capitalize">{{ __('Permit Type') }}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="date" id="datefrm" name="date_from" class="form-control text-capitalize" placeholder="From"
                        value="{{ $permit->date_from }}">
                    <label class="text-capitalize">{{ __('start date') }}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="date" id="dateto" name="date_to" class="form-control text-capitalize" placeholder="From"
                        value="{{ $permit->date_to }}">
                    <label class="text-capitalize">{{ __('end date') }}</label>
                </div>
            </div>
        </div>
        <hr class="w-100 bg-dark">
        <div class="row m-2">
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="text" name="vehicle_num" class="form-control text-capitalize" placeholder="Vehicle No."
                        maxlength="10" value="{{ $permit->vehicle_num }}">
                    <label class="text-capitalize">{{ __('Vehicle No.') }}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <select name="vehicle_type" id="" class="text-capitalize form-select" name="vtype">
                        <option class="text-capitalize form-select" value="{{ $permit->vehicle_type }}" selected hidden>
                            {{ $permit->vehicle_type }}</option>
                        <option class="text-capitalize form-select" value="ربع نقل">ربع نقل</option>
                        <option class="text-capitalize form-select" value="نقل">نقل</option>
                        <option class="text-capitalize form-select" value="نصف نقل">نصف نقل</option>
                        <option class="text-capitalize form-select" value="نقل ثقيل">نقل ثقيل</option>
                        <option class="text-capitalize form-select" value="متوسيكل">متوسيكل</option>
                    </select>
                    <label class="text-capitalize">{{ __('Vehicle type') }}</label>

                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="text" name="vehicle_clr" class="form-control text-capitalize" placeholder="vehicle color"
                        maxlength="10" value="{{ $permit->vehicle_clr }}">
                    <label class="text-capitalize">{{ __('Vehicle color') }}</label>
                </div>
            </div>
        </div>
        <hr class="w-100 bg-dark">
        <div id="permitInfo">
            <div class="row m-2" id="driver">
                <div class="col-md m-auto">
                    <label class="text-capitalize fs-2">{{ __('Choose Drivers') }}</label>
                    <div class="form-group">
                        <select class="js-example-responsive " multiple="multiple" name="vehicle_drivers_id[]"
                            aria-placeholder="Select Drivers" id="myselect">
                            {{-- <option selected disabled hidden>{{ __('Choose Driver') }}</option> --}}
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->nid }}" @if (isset($driver->permit_id))
                                    disabled
                                    @endif @if (in_array($driver->nid, $permit->vehicle_drivers_id))
                                        selected
                                        @endif>{{ $driver->nid }} || {{ $driver->en_name }} @if (isset($driver->permit_id))
                                            || <span class="text-danger">On A Mission</span>
                                        @endif
                                </option>
                            @endforeach
                        </select>
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
                                @endif @if ($company->id == $permit->company_id))
                                    selected
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
                    <input type="text" name="mission" class="form-control text-capitalize" placeholder="Mission"
                        value="{{ $permit->mission }}">
                    <label class="text-capitalize">{{ __('mission') }}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <select name="group_id" id="" class="form-select">
                        <option value="" disabled hidden selected>{{ __('Please Select The Group') }}</option>
                        @if ($groups != null)
                            @foreach ($groups as $group_id)
                                <option value="{{ $group_id }}" @if ($permit->group_id == $group_id)
                                    selected
                            @endif>{{ Auth::user()->group($group_id)->group_name }}
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
                <h3 class="text-center text-capitalize text-decoration-underline m-3">{{ __('access gate') }}</h3>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="access_gate[]" value="NCB" @if (in_array('NCB', $permit->access_gate))
                    checked
                    @endif>
                    <label class="form-check-label" for="inlineCheckbox1">{{ __('NCB') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="access_gate[]" value="farm" @if (in_array('farm', $permit->access_gate))
                    checked
                    @endif>
                    <label class="form-check-label" for="inlineCheckbox2">{{ __('Farm') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="access_gate[]" value="Old Fillas" @if (in_array('Old Fillas', $permit->access_gate))
                    checked
                    @endif>
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('Old Fillas') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="access_gate[]" value="Logistics" @if (in_array('Logistics', $permit->access_gate))
                    checked
                    @endif>
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('Logistics') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="access_gate[]" value="Contractors" @if (in_array('Contractors', $permit->access_gate))
                    checked
                    @endif>
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('Contractors') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="access_gate[]" value="Materials" @if (in_array('Materials', $permit->access_gate))
                    checked
                    @endif>
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('Materials') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="access_gate[]" value="Gahdam" @if (in_array('Gahdam', $permit->access_gate))
                    checked
                    @endif>
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('Gahdam') }}</label>
                </div>

            </div>
            <div class="container col-md-4">
                <h3 class="text-center text-capitalize text-decoration-underline m-3">{{ __('allowed plant areas') }}
                </h3>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="allowed_sectors[]" value="Quarries" @if (in_array('Quarries', $permit->allowed_sectors))
                    checked
                    @endif>
                    <label class="form-check-label" for="inlineCheckbox1">{{ __('Quarries') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="allowed_sectors[]" value="Materials WH"
                        @if (in_array('Materials WH', $permit->allowed_sectors))
                    checked
                    @endif>
                    <label class="form-check-label" for="inlineCheckbox2">{{ __('Materials WH') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="allowed_sectors[]" value="Clincker" @if (in_array('Clincker', $permit->allowed_sectors))
                    checked
                    @endif>
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('Clincker') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="allowed_sectors[]" value="Internal Farm"
                        @if (in_array('Internal Farm', $permit->allowed_sectors))
                    checked
                    @endif>
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('Internal Farm') }}</label>
                </div>
            </div>
            <div class="container col-md-4">
                <h3 class="text-center text-capitalize text-decoration-underline m-3">{{ __('internal movement Gate') }}
                </h3>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="movement_gates[]" value="quarries" @if (in_array('quarries', $permit->movement_gates))
                    checked
                    @endif>
                    <label class="form-check-label" for="inlineCheckbox1">{{ __('quarries') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="movement_gates[]" value="farm" @if (in_array('farm', $permit->movement_gates))
                    checked
                    @endif>
                    <label class="form-check-label" for="inlineCheckbox2">{{ __('farm') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="movement_gates[]" value="petcoke" @if (in_array('petcoke', $permit->movement_gates))
                    checked
                    @endif>
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('petcoke') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="movement_gates[]" value="fencies" @if (in_array('fencies', $permit->movement_gates))
                    checked
                    @endif>
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('fincies') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="movement_gates[]" value="NCB" @if (in_array('NCB', $permit->movement_gates))
                    checked
                    @endif>
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('NCB') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="movement_gates[]" value="materials WH"
                        @if (in_array('materials WH', $permit->movement_gates))
                    checked
                    @endif>
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('materials wH') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="movement_gates[]" value="rock quarries"
                        @if (in_array('movement_gates', $permit->movement_gates))
                    checked
                    @endif>
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('rock quarries') }}</label>
                </div>
                <div class="form-check form-check-inline form-switch col-md-5 text-capitalize m-auto">
                    <input class="form-check-input" type="checkbox" name="movement_gates[]" value="clay gate" @if (in_array('clay gate', $permit->movement_gates))
                    checked
                    @endif>
                    <label class="form-check-label" for="inlineCheckbox3">{{ __('clay gate') }}</label>
                </div>
            </div>
        </div>
        <hr class=" w-100 m-auto mb-2 mt-2">
        <div class="col-md-6 m-auto mb-2">
            <button type="submit" class="btn btn-success w-100 m-3">{{ __('Submit') }}</button>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        /* $('#permitInfo')=''; */
        $(document).ready(function() {
            $('#type').attr('disabled', 'disabled');
            $('#dateerr').hide();
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
            var i = 0;
            $(document).on('change', '#myselect', function() {
                i = i + 1;
                if (i == 4) {
                    alert('this permit now has 4 Drivers');
                }

            });
        });
        $(".js-example-responsive").select2({
            width: 'resolve' // need to override the changed default
        });
    </script>
@endsection
