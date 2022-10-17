@extends('layouts.app')
@section('title')
{{__('Manage Workers Types')}}
@endsection
@section('page-title')
{{__('Workers Types')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title-desc')
{{__('Shows Types Can Be Assigned To Workers')}}
@endsection
@section('content')
<hr class="">
@can('Workers Types Create')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right m-2">
            <a class="btn btn-success" href="{{ route('type.create') }}"> Create New Type</a>
        </div>
    </div>
</div>
@endcan
@include('layouts.sessions')
<table class="table table-hover text-center">
    <tr>
        <th>{{__('No')}}</th>
        <th>{{__('Name')}}</th>
        <th>{{__('Action')}}</th>
    </tr>
    @foreach ($types as $type)
    <tr>
        <td>{{ ++$i }}</td>
        <td class="text-capitalize">{{ $type->type_name }}</td>
        <td>
            <div class="dropdown text-center">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                    @can('Workers Types Edit')
                    <li><a class="dropdown-item" href="{{ route('type.edit',$type->id) }}">Edit</a></li>
                    @endcan
                    @can('Workers Types Destroy')
                    <li><a class="dropdown-item" href="{{ route('type.destroy',$type->id) }}">Remove</a></li>
                    @endcan
                </ul>
            </div>
        </td>
    </tr>
    @endforeach
</table>
<div class="d-flex justify-content-center m-2">
    {{ $types->links() }}
</div>
@endsection
