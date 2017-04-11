<!-- resources/views/tuition_waiver/partials/_tuition_waiver_addedit.blade.php -->

<div class="form-group{{ $errors->has('student_id') ? ' has-error' : '' }}">
    {!! Form::label('student_id', 'Student:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::select('student_id', $students, null, ['placeholder' => 'Choose a Student', 'class' => 'form-control', 'disabled' => $disabled]) !!}

        @if ($errors->has('student_id'))
            <span class="help-block">
                <strong>{{ $errors->first('student_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('semester_name_id')  || $errors->has('semester_year') ? ' has-error' : '' }}">
    {!! Form::label('semester_id', 'Semester:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        <div class='row'>
            <div class='col-sm-6'>
                {!! Form::select('semester_name_id', $semester_names, $waiver == null ? null : $waiver->semester->name_id, ['placeholder' => "", 'class' => 'form-control', 'disabled' => $disabled]) !!}

                @if ($errors->has('semester_name_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('semester_name_id') }}</strong>
                    </span>
                @endif
            </div>
            <div class='col-sm-6'>
                {!! Form::number('semester_year', $waiver == null ? null : $waiver->semester->calendar_year, ['class' => 'form-control', 'placeholder' => 'Year', 'disabled' => $disabled]) !!}

                @if ($errors->has('semester_year'))
                    <span class="help-block">
                        <strong>{{ $errors->first('semester_year') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="form-group{{ $errors->has('date_received') ? ' has-error' : '' }}">
    {!! Form::label('date_received', 'Date Received:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::text('date_received', null, ['id' => 'datepicker', 'class' => 'form-control']) !!}

        @if ($errors->has('date_received'))
            <span class="help-block">
                <strong>{{ $errors->first('date_received') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('amount_received') ? ' has-error' : '' }}">
    {!! Form::label('amount_received', 'Amount Received:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::text('amount_received', null, ['class' => 'form-control']) !!}

        @if ($errors->has('amount_received'))
            <span class="help-block">
                <strong>{{ $errors->first('amount_received') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('credit_hours') ? ' has-error' : '' }}">
    {!! Form::label('credit_hours', 'Credit Hours:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::number('credit_hours', null, ['class' => 'form-control']) !!}

        @if ($errors->has('credit_hours'))
            <span class="help-block">
                <strong>{{ $errors->first('credit_hours') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('funding_source_id') ? ' has-error' : '' }}">
    {!! Form::label('funding_source_id', 'Funding Source:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::select('funding_source_id', $sources, null, ['placeholder' => 'Choose a Funding Source', 'class' => 'form-control']) !!}

        @if ($errors->has('funding_source_id'))
            <span class="help-block">
                <strong>{{ $errors->first('funding_source_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('received') ? ' has-error' : '' }}">
    {!! Form::label('received', 'Has Been Received:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::checkbox('received', "true", $waiver != null ? $waiver->received : false) !!}

        @if ($errors->has('received'))
            <span class="help-block">
                <strong>{{ $errors->first('received') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <div class="btn-group">
            {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
            <a href="{{ url('/waiver') }}" class="btn btn-danger">Cancel</a>
        </div>
    </div>
</div>
