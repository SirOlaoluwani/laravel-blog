
@if ($flash = session('errors'))
    <div class="form-group has-error">
        <label for="submit" class="col-md-12 control-label" style="text-align: center;">{{$flash}}</label>
    </div>
@endif


                        
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::text('name', null, ['class' => 'form-control', 'autofocus', 'required']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    </div>
</div>

<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
    {!! Form::label('location', 'Location', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::text('location', null, ['class' => 'form-control', 'autofocus', 'required']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('location') }}</strong>
        </span>
    </div>
</div>

<div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
    {!! Form::label('year', 'Year', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::text('year', null, ['class' => 'form-control', 'autofocus', 'required']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('year') }}</strong>
        </span>
    </div>
</div>

<div class="form-group{{ $errors->has('featured_image') ? ' has-error' : '' }}">
    {!! Form::label('featured_image', 'Featured Image', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::file('featured_image', null, ['class' => 'form-control', 'required']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('featured_image') }}</strong>
        </span>
    </div>
</div>
