@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            {{ $communityWork->title }} 

                            <a href="{{ url('admin/community-works') }}" class="btn btn-default pull-right">Go Back</a>
                        </h2>
                    </div>

                    <div class="panel-body">
                        <a href="{{$communityWork->featured_image_url}}" target="_blank" rel="noreferrer"><div class="community-work-featured-image" style="background-image: url('{{$communityWork->featured_image_url}}'); background-repeat: no-repeat; background-size: contain; background-position: left;height: 200px;width: 100%;margin-bottom: 20px;"></div></a>
                        <p>{!! $communityWork->body !!}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
