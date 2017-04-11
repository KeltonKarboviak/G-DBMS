{!! Form::hidden('id',null) !!}

<div class="form-group{{ $errors->has('student_id') ? ' has-error' : '' }}">
	{!! Form::label('', 'Student:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::text('', $sent_student->full_name, ['class' => 'form-control', 'readonly']) !!}
	</div>
</div>

<div class="form-group{{ $errors->has('student_id') ? ' has-error' : '' }}">
	{!! Form::label('student_id', 'Student ID:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::text('student_id',$sent_student->id, ['class' => 'form-control', 'readonly']) !!}
	</div>
</div>


<div class="form-group{{ $errors->has('advisor_id') ? ' has-error' : '' }}">
	{!! Form::label('advisor_id', 'Advisor:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::select('advisor_id', $advisors, null, ['placeholder' => "Choose an advisor", 'class' => 'form-control']) !!}
	</div>
</div>

<div class="form-group{{ $errors->has('program_id') ? ' has-error' : '' }}">
	{!! Form::label('program_id', 'Program:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::select('program_id', $programs, null, ['placeholder' => "Choose a program", 'class' => 'form-control']) !!}
	</div>
</div>

<div class="form-group{{ $errors->has('topic') ? ' has-error' : '' }}">
	{!! Form::label('topic', 'Topic:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::textarea('topic', null, ['class' => 'form-control', 'rows' => 2]) !!}

		@if ($errors->has('topic'))
			<span class="help-block">
				<strong>{{ $errors->first('topic') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('semester_started_year')  || $errors->has('semester_started_name_id') ? ' has-error' : '' }}">
	{!! Form::label('', 'Semester Started:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		<div class='row'>
			<div class='col-sm-6'>
				{!! Form::select('semester_started_name_id', $semester_names, $student_program == null ? null : $student_program->semester_started->name_id, ['placeholder' => "", 'class' => 'form-control']) !!}

				@if ($errors->has('semester_started_name_id'))
					<span class="help-block">
						<strong>{{ $errors->first('semester_started_name_id') }}</strong>
					</span>
				@endif
			</div>
			<div class='col-sm-6'>
				{!! Form::number('semester_started_year', $student_program == null ? null : $student_program->semester_started->calendar_year, ['class' => 'form-control', 'placeholder' => 'Year']) !!}

				@if ($errors->has('semester_started_year'))
					<span class="help-block">
						<strong>{{ $errors->first('semester_started_year') }}</strong>
					</span>
				@endif
			</div>
		</div>
	</div>
	<?php //<a class="btn btn-default" data-toggle="tooltip" title="Add a semester" href={{ '/' . str_replace("/","SLASH", "/" . Request::decodedPath()) . '/semesters/add' }} ><span class="glyphicon glyphicon-plus"></span></a> ?>
</div>

@if($student_program == null || $student_program->needs_committee)
<div class="form-group{{ $errors->has('has_committee') ? ' has-error' : '' }}">
	{!! Form::label('has_committee', 'Has Committee:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::checkbox('has_committee', null) !!}

		@if ($errors->has('has_committee'))
			<span class="help-block">
				<strong>{{ $errors->first('has_committee') }}</strong>
			</span>
		@endif
	</div>
</div>
@endif

<div class="form-group{{ $errors->has('has_program_study') ? ' has-error' : '' }}">
	{!! Form::label('has_program_study', 'Has Program of Study:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::checkbox('has_program_study', null) !!}

		@if ($errors->has('has_program_study'))
			<span class="help-block">
				<strong>{{ $errors->first('has_program_study') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('is_current') ? ' has-error' : '' }}">
	{!! Form::label('is_current', 'Current Student:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::checkbox('is_current', null, $student_program == null ? 'yes' : $student_program->is_current) !!}
	
		@if ($errors->has('is_current'))
			<span class="help-block">
				<strong>{{ $errors->first('is_current') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('is_graduated') ? ' has-error' : '' }}">
	{!! Form::label('is_graduated', 'Graduated:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::checkbox('is_graduated', null) !!}

		@if ($errors->has('is_graduated'))
			<span class="help-block">
				<strong>{{ $errors->first('is_graduated') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('semester_graduated_id') ? ' has-error' : '' }}">
	{!! Form::label('', 'Semester Graduated:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		<div class='row'>
			<div class='col-sm-6'>
				{!! Form::select('semester_graduated_name_id', $semester_names, $student_program == null ? null : ($student_program->is_graduated ? $student_program->semester_started->name_id : null), ['placeholder' => "", 'class' => 'form-control']) !!}
			</div>
			<div class='col-sm-6'>
				{!! Form::number('semester_graduated_year', $student_program == null ? null : ($student_program->is_graduated ? $student_program->semester_graduated->calendar_year : null), ['class' => 'form-control', 'placeholder' => 'Year']) !!}
			</div>
		</div>

		@if ($errors->has('semester_graduated_id'))
			<span class="help-block">
				<strong>{{ $errors->first('semester_graduated_id') }}</strong>
			</span>
		@endif
	</div>
	<?php //<a class="btn btn-default" data-toggle="tooltip" title="Add a semester" href={{ '/' . str_replace("/","SLASH", "/" . Request::decodedPath()) . '/semesters/add' }} ><span class="glyphicon glyphicon-plus"></span></a> ?>
</div>

<div class="form-group">
	<div class="col-md-6 col-md-offset-4">
		<div class="btn-group">
       	{!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
       	{!! Form::button('Cancel', ['onClick' => "parent.location='/student'", 'class' => 'btn btn-danger']) !!}
        </div>
    </div>
</div>
