@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            Edit Client

                            <a href="{{ url('admin/clients') }}" class="btn btn-default pull-right">Go Back</a>
                        </h2>
                    </div>

                    <div class="panel-body">
                        {!! Form::model($client, ['method' => 'PUT', 'url' => "/admin/clients/{$client->id}", 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                            @include('admin.clients._form')
                            
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <a href="{{$client->client_image_url}}" target="_blank" rel="noreferrer" >
                                        <strong>VIEW CLIENT IMAGE.</strong>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <strong>VIEW CLIENT WORKS.</strong><br>
                                    @forelse ($client->gallery as $clientG)
                                    <div style="display: flex;margin-bottom: 5px;margin-top:5px;">
                                        <a href="{{$clientG->image_url}}" target="_blank" rel="noreferrer" >
                                            View Image <a href="/admin/client/delete-gallery?gallery={{$clientG->id}}" style="color: red; margin-left: 10px;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a>
                                        </a><br>
                                    </div>
                                    @empty
                                    <p>
                                    </p>
                                @endforelse
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
