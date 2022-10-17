@extends('layouts.app')
@section('title')
    CLM || {{ __('Pending Group Permits') }}
@endsection
@section('header')
    @include('layouts.header')
@endsection
@section('sidebar')
    @include('layouts.sidebar')
@endsection
{{-- @section('content')
    @can('Unfixed Permit Create')
        <div class="row">
            <div class="col-lg-12 m-2">
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('unfixed.permit.create') }}"> {{ __('Create New Permit') }}</a>
                </div>
            </div>
        </div>
        <hr class="w-100 bg-dark">
    @endcan

    <div class="row">
        <div class="col border-left">
            <table class="table table-hover text-center m-auto text-capitalize">
                <thead>
                    <tr class="row">
                        <th class="col-md">{{ __('Workers IDs') }}</th>
                        <th class="col-md-4">{{ __('Workers Names') }}</th>
                        <th class="col-md">{{ __('Company') }}</th>
                        <th class="col-md">{{ __('Pemit End Date') }}</th>
                        <th class="col-md">{{ __('Requested By') }}</th>
                        <th class="col-md">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody id="" class="text-center">
                    @foreach ($unfixed_permits as $permit)
                        <tr class="row">
                            <td class="text-capitalize col-md">
                                @foreach ($permit->workers_ids as $id)
                                    {{ $id }}<br>
                                @endforeach
                            </td>
                            <td class="text-capitalize col-md-4">
                                @foreach ($permit->workers_names as $name)
                                    {{ $name }}<br>
                                @endforeach
                            </td>
                            <td class="text-capitalize col-md">
                                {{ $permit->company->company_name }}
                            </td>
                            <td class="text-capitalize col-md">
                                {{ $permit->end_date }}
                            </td>
                            <td class="text-capitalize col-md">
                                {{ $permit->user->name }}
                            </td>
                            <td class="col-md">
                                <div class="dropdown text-center">
                                    <button class="btn" type="button" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                                        @can('Unfixed Permits Manage')
                                            <li>
                                                <form action="{{ route('unfixed.group.permit.approve', $permit->id) }}"
                                                    method="post">@csrf<button
                                                        class="dropdown-item">{{ __('Approve') }}</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('unfixed.group.permit.reject', $permit->id) }}"
                                                    method="post">@csrf<button
                                                        class="dropdown-item">{{ __('Reject') }}</button>
                                                </form>
                                            </li>
                                        @endcan
                                        @can('Unfixed Permit Show')
                                            <li><a class="dropdown-item"
                                                    href="{{ route('unfixed.permit.show', $permit->id) }}">{{ __('Show') }}</a>
                                            </li>
                                        @endcan
                                        @can('Unfixed Permit Edit')
                                            <li><a class="dropdown-item"
                                                    href="{{ route('unfixed.permit.edit', $permit->id) }}">{{ __('edit') }}</a>
                                            </li>
                                        @endcan

                                        @can('Unfixed Permit Delete')
                                            <li><a class="dropdown-item"
                                                    href="{{ route('unfixed.permit.destroy', $permit->id) }}">{{ __('Delete') }}</a>
                                            </li>
                                        @endcan
                                    </ul>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection --}}
