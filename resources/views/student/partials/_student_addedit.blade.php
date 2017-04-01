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

<div class="form-group{{ $errors->has('faculty_supported') ? ' has-error' : '' }}">
	{!! Form::label('faculty_supported', 'Faculty Sponsored:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::checkbox('faculty_supported', null) !!}
	</div>
</div>

<div class="form-group{{ $errors->has('gre_score') ? ' has-error' : '' }}">
	{!! Form::label('gre_score', 'GRE score:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::text('gre_score', $student == null ? null : ($student->gre == null ? null : $student->gre->score), ['class' => 'form-control']) !!}

		@if ($errors->has('gre_score'))
			<span class="help-block">
				<strong>{{ $errors->first('gre_score') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('toefl_score') ? ' has-error' : '' }}">
	{!! Form::label('toefl_score', 'TOEFL score:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::text('toefl_score', $student == null ? null : ($student->toefl == null ? null : $student->toefl->score), ['class' => 'form-control']) !!}

		@if ($errors->has('toefl_score'))
			<span class="help-block">
				<strong>{{ $errors->first('toefl_score') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('ielts_score') ? ' has-error' : '' }}">
	{!! Form::label('ielts_score', 'IELTS score:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::text('ielts_score', $student == null ? null : ($student->ielts == null ? null : $student->ielts->score), ['class' => 'form-control']) !!}

		@if ($errors->has('ielts_score'))
			<span class="help-block">
				<strong>{{ $errors->first('ielts_score') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group">
	<div class="col-md-6 col-md-offset-4">
		<div class="btn-group">
       	{!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
       	{!! Form::button('Cancel', ['onClick' => "parent.location='/student'", 'class' => 'btn btn-danger']) !!}
        </div>
    </div>
</div>
