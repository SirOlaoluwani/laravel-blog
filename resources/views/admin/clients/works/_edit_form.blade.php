
@if ($flash = session('errors'))
    <div class="form-group has-error">
        <label for="submit" class="col-md-2 control-label" style="text-align: center;">{{$flash}}</label>
    </div>
@endif

<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    {!! Form::label('title', 'Title', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::text('title', null, ['class' => 'form-control', 'required', 'autofocus', "data-name"=>"title"]) !!}

        <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    </div>
</div>

<div class="form-group{{ $errors->has('medium') ? ' has-error' : '' }}">
    {!! Form::label('medium', 'Medium', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::text('medium', null, ['class' => 'form-control', 'required', 'autofocus', "data-name"=>"medium"]) !!}

        <span class="help-block">
            <strong>{{ $errors->first('medium') }}</strong>
        </span>
    </div>
</div>

<div class="form-group{{ $errors->has('year_completed') ? ' has-error' : '' }}">
    {!! Form::label('year_completed', 'Year of Completion', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::text('year_completed', null, ['class' => 'form-control', 'required', 'autofocus', "data-name"=>"year_completed"]) !!}

        <span class="help-block">
            <strong>{{ $errors->first('year_completed') }}</strong>
        </span>
    </div>
</div>

<div class="form-group{{ $errors->has('$request') ? ' has-error' : '' }}">
    {!! Form::label('category', 'Category', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        <select name="category" class="form-control" required data-name="category">
            <option value="Originals">Originals</option>
            <option value="Portrait Commissions">Portrait Commissions</option>
        </select>

        <span class="help-block">
            <strong>{{ $errors->first('category') }}</strong>
        </span>
    </div>
</div>

<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
    {!! Form::label('status', 'Status', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        <select name="status" class="form-control" required data-name="status">
            <option value="Sold">Sold</option>
            <option value="Available">Available</option>
        </select>

        <span class="help-block">
            <strong>{{ $errors->first('status') }}</strong>
        </span>
    </div>
</div>

<div class="form-group{{ $errors->has('visibility') ? ' has-error' : '' }}">
    {!! Form::label('visibility', 'Visibility', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        <select name="visibility" class="form-control" required data-name="visibility">
            <option value="public">Public</option>
            <option value="private">Private</option>
        </select>

        <span class="help-block">
            <strong>{{ $errors->first('visibility') }}</strong>
        </span>
    </div>
</div>

<div class="form-group{{ $errors->has('client_image') ? ' has-error' : '' }}">
    {!! Form::label('client_image', 'Client Work (Image)', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        <input name="client_image" type="file" value=""  data-name="client_image" />
        <!--{!! Form::file('client_image', null, ['class' => 'form-control', "data-name"=>"client_image"]) !!}-->

        <span class="help-block">
            <strong>{{ $errors->first('client_image') }}</strong>
        </span>
    </div>
</div>

