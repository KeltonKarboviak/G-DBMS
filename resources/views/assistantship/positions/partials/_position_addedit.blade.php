<!-- resources/views/assistantship/positions/partials/_section_addedit.blade.php -->

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('name', 'Position Name:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <div class="btn-group">
            {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
            <a href="{{ url('/assistantship/position') }}" class="btn btn-danger">Cancel</a>
        </div>
    </div>
</div>
