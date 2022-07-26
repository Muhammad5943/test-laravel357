@extends('layouts.app-master')

@section('content')
    <h1 class="mb-3 text-md-center text-sm-center text-lg-center">All Member on Group Here</h1>

    <div class="bg-light p-4 rounded">
        <div class="col-md-3">
            <h2>
                <a href="{{ route('group') }}">
                    <i class="fa fa-home" style="font-size:48px;"></i>
                </a> Members
            </h2>
        </div>
        <div class="lead">
            Manage your member here
            <a href="{{ route('member.create', $group_id) }}" class="btn btn-primary btn-sm float-right">Add member</a>
        </div>
        
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table  
                style="background-color: #c8cfc8" 
                class="
                    table table-condensed 
                    table-responsive-md 
                    table-responsive-lg 
                    table-responsive-sm
                    text-center
                "
        >
            <tr>
                <th width="1%">No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>HP</th>
                <th>Foto</th>
                <th width="3%" colspan="3">Action</th>
            </tr>

            @isset($members)
                @foreach ($members as $key => $member)
                    <tr>
                        <td>{{ $members->firstItem() + $key }}</td>
                        <td>{{ $member->nama }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->alamat }}</td>
                        <td>{{ $member->hp }}</td>
                        <td>
                            @if ($member->profile_pic != null)
                                <img class="img-product" width="80" height="80" src="{{ asset('/storage/images/photo/'.$member->profile_pic)}}"
                                    alt="Pic">
                            @else
                                <img class="img-product" width="80" height="80" src="{{ asset('/assets/img/no_pic.jpg') }}"
                                    alt="Pic">
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="{{ route('member.show', $member->id) }}">Edit</a>
                        </td>
                        <td>
                            <a class="btn btn-danger btn-sm" href="{{ route('member.destroy', $member->id) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            @endisset
        </table>

        @isset($members)
            <div class="d-flex">
                {!! $members->links() !!}
            </div>
        @endisset

    </div>
@endsection
