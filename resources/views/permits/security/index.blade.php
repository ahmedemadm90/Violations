@extends('layouts.app')
@section('title')
    {{ __('Security || Pending Permits') }}
@endsection
@section('header')
    @include('layouts.header')
@endsection
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('content')
    <ul class="nav nav-pills border-bottom" id="myTab">
        @can('Manage Security Permits - Vehicles')
        <li class="nav-item">
            <a href="#vehicles" class="nav-link active">Vehicles</a>
        </li>
        @endcan
        @can('Manage Security Permits - Private')
        <li class="nav-item">
            <a href="#private" class="nav-link">Private</a>
        </li>
        @endcan
        @can('Manage Security Permits - Unfixed')
        <li class="nav-item">
            <a href="#unfixed" class="nav-link">Unfixed Services Permits</a>
        </li>
        @endcan
    </ul>
    <div class="tab-content">
@can('Manage Security Permits - Vehicles')
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
                                                @if ($permit->state == 'Pending Security Approve')
                                                    <li>
                                                        <form
                                                            action="{{ route('security.permits.approve', $permit->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <button class="dropdown-item">Approve</button>
                                                        </form>
                                                    <li>
                                                        <form
                                                            action="{{ route('security.permits.reject', $permit->id) }}"
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

@endcan
@can('Manage Security Permits - Private')
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
                                        <label
                                            class="badge bg-success text-capitalize">{{ $permit->date_from }}</label>
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
                                                <ul class="dropdown-menu text-capitalize"
                                                    aria-labelledby="dropdownMenuButton1">
                                                    @if ($permit->state == 'pending')
                                                        <li>
                                                            <form action="{{ route('permits.approve', $permit->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item">Approve</button>
                                                            </form>
                                                        <li>
                                                            <form action="{{ route('permits.reject', $permit->id) }}"
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
@endcan
@can('Manage Security Permits - Unfixed')
        <div class="tab-pane fade" id="unfixed">
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
                            @foreach ($unfixedpermits as $permit)
                                <tr class="row">
                                    <td class="text-capitalize col-md">{{ $permit->id }}</td>
                                    <td class="text-capitalize col-md">
                                        <label
                                            class="badge bg-success text-capitalize">{{ $permit->start_date }}</label>
                                    </td>
                                    <td class="text-capitalize col-md">
                                        <label
                                            class="badge bg-danger text-capitalize">{{ $permit->end_date }}</label>
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
                                            <ul class="dropdown-menu text-capitalize"
                                                aria-labelledby="dropdownMenuButton1">
                                                <li>
                                                    <form
                                                        action="{{ route('unfixed.security.permit.approve', $permit->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="dropdown-item">Approve</button>
                                                    </form>
                                                <li>
                                                    <form
                                                        action="{{ route('unfixed.security.permit.reject', $permit->id) }}"
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
@endcan
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
