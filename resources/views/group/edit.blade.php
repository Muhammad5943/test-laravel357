@extends('layouts.app-master')

@section('content')
    <h1 class="mb-3 text-md-center text-sm-center text-lg-center">Edit Group</h1>

    <div class="bg-light p-4 rounded">
        <h2>Members</h2>
        <div class="lead">
            Edit Group
        </div>

        <form autocomplete="off" action="{{ route('group.update', $getGroupById->id) }}" method="post">
            @method('put')
            @csrf
            <div class="form-group mb-3">
                <label for="inputPassword4">Nama Group</label>
                <input type="text" name="namagroup" value="{{ $getGroupById->namagroup }}" class="form-control" id="inputPassword4" placeholder="Nama Group">
            </div>
            <div class="form-group  mb-3">
                <label for="inputAddress">Kota</label>
                <input type="text" name="kota" value="{{ $getGroupById->kota }}" class="form-control" id="inputAddress" placeholder="kota">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
