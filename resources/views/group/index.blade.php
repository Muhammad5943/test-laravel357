@extends('layouts.app-master')

@section('content')
    <h1 class="mb-3 text-md-center text-sm-center text-lg-center">All Group Here</h1>

    <div class="bg-light p-4 rounded">
        <h2>Posts</h2>
        <div class="lead">
            Manage your posts here.
            <a href="#" class="btn btn-primary btn-sm float-right">Add post</a>
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

            @foreach ($groups as $key => $group)
                <tr>
                    <td>{{ $group->id }}</td>
                    <td>{{ $group->namagroup }}</td>
                    <td>{{ $group->kota }}</td>
                    <td>
                        {{-- <a class="btn btn-info btn-sm" href="#">Member</a> --}}
                        <a class="btn btn-info btn-sm" href="{{ route('member.group', $group->id) }}">Member</a>
                    </td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="#">Edit</a>
                        {{-- <a class="btn btn-info btn-sm" href="{{ route('posts.show', $post->id) }}">Show</a> --}}
                    </td>
                    
                    @if (count($group->members) == 0)
                        <td>
                            <a class="btn btn-danger btn-sm" href="#">Delete</a>
                            {{-- <a class="btn btn-primary btn-sm" href="{{ route('posts.edit', $post->id) }}">Delete</a> --}}
                        </td>
                    @endif
                </tr>
            @endforeach
        </table>

        {{-- <div class="d-flex">
            {!! $posts->links() !!}
        </div> --}}

    </div>
@endsection
