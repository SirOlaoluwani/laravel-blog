@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            Community Works

                            <a href="{{ url('admin/community-works/create') }}" class="btn btn-default pull-right">Create New</a>
                        </h2>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th>Published</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($communityWorks as $communityWork)
                                    <tr>
                                        <td>{{ $communityWork->title }}</td>
                                        <td>{{ str_limit($communityWork->body, 60) }}</td>
                                        <td>{{ $communityWork->published }}</td>
                                        <td>
                                            @if (Auth::user()->is_admin)
                                                @php
                                                    if($communityWork->is_published == 1) {
                                                        $label = 'Draft';
                                                    } else {
                                                        $label = 'Publish';
                                                    }
                                                @endphp
                                                <a href="{{ url("/admin/community-works/{$communityWork->id}/publish") }}" data-method="PUT" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-warning">{{ $label }}</a>
                                            @endif
                                            <a href="{{ url("/admin/community-works/{$communityWork->id}") }}" class="btn btn-xs btn-success">Show</a>
                                            <a href="{{ url("/admin/community-works/{$communityWork->id}/edit") }}" class="btn btn-xs btn-info">Edit</a>
                                            <a href="{{ url("/admin/community-works/{$communityWork->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No community works available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {!! $communityWorks->links() !!}

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
