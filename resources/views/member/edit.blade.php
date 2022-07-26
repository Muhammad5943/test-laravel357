@extends('layouts.app-master')

@section('content')
    <h1 class="mb-3 text-md-center text-sm-center text-lg-center">Edit Member</h1>

    <div class="bg-light p-4 rounded">
        <h2>Members</h2>
        <div class="lead">
            Update Member
        </div>

        <form autocomplete="off" action="{{ route('member.update', $member->id) }}" enctype="multipart/form-data" method="post">
            @method('put')
            @csrf
            <div class="form-group mb-3">
                <label for="inputPassword4">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ $member->nama }}" id="inputPassword4" placeholder="Nama">
            </div>
            <div class="form-group  mb-3">
                <label for="inputAddress">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $member->email }}" id="inputAddress" placeholder="member@gmail.com">
            </div>
            <div class="form-group  mb-3">
                <label for="inputAddress2">Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ $member->alamat }}" id="inputAddress2" placeholder="Bantul, Yogyakarta">
            </div>
            <div class="form-group  mb-3 col-md-6">
                <label for="inputCity">HP</label>
                <input type="text" name="hp" class="form-control" value="{{ $member->hp }}" placeholder="0812*******" id="inputCity">
            </div>
            <div class="form-group  mb-3 col-md-6">
                <label for="inputCity">Foto</label>
                <input type="file" name="profile_pic">
            </div>
            <div>
                <img class="img img-responsive" src="{{url('storage/images/photo')}}/{{$member->profile_pic}}" width="200" height="200"  alt="{{$member->nama}}">
            </div>
            
            <div class="form-group  mb-3 col-md-6">
                <input type="hidden" name="group_id" value="{{ $group_id->id }}" class="form-control" id="inputEmail4" placeholder="Email">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
