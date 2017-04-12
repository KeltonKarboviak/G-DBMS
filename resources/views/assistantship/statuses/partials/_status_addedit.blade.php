<!-- resources/views/assistantship/status/_status_addedit.blade.php -->

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    {!! Form::label('description', 'Status:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::text('description', null, ['class' => 'form-control']) !!}

        @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <div class="btn-group">
            {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
            <a href="{{ url('/assistantship/status') }}" class="btn btn-danger">Cancel</a>
        </div>
    </div>
</div>
