@extends('layouts.app')
@section('title')
    New Group
@endsection
@section('page-title')
    New Admin Group
@endsection
@section('page-title-desc')
    New Admin Geoup To Manage Permits Approvals
@endsection
@section('header')
    @include('layouts.header')
@endsection
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('content')
    <hr class="w-100 bg-dark">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('groups.index') }}">Back</a>
            </div>
        </div>
        <div class="col border-right">
            <form class="form-floating text-center col-md-8 m-auto" action="{{ route('group.store') }}" method="POST">
                @csrf
                <div class="form-floating m-3 w-auto">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Vp Name" name="group_name">
                    <label for="floatingInput">Group Name</label>
                </div>
                <button class="btn btn-success">
                    Add</button>
            </form>
        </div>
    </div>

@endsection
