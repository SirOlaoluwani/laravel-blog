@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            Edit Community Works

                            <a href="{{ url('admin/community-works') }}" class="btn btn-default pull-right">Go Back</a>
                        </h2>
                    </div>

                    <div class="panel-body">
                        {!! Form::model($communityWork, ['method' => 'PUT', 'url' => "/admin/community-works/{$communityWork->id}", 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                            @include('admin.community-works._form')
                            
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <a href="{{$communityWork->featured_image_url}}" target="_blank" rel="noreferrer" >
                                        VIEW IMAGE.
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
