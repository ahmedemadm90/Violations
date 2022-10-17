@extends('layouts.app')
@section('title')
{{__('Manage Admin Groups')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title')
{{__('All Permits Admin Groups')}}
@endsection
@section('page-title-desc')
{{__('Manage Permits Admin Groups')}}
@endsection
@section('content')
<hr>
@can('Groups Create')
<div class="row">
    <div class="col-lg-12 m-2">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('group.create') }}"> {{__('Create New Group')}}</a>
        </div>
    </div>
</div>
@endcan
@include('layouts.sessions')
<table class="table table-hover  text-capitalize text-center">
    <tr>
        <th>{{__('No')}}</th>
        <th>{{__('Group Name')}}</th>
        <th>{{__('Action')}}</th>
    </tr>
    @foreach ($groups as $group)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $group->group_name }}</td>

        <td>
            <div class="dropdown text-center">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                    @can('Groups Show')
                    <li><a class="dropdown-item" href="{{ route('group.show',$group->id) }}">Show</a></li>
                    @endcan
                    @can('Groups Edit')
                    <li><a class="dropdown-item" href="{{ route('group.edit',$group->id) }}">Edit</a></li>
                    @endcan
                    @can('Groups Destroy')
                    <li><a class="dropdown-item" href="{{ route('group.destroy',$group->id) }}">Remove</a></li>
                    @endcan
                </ul>
            </div>
        </td>
    </tr>
    @endforeach
</table>
<div class="d-flex justify-content-center m-2">
    {{ $groups->links() }}
</div>
@endsection
