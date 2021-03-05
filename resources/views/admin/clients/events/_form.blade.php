
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

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    {!! Form::label('description', 'Description', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'mytextarea']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    </div>
</div>

<div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
    {!! Form::label('date', 'Event Date', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        <input name="date" type="datetime-local" value="{{ !empty($event) ? date_format(date_create($event->date), 'Y-m-d\TH:i') : "" }}" class="form-control" required />

        <span class="help-block">
            <strong>{{ $errors->first('date') }}</strong>
        </span>
    </div>
</div>

<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
    {!! Form::label('location', 'Event Location', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::text('location', null, ['class' => 'form-control', 'autofocus', 'required']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('location') }}</strong>
        </span>
    </div>
</div>