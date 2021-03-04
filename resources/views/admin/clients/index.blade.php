@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            Client Management
                            <a href="{{ url('admin/clients/create') }}" class="btn btn-default pull-right">Create New</a>
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
                                @forelse ($clients as $client)
                                    <tr>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ str_limit($client->description, 60) }}</td>
                                        <td>{{ $client->published }}</td>
                                        <td>
                                            @if (Auth::user()->is_admin)
                                                @php
                                                    if($client->is_published == 1) {
                                                        $label = 'Draft';
                                                    } else {
                                                        $label = 'Publish';
                                                    }
                                                @endphp
                                                <a href="{{ url("/admin/clients/{$client->id}/publish") }}" data-method="PUT" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-warning">{{ $label }}</a>
                                            @endif
                                            <!--<a href="{{ url("/admin/client/works/{$client->id}") }}" class="btn btn-xs btn-success">Add works</a>-->
                                            <a href="{{ url("/admin/client/link?client={$client->id}") }}" class="btn btn-xs btn-info">Generate Client Link</a>
                                            <a href="{{ url("/admin/clients/{$client->id}/edit") }}" class="btn btn-xs btn-info">Edit</a>
                                            <a href="{{ url("/admin/clients/{$client->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No clients available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {!! $clients->links() !!}

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
