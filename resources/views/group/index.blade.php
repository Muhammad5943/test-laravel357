@extends('layouts.app-master')

@section('content')
    <h1 class="mb-3 text-md-center text-sm-center text-lg-center">All Group Here</h1>

    <div class="bg-light p-4 rounded">
        <div class="row d-flex">
            <div class="col-md-3 text-center">
                <div class="card bg-light mt-3">
                    <div class="card-body">
                        <form action="{{ route('import.group') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file_group" class="form-control">
                            
                            <div class="pt-3">
                                <button class="btn btn-success">Import Group</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 text-center">
                <div class="card bg-light mt-3">
                    <div class="card-body">
                        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file_member" class="form-control">
                            
                            <div class="pt-3">
                                <button class="btn btn-success">Import Member</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="lead">
            Manage your posts here.
            <a href="{{ route('group.create') }}" class="btn btn-primary btn-sm float-right">Add Group</a>
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
                <th>Name</th>
                <th>Kota</th>
                <th width="3%" colspan="3">Action</th>
            </tr>

            @isset($groups)
                @foreach ($groups as $key => $group)
                    <tr>
                        <td>{{ $groups->firstItem() + $key }}</td>
                        <td>{{ $group->namagroup }}</td>
                        <td>{{ $group->kota }}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('group.member', $group->id) }}">Member</a>
                        </td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="{{ route('group.show', $group->id) }}">Edit</a>
                        </td>
                        
                        @if (count($group->members) == 0)
                            <td>
                                <a class="btn btn-danger btn-sm" href="{{ route('group.destroy', $group->id) }}">Delete</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            @endisset
        </table>

        @isset($groups)
            <div class="d-flex">
                {!! $groups->links() !!}
            </div>
        @endisset

    </div>
@endsection
