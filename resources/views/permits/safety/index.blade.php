@extends('layouts.app')
@section('title')
    {{ __('Safety || Pending Permits') }}
@endsection
@section('header')
    @include('layouts.header')
@endsection
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('content')
    <ul class="nav nav-pills border-bottom" id="myTab">
        @can('Manage Safety Permits - Vehicles')
            <li class="nav-item">
                <a href="#vehicles" class="nav-link active">Vehicles</a>
            </li>
        @endcan
        @can('Manage Safety Permits - Private')
            <li class="nav-item">
                <a href="#private" class="nav-link">Private</a>
            </li>
        @endcan
        @can('Manage Safety Permits - Unfixed')
            <li class="nav-item">
                <a href="#unfixed" class="nav-link">Unfixed Services Permits</a>
            </li>
        @endcan
    </ul>
    <div class="tab-content">
        @can('Manage Safety Permits - Vehicles')
            {{-- Start Vehicle Table --}}
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
                                                    @if ($permit->state == 'Pending Safety Approve')
                                                        <li>
                                                            <form action="{{ route('safety.vehicle.approve', $permit->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item">Approve</button>
                                                            </form>
                                                        <li>
                                                            <form action="{{ route('safety.vehicle.reject', $permit->id) }}"
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- End Vehicle Table --}}
        @endcan
        @can('Manage Safety Permits - Private')
            {{-- Start Private Table --}}
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
                                                        @if ($permit->state == 'Pending Safety Approve')
                                                            <li>
                                                                <form action="{{ route('safety.private.approve', $permit->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <button class="dropdown-item">Approve</button>
                                                                </form>
                                                            <li>
                                                                <form action="{{ route('safety.private.reject', $permit->id) }}"
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
            {{-- End Private Table --}}
        @endcan

        @can('Manage Safety Permits - Unfixed')
            {{-- Start Unfixed Table --}}
            <div class="tab-pane fade" id="unfixed">
                <div class="row">
                    <div class="col border-left">
                        <table class="table table-hover text-center m-auto text-capitalize">
                            <thead>
                                <tr class="row">
                                    <th class="col-md">{{ __('permit id') }}</th>
                                    <th class="col-md">{{ __('start date') }}</th>
                                    <th class="col-md">{{ __('end date') }}</th>
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
                                                        @if ($permit->state = 'pending safety approve')
                                                            <li>
                                                                <form action="{{ route('safety.unfixed.approve', $permit->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <button class="dropdown-item">Approve</button>
                                                                </form>
                                                            <li>
                                                                <form action="{{ route('safety.unfixed.reject', $permit->id) }}"
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
            {{-- End Unfixed Table --}}
        @endcan
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
