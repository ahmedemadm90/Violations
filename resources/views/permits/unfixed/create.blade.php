@extends('layouts.app')
@section('title')
    {{ __('Create Unfixed Permit') }}
@endsection
@section('header')
    @include('layouts.header')
@endsection
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('page-title')
    {{ __('New Unfixed Service Workers Permit') }}
@endsection
@section('content')
    <div class="row">
        @can('Unfixed Permit List')

            <div class="col-lg-12 m-2">
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('unfixed.permits.index') }}"> {{ __('Back') }}</a>
                </div>
            </div>
        @endcan
    </div>
    <hr class="w-100 bg-dark">
    <div class="container text-capitalize text-center" style="font-family: sans-serif">
        @include('layouts.errors')
        <div class="row">
            <div class="alert alert-danger text-center" id="errDriver">
                {{ __('Permit Must Have At Least One Worker') }}
            </div>
            <div class="alert alert-danger text-center" id="dateerr">
                {{ __('Please Select Correct Dates To Procced') }}
            </div>
            <form class="row m-auto text-center" action="{{ route('unfixed.permit.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div id="permitInfo">
                    <div class="row border-bottom" id="driver">
                        <div class="col-md m-auto">
                            <h3 class="text-capitalize">{{ __('Worker Name') }}</h3>
                            <select name="workers_ids[]" class="js-example-responsive w-75 form-select m-2"
                                multiple="multiple" placeholder="The Worker">
                                @foreach ($unfixed_workers as $worker)
                                    <option value="{{ $worker->nid }}" @if (isset($worker->company_id))
                                        disabled
                                @endif>{{ $worker->nid }} || {{ $worker->en_name }}
                                @if (isset($worker->company_id))
                                    || <span class="text-danger">on mission now</span>
                                @endif
                                </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-md m-auto">
                        <div class="form-floating">
                            <input type="date" id="datefrm" name="start_date" class="form-control text-capitalize"
                                placeholder="From">
                            <label class="text-capitalize">{{ __('start date') }}</label>
                        </div>
                    </div>
                    <div class="col-md m-auto">
                        <div class="form-floating">
                            <input type="date" id="dateto" name="end_date" class="form-control text-capitalize"
                                placeholder="From">
                            <label class="text-capitalize">{{ __('end date') }}</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-md m-auto">
                        <div class="form-floating">
                            <select name="company_id" class="form-select text-capitalize" placeholder="Company">
                                <option disabled hidden selected>{{ __('Choose Company') }}</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                @endforeach
                            </select>
                            <label class="text-capitalize">{{ __('company') }}</label>
                        </div>
                    </div>
                    <div class="col-md m-auto">
                        <div class="form-floating">
                            <select name="group_id" id="" class="form-select">
                                <option value="" disabled hidden selected>{{ __('Please Select The Group') }}</option>
                                @if ($groups != null)
                                    @foreach ($groups as $group_id)
                                        <option value="{{ $group_id }}">
                                            {{ Auth::user()->group($group_id)->group_name }}</option>
                                    @endforeach
                                @else
                                    <option value="" disabled selected hidden>Contact Your Admin Please</option>
                                @endif
                            </select>
                            <label class="text-capitalize">{{ __('Permit Group') }}</label>
                        </div>
                    </div>
                    <div class="row border-top mt-2">
                        <div class="col-md m-auto">
                            <h3 class="text-capitalize">{{ __('Permit Shifts') }}</h3>
                            <select name="shifts[]" class="js-example-responsive w-75 form-select" multiple="multiple"
                                placeholder="The Worker">
                                <option value="8 AM ~ 4 PM">1st [8 AM ~ 4 PM]</option>
                                <option value="4 PM ~ 12 AM">1st [4 PM ~ 12 AM]</option>
                                <option value="12 AM ~ 8 AM">1st [12 AM ~ 8 AM]</option>
                            </select>

                        </div>
                        <div class="col-md">
                            <h3 class="text-capitalize">{{ __('Permit Task') }}</h3>
                            <input type="text" name="task" id="" class="form-control">
                        </div>
                    </div>
                </div>
                <hr class=" w-100 m-auto mb-2 mt-2">
                <div class="col-md-6 m-auto mb-2">
                    <button type="submit" class="btn btn-success w-100 m-3">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
        <hr class="w-100 text-bolder">
    </div>
@endsection
@section('scripts')
    <script>
        $(".js-example-responsive").select2({
            width: 'resolve' // need to override the changed default
        });
        /* $('#permitInfo')=''; */
        $(document).ready(function() {
            $('#type').attr('disabled', 'disabled');
            $('#errDriver').hide();
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
        });
    </script>
@endsection
