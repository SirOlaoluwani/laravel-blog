
@if ($flash = session('errors'))
    <div class="form-group has-error">
        <label for="submit" class="col-md-12 control-label" style="text-align: left;">{{$flash}}</label>
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


<div class="form-group{{ $errors->has('client_image') ? ' has-error' : '' }}">
    {!! Form::label('client_image', 'Client Image', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::file('client_image', null, ['class' => 'form-control', 'required']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('client_image') }}</strong>
        </span>
    </div>
</div>

<div class="form-group" id="repeater">
    <div class="col-md-8 col-md-offset-2">
        <div class="repeater-heading">
            <div style="display:flex;">
                <h4 style="margin-right: 10px"><strong>Client Works.</strong></h4>
                <button id="add-btn" type="button" class="btn btn-primary btn-sm repeater-add-btn">
                    Add
                </button>
            </div>
        </div>

        
        <div class="items" data-group="client_works">
            <div class="col-md-8 col-md-offset-2">
                <div class="item-content">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                {!! Form::label('title', 'Title', ['class' => 'col-md-12 control-label', "style" => "text-align: left;"]) !!}
                            
                                <div class="col-md-12">
                                    {!! Form::text('title', null, ['class' => 'form-control', 'required', 'autofocus', "data-name"=>"title"]) !!}
                            
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group{{ $errors->has('medium') ? ' has-error' : '' }}">
                                {!! Form::label('medium', 'Medium', ['class' => 'col-md-12 control-label', "style" => "text-align: left;"]) !!}
                            
                                <div class="col-md-12">
                                    {!! Form::text('medium', null, ['class' => 'form-control', 'required', 'autofocus', "data-name"=>"medium"]) !!}
                            
                                    <span class="help-block">
                                        <strong>{{ $errors->first('medium') }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group{{ $errors->has('year_completed') ? ' has-error' : '' }}">
                                {!! Form::label('year_completed', 'Year of Completion', ['class' => 'col-md-12 control-label', "style" => "text-align: left;"]) !!}
                            
                                <div class="col-md-12">
                                    {!! Form::text('year_completed', null, ['class' => 'form-control', 'required', 'autofocus', "data-name"=>"year_completed"]) !!}
                            
                                    <span class="help-block">
                                        <strong>{{ $errors->first('year_completed') }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group{{ $errors->has('$request') ? ' has-error' : '' }}">
                                {!! Form::label('category', 'Category', ['class' => 'col-md-12 control-label', "style" => "text-align: left;"]) !!}
                            
                                <div class="col-md-12">
                                    <select name="category" class="form-control" required data-name="category">
                                        <option value="Originals">Originals</option>
                                        <option value="Portrait Commissions">Portrait Commissions</option>
                                    </select>
                            
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group{{ $errors->has('year_completed') ? ' has-error' : '' }}">
                                {!! Form::label('status', 'Status', ['class' => 'col-md-12 control-label', "style" => "text-align: left;"]) !!}
                            
                                <div class="col-md-12">
                                    <select name="status" class="form-control" required data-name="category">
                                        <option value="Sold">Sold</option>
                                        <option value="Available">Available</option>
                                    </select>
                            
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ $errors->has('client_image') ? ' has-error' : '' }}">
                                {!! Form::label('client_image', 'Client Work (Image)', ['class' => 'col-md-12 control-label',"style" => "text-align: left;"]) !!}
                            
                                <div class="col-md-12">
                                    <input name="client_image" type="file" value=""  data-name="client_image" required />
                                    <!--{!! Form::file('client_image', null, ['class' => 'form-control', 'required', "data-name"=>"client_image"]) !!}-->
                            
                                    <span class="help-block">
                                        <strong>{{ $errors->first('client_image') }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="pull-right repeater-remove-btn">
                                <label for="submit" class="col-md-2 control-label" style="text-align: left;">&nbsp;</label>
                                <button id="remove-btn" class="btn btn-danger" onclick="$(this).parents('.items').remove()">
                                    X
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
