@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            Client Event Management
                            <a href="{{ url("admin/client/event/create/{$client}") }}" class="btn btn-default pull-right">Create New</a>
                        </h2>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Published</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($events as $event)
                                    <tr>
                                        <td>{{ $event->name }}</td>
                                        <td>{{ str_limit($event->description, 60) }}</td>
                                        <td>{{ $event->is_published == 0 ? "Draft": "Published" }}</td>
                                        <td>
                                            @if (Auth::user()->is_admin)
                                                @php
                                                    if($event->is_published == 1) {
                                                        $label = 'Draft';
                                                    } else {
                                                        $label = 'Publish';
                                                    }
                                                @endphp
                                                <a href="{{ url("/admin/client/event/publish/{$event->id}") }}" data-method="PUT" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-warning">{{ $label }}</a>
                                            @endif
                                            <a href="{{ url("/admin/client/event/edit/{$client}/{$event->id}") }}" class="btn btn-xs btn-info">Edit</a>
                                            <a href="{{ url("/admin/client/event/delete/{$event->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No events available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {!! $events->links() !!}

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
