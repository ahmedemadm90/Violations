@extends('layouts.app')
@section('title')
    Edit Group
@endsection
@section('page-title')
    Edit Admin Group || <span class="text-danger">{{ $group->group_name }}</span>
@endsection
@section('header')
    @include('layouts.header')
@endsection
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('content')
    <hr class="w-100 bg-dark">
    @include('layouts.errors')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('groups.index') }}">Back</a>
            </div>
        </div>
        <div class="col border-right">
            <form class="form-floating text-center col-md-8 m-auto" action="{{ route('group.update', $group->id) }}"
                method="POST">
                @csrf
                <div class="form-floating m-3 w-auto">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Group Name" name="group_name"
                        value="{{ $group->group_name }}">
                    <label for="floatingInput">Group Name</label>
                </div>

                <hr>
                <button class="btn btn-success">
                    Update</button>
            </form>
        </div>
    </div>

@endsection