@section('content')
    <ul class="nav nav-pills border-bottom" id="myTab">
        <li class="nav-item">
            <a href="#vehicles" class="nav-link active">Vehicles</a>
        </li>
        <li class="nav-item">
            <a href="#private" class="nav-link">Private</a>
        </li>
        <li class="nav-item">
            <a href="#unfixed" class="nav-link">Unfixed Services Permits</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="vehicles">
            <div class="row">
                <div class="col border-left">
                    <table class="table table-hover text-center m-auto text-capitalize">
                        <thead>
                            <tr class="row">
                                <th class="col-md">{{ __('permit type') }}</th>
                                <th class="col-md">{{ __('start date') }}</th>
                                <th class="col-md">{{ __('end date') }}</th>
                                <th class="col-md">{{ __('State') }}</th>
                                @can('Manage Own Permits')
                                    <th class="col-md">{{ __('Actions') }}</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody id="">
                            @foreach ($vehiclepermits as $permit)
                                <tr class="row">
                                    <td class="text-capitalize col-md">{{ $permit->type }}</td>
                                    <td class="text-capitalize col-md">
                                        <label class="badge bg-success text-capitalize">{{ $permit->date_from }}</label>
                                    </td>
                                    <td class="text-capitalize col-md">
                                        <label class="badge bg-danger text-capitalize">{{ $permit->date_to }}</label>
                                    </td>
                                    <td class="text-capitalize col-md">
                                        <label class="badge bg-info text-capitalize">{{ $permit->state }}</label>
                                    </td>
                                    <td class="col-md">
                                        <div class="dropdown text-center">
                                            <button class="btn" type="button" id="dropdownMenuButton1"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                                                <li>
                                                    <form action="{{ route('group.vehicle.approve', $permit->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="dropdown-item">Approve</button>
                                                    </form>
                                                <li>
                                                    <form action="{{ route('group.vehicle.reject', $permit->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="dropdown-item">Reject</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="private">
            <div class="row">
                <div class="col border-left">
                    <table class="table table-hover text-center m-auto text-capitalize">
                        <thead>
                            <tr class="row">
                                <th class="col-md">{{ __('permit type') }}</th>
                                <th class="col-md">{{ __('start date') }}</th>
                                <th class="col-md">{{ __('end date') }}</th>
                                <th class="col-md">{{ __('State') }}</th>
                                @can('Manage Own Permits')
                                    <th class="col-md">{{ __('Actions') }}</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody id="">
                            @foreach ($privatepermits as $permit)
                                <tr class="row">
                                    <td class="text-capitalize col-md">{{ $permit->type }}</td>
                                    <td class="text-capitalize col-md">
                                        <label class="badge bg-success text-capitalize">{{ $permit->date_from }}</label>
                                    </td>
                                    <td class="text-capitalize col-md">
                                        <label class="badge bg-danger text-capitalize">{{ $permit->date_to }}</label>
                                    </td>
                                    <td class="text-capitalize col-md">
                                        <label class="badge bg-info text-capitalize">{{ $permit->state }}</label>
                                    </td>
                                    @can('Manage Own Permits')
                                        <td class="col-md">
                                            <div class="dropdown text-center">
                                                <button class="btn" type="button" id="dropdownMenuButton1"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                                                    @if ($permit->state == 'pending')
                                                        <li>
                                                            <form action="{{ route('group.private.approve', $permit->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item">Approve</button>
                                                            </form>
                                                        <li>
                                                            <form action="{{ route('group.private.reject', $permit->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item">Reject</button>
                                                            </form>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <span class="dropdown-item">{{ $permit->state }}</span>
                                                        </li>
                                                    @endif

                                                </ul>
                                            </div>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="unfixed">
            <div class="row">
                <div class="col border-left">
                    <table class="table table-hover text-center m-auto text-capitalize">
                        <thead>
                            <tr class="row">
                                <th class="col-md">{{ __('NO#') }}</th>
                                <th class="col-md">{{ __('start date') }}</th>
                                <th class="col-md">{{ __('end date') }}</th>
                                <th class="col-md">{{ __('Shifts') }}</th>
                                <th class="col-md">{{ __('Count') }}</th>
                                <th class="col-md">{{ __('State') }}</th>
                                @can('Manage Own Permits')
                                    <th class="col-md">{{ __('Actions') }}</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody id="">
                            @foreach ($unfixedpermits as $permit)
                                <tr class="row">
                                    <td class="text-capitalize col-md">{{ $permit->id }}</td>
                                    <td class="text-capitalize col-md">
                                        <label class="badge bg-success text-capitalize">{{ $permit->start_date }}</label>
                                    </td>
                                    <td class="text-capitalize col-md">
                                        <label class="badge bg-danger text-capitalize">{{ $permit->end_date }}</label>
                                    </td>
                                    <td class="text-capitalize col-md">
                                        @foreach ($permit->shifts as $shift)
                                            <label class="badge bg-info text-capitalize m-1">{{ $shift }}</label>
                                        @endforeach
                                    </td>
                                    <td class="text-capitalize col-md">
                                        <label
                                            class="badge bg-info text-capitalize m-1">{{ count($permit->workers_ids) }}
                                            Workers</label>
                                    </td>
                                    <td class="text-capitalize col-md">
                                        <label class="badge bg-info text-capitalize">{{ $permit->state }}</label>
                                    </td>
                                    <td class="col-md">
                                        <div class="dropdown text-center">
                                            <button class="btn" type="button" id="dropdownMenuButton1"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                                                <li>
                                                    <form
                                                        action="{{ route('group.unfixed.approve', $permit->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="dropdown-item">Approve</button>
                                                    </form>
                                                <li>
                                                    <form
                                                        action="{{ route('group.unfixed.reject', $permit->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="dropdown-item">Reject</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#myTab a").click(function(e) {
                e.preventDefault();
                $(this).tab("show");
            });
        });
    </script>
@endsection
