@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            Client Past Exhibition Management
                            <a href="{{ url("admin/client/exhibition/create/{$client}") }}" class="btn btn-default pull-right">Create New</a>
                        </h2>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Year</th>
                                    <th>Published</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($exhibitions as $exhbition)
                                    <tr>
                                        <td>{{ $exhbition->name }}</td>
                                        <td>{{ $exhbition->location }}</td>
                                        <td>{{ $exhbition->year }}</td>
                                        <td>{{ $exhbition->is_published == 0 ? "Draft": "Published" }}</td>
                                        <td>
                                            @if (Auth::user()->is_admin)
                                                @php
                                                    if($exhbition->is_published == 1) {
                                                        $label = 'Draft';
                                                    } else {
                                                        $label = 'Publish';
                                                    }
                                                @endphp
                                                <a href="{{ url("/admin/client/exhibition/publish/{$exhbition->id}") }}" data-method="PUT" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-warning">{{ $label }}</a>
                                            @endif
                                            <a href="{{ url("/admin/client/exhibition/edit/{$client}/{$exhbition->id}") }}" class="btn btn-xs btn-info">Edit</a>
                                            <a href="{{ url("/admin/client/exhibition/delete/{$exhbition->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No exhibitions available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {!! $exhibitions->links() !!}

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
