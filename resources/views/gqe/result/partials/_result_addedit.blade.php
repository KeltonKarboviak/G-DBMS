<!-- resources/views/gqe/result/partials/_result_addedit.blade.php -->

<div class="form-group{{ $errors->has('student_id') ? ' has-error' : '' }}">
    {!! Form::label('student_id', 'Student ID:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::select('student_id', $students, null, ['placeholder' => 'Choose a student', 'class' => 'form-control', 'disabled' => $disabled]) !!}

        @if ($errors->has('student_id'))
            <span class="help-block">
                <strong>{{ $errors->first('student_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('offer_id') ? ' has-error' : '' }}">
    {!! Form::label('offer_id', 'GQE Offering ID:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::select('offer_id', $offerings, null, ['placeholder' => 'Choose a GQE Offering', 'class' => 'form-control', 'disabled' => $disabled]) !!}

        @if ($errors->has('offer_id'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('score') ? ' has-error' : '' }}">
    {!! Form::label('score', 'Score:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::text('score', null, ['class' => 'form-control']) !!}

        @if ($errors->has('score'))
            <span class="help-block">
                <strong>{{ $errors->first('score') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <div class="btn-group">
            {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
            <a href="{{ url('/gqe/result') }}" class="btn btn-danger">Cancel</a>
        </div>
    </div>
</div>
