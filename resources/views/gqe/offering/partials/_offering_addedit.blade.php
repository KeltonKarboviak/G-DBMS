<!-- resources/views/gqe/offering/partials/_offering_addedit.blade.php -->

<div class="form-group{{ $errors->has('gqe_section_id') ? ' has-error' : '' }}">
    {!! Form::label('gqe_section_id', 'GQE Section:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::select('gqe_section_id', $sections, null, ['placeholder' => 'Choose a GQE Section', 'class' => 'form-control']) !!}

        @if ($errors->has('gqe_section_id'))
            <span class="help-block">
                <strong>{{ $errors->first('gqe_section_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('semester_name_id')  || $errors->has('semester_year') ? ' has-error' : '' }}">
    {!! Form::label('semester_id', 'Semester:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        <div class='row'>
            <div class='col-sm-6'>
                {!! Form::select('semester_name_id', $semester_names, $offering == null ? null : $offering->semester->name_id, ['placeholder' => "", 'class' => 'form-control']) !!}

                @if ($errors->has('semester_name_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('semester_name_id') }}</strong>
                    </span>
                @endif
            </div>
            <div class='col-sm-6'>
                {!! Form::number('semester_year', $offering == null ? null : $offering->semester->calendar_year, ['class' => 'form-control', 'placeholder' => 'Year']) !!}

                @if ($errors->has('semester_year'))
                    <span class="help-block">
                        <strong>{{ $errors->first('semester_year') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
    {!! Form::label('date', 'Date:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        <div class="input-group">
            {!! Form::text('date', null, ['id' => 'datepicker', 'class' => 'form-control']) !!}
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-toggle="tooltip" title="Select a date">
                    <span class="glyphicon glyphicon-calendar"></span>
                </button>
            </span>
        </div>

        @if ($errors->has('date'))
            <span class="help-block">
                <strong>{{ $errors->first('date') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('cutoff_ms') ? ' has-error' : '' }}">
    {!! Form::label('cutoff_ms', 'MS Cutoff Score:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::text('cutoff_ms', null, ['class' => 'form-control']) !!}

        @if ($errors->has('cutoff_ms'))
            <span class="help-block">
                <strong>{{ $errors->first('cutoff_ms') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('cutoff_phd') ? ' has-error' : '' }}">
    {!! Form::label('cutoff_phd', 'PhD Cutoff Score:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::text('cutoff_phd', null, ['class' => 'form-control']) !!}

        @if ($errors->has('cutoff_phd'))
            <span class="help-block">
                <strong>{{ $errors->first('cutoff_phd') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <div class="btn-group">
            {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
            <a href="{{ url('/gqe/offering') }}" class="btn btn-danger">Cancel</a>
        </div>
    </div>
</div>
