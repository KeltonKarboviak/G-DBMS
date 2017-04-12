<!-- resources/views/funding_source/partials/_funding_source_addedit.blade.php -->

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('name', 'Funding Source Name:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('is_grant') ? ' has-error' : '' }}">
    {!! Form::label('is_grant', 'Is Grant:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::checkbox('is_grant', null) !!}

        @if ($errors->has('is_grant'))
            <span class="help-block">
                <strong>{{ $errors->first('is_grant') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <div class="btn-group">
            {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
            <a href="{{ url('/source') }}" class="btn btn-danger">Cancel</a>
        </div>
    </div>
</div>
