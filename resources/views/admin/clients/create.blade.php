@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            Create Client

                            <a href="{{ url('admin/clients') }}" class="btn btn-default pull-right">Go Back</a>
                        </h2>
                    </div>

                    <div class="panel-body">
                        {!! Form::open(['url' => '/admin/clients', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data', 'method' => 'post']) !!}

                            @include('admin.clients._form')

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary">
                                        Create
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

    <script src="{{ asset('js/repeater.js') }}"></script>
    <script>
        $(function(){
          $("#repeater").createRepeater({
              showFirstItemToDefault: true,
          });
        });
    </script>
@endsection