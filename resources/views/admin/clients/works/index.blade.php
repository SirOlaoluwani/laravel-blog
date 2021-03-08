@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                           {{  $client->name }}'s Works
                            <a href="{{ url("admin/client/work/create/{$client->id}") }}" class="btn btn-default pull-right">Create New</a>
                        </h2>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Medium</th>
                                    <th>Year Completed</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Visibility</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($gallery as $work)
                                    <tr>
                                        <td>{{ $work->title }}</td>
                                        <td>{{ $work->medium }}</td>
                                        <td>{{ $work->year_completed }}</td>
                                        <td>{{ $work->category }}</td>
                                        <td>{{ $work->status }}</td>
                                        <td>{{ $work->visibility }}</td>
                                        <td>
                                            {{-- @if (Auth::user()->is_admin)
                                                @php
                                                    if($work->is_published == 1) {
                                                        $label = 'Draft';
                                                    } else {
                                                        $label = 'Publish';
                                                    }
                                                @endphp
                                                <a href="{{ url("/admin/client/exhibition/publish/{$work->id}") }}" data-method="PUT" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-warning">{{ $label }}</a>
                                            @endif --}}
                                            <a href="{{ url("/admin/client/work/edit/{$client->id}/{$work->id}") }}" class="btn btn-xs btn-info">Edit</a>
                                            <a href="{{ url("/admin/client/work/delete/{$work->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No work available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {!! $gallery->links() !!}

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
