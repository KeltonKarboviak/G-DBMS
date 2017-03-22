<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
	{!! Form::label('first_name', 'First Name:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::text('first_name', null, ['class' => 'form-control']) !!}

		@if ($errors->has('first_name'))
			<span class="help-block">
				<strong>{{ $errors->first('first_name') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
	{!! Form::label('last_name', 'Last Name:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::text('last_name', null, ['class' => 'form-control']) !!}

		@if ($errors->has('last_name'))
			<span class="help-block">
				<strong>{{ $errors->first('last_name') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
	{!! Form::label('id', 'EMPLID:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::text('id', null, ['class' => 'form-control']) !!}

		@if ($errors->has('id'))
			<span class="help-block">
				<strong>{{ $errors->first('id') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	{!! Form::label('email', 'Email:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::email('email', null, ['class' => 'form-control']) !!}

		@if ($errors->has('email'))
			<span class="help-block">
				<strong>{{ $errors->first('email') }}</strong>
			</span>
		@endif
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

<div class="form-group{{ $errors->has('undergrad_gpa') ? ' has-error' : '' }}">
	{!! Form::label('undergrad_gpa', 'Undergrad GPA:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::text('undergrad_gpa', null, ['class' => 'form-control']) !!}

		@if ($errors->has('undergrad_gpa'))
			<span class="help-block">
				<strong>{{ $errors->first('undergrad_gpa') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('has_program_study') ? ' has-error' : '' }}">
	{!! Form::label('has_program_study', 'Has Program of Study:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::checkbox('has_program_study', null) !!}
	</div>
</div>

<div class="form-group{{ $errors->has('semester_started_id') ? ' has-error' : '' }}">
	{!! Form::label('semester_started_id', 'Semester Started:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::select('semester_started_id', $semesters, null, ['placeholder' => "Choose a semester", 'class' => 'form-control']) !!}
	</div>
	<a class="btn btn-default" data-toggle="tooltip" title="Add a semester" href="/semesters/add"><span class="glyphicon glyphicon-plus"></span></a>
</div>

<div class="form-group{{ $errors->has('is_current') ? ' has-error' : '' }}">
	{!! Form::label('is_current', 'Current Student:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::checkbox('is_current', null) !!}
	</div>
</div>

<div class="form-group{{ $errors->has('is_graduated') ? ' has-error' : '' }}">
	{!! Form::label('is_graduated', 'Graduated:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::checkbox('is_graduated', null) !!}
	</div>
</div>

<div class="form-group{{ $errors->has('semester_graduated_id') ? ' has-error' : '' }}">
	{!! Form::label('semester_graduated_id', 'Semester Graduated:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::select('semester_graduated_id', $semesters, null, ['placeholder' => "Choose a semester", 'class' => 'form-control']) !!}

		@if ($errors->has('semester_graduated_id'))
			<span class="help-block">
				<strong>{{ $errors->first('semester_graduated_id') }}</strong>
			</span>
		@endif
	</div>
	<a class="btn btn-default" data-toggle="tooltip" title="Add a semester" href="/semesters/add"><span class="glyphicon glyphicon-plus"></span></a>
</div>

<div class="form-group">
	<div class="col-md-6 col-md-offset-4">
		<div class="btn-group">
       	{!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
       	{!! Form::button('Cancel', ['onClick' => "parent.location='/student'", 'class' => 'btn btn-danger']) !!}
        </div>
    </div>
</div>
