@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            Edit Event

                            <a href="{{ url("admin/client/events/{$client}") }}" class="btn btn-default pull-right">Go Back</a>
                        </h2>
                    </div>

                    <div class="panel-body">
                        @if ($flash = session('errors'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{$flash}}!</strong>
                                <button type="button" class="close" data-dismiss="alert" data-alignment="top" aria-label="Close">
                                    <span aria-hidden="true" class="material-icons md-18">clear</span>
                                </button>
                            </div>
                        @endif
                        
                        {!! Form::model($event, ['method' => 'PUT', 'url' => "/admin/client/event/update/{$client}/{$event->id}", 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                            @include('admin.clients.events._form')

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <a href="{{$event->featured_image_url}}" target="_blank" rel="noreferrer" >
                                        <strong>👉 Click to view uploaded featured image.</strong>
                                    </a>
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

@section("script")
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ"
        crossorigin="anonymous">
    </script>
@endsection
