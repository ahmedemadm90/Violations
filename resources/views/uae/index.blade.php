@extends('layouts.app')
@section('title')
{{__('UAE Vilations')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title')
{{__('UAE Violations')}}
@endsection
@section('content')
@can('Uae Violations Create')
<a class="btn btn-success" href="{{route('uae.violations.create')}}">{{__('New Violation')}}</a>
@endcan
@can('Export All Uae Violations')
<a id="print" class="btn btn-info" href="{{route('uae.violations.export')}}">{{__('ُExport All Violations')}}</a>
@endcan
@can('Search By Date Uae Violations')
<hr>
<div class="row">
    <form action="{{route('uae.violations.search')}}" method="post" class="row">
        @csrf
        <div class="col-md">
            <div class="form-floating ">
                <input class="form-control col-md" name="date_from" placeholder="By Date" type="date">
                <label for="floatingInputGrid">{{__('Date From')}}</label>
            </div>
        </div>
        <div class="col-md">
            <div class="form-floating">
                <input class="form-control col-md" name="date_to" placeholder="By Date" type="date">
                <label for="floatingInputGrid">{{__('Date To')}}</label>
            </div>
        </div>
        <div class="col-md">
            <div class="mt-1">
                <button class="btn btn-info">{{__('Search')}}</button>
            </div>
        </div>
    </form>
</div>
@endcan

<hr class="w-100 bg-dark">
@include('layouts.sessions')
<div class="row">
    <table class="table table-hover  text-capitalize text-center" id="vios">
        <thead>
            <tr>
                <th class="col-md-1">{{__('#')}}</th>
                <th class="col-md-1">{{__('Type')}}</th>
                <th class="col-md-1">{{__('Area')}}</th>
                <th class="col-md-1">{{__('Location')}}</th>
                <th class="col-md-1">{{__('Date')}}</th>
                <th class="col-md-1">{{__('time')}}</th>
                <th class="col-md-1">{{__('Images')}}</th>
                <th class="col-md-1">{{__('Tools')}}</th>
            </tr>
        </thead>
        <tbody id="">
            @foreach ($vios as $violation)
            <tr>
                <td class="text-capitalize col-md-1">{{$violation->id}}</td>
                <td class="text-capitalize col-md-1">{{$violation->type}}</td>
                <td class="text-capitalize col-md-1">{{$violation->vp->vp_name}}</td>
                <td class="text-capitalize col-md-1">{{$violation->area->area_name}}</td>
                <td class="text-capitalize col-md-1">{{$violation->date}}</td>
                <td class="text-capitalize col-md-1">{{$violation->time}}</td>
                <td class="text-capitalize col-md-1">
                    <div id="carouselExampleControls" class="carousel slide shadow-none" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach( $violation->gallery as $img )
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}" style="height: 100px">
                                <img class="d-block img-fluid" src='{{asset("public/media/violations/uae/images/$img")}}'
                                    style="width: 100%;height:100%">
                            </div>
                            @endforeach
                        </div>

                    </div>

                </td>
                <td>
                    <div class="dropdown text-center">
                        <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                            <li><a href="{{route('uae.violations.show',$violation->id)}}" class="dropdown-item"
                                    target="_blank">{{__('Show')}}</a>
                            </li>
                            @can('Uae Violation Edit')
                            <li><a href="{{route('uae.violations.edit',$violation->id)}}" class="dropdown-item"
                                    target="_blank">{{__('Edit')}}</a>
                            </li>
                            @endcan
                            @can('Uae Violation Delete')
                            <li><a href="{{route('uae.violations.destroy',$violation->id)}}"
                                    class="dropdown-item">{{__('Delete')}}</a>
                            </li>
                            @endcan

                        </ul>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center m-2">
        {{ $vios->links() }}
    </div>
</div>

@endsection
{{-- @section('scripts')
<script>
    $(document).on('click', '#print', function() {
        $("#vios").print();
    });

</script>
@endsection --}}
