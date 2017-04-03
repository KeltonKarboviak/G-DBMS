<?php $readonly = isset($readonly) ? $readonly : false ?>
<div class="form-group{{ $errors->has('student_id') ? ' has-error' : '' }}">
	{!! Form::label('student_id', 'Student:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::select('student_id', $students, null, ['placeholder' => 'Choose a student', 'class' => 'form-control', 'disabled' => $readonly]) !!}

		@if ($errors->has('student_id'))
			<span class="help-block">
				<strong>{{ $errors->first('student_id') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('position_id') ? ' has-error' : '' }}">
	{!! Form::label('position_id', 'Position:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::select('position_id', $positions, null, ['placeholder' => "Choose a position", 'class' => 'form-control']) !!}

		@if ($errors->has('position_id'))
			<span class="help-block">
				<strong>{{ $errors->first('position_id') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('semester_id') ? ' has-error' : '' }}">
	{!! Form::label('semester_id', 'Semester For:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::select('semester_id', $semesters, null, ['placeholder' => "Choose a semester", 'class' => 'form-control']) !!}

		@if ($errors->has('semester_id'))
			<span class="help-block">
				<strong>{{ $errors->first('semester_id') }}</strong>
			</span>
		@endif
	</div>
	<a class="btn btn-default" data-toggle="tooltip" title="Add a semester" href={{ '/' . str_replace("/","SLASH", "/" . Request::decodedPath()) . '/semesters/add' }} ><span class="glyphicon glyphicon-plus"></span></a>
</div>

<div class="form-group{{ $errors->has('date_offered') ? ' has-error' : '' }}">
	{!! Form::label('date_offered', 'Date Offered:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		<div class="input-group">
			{!! Form::text('date_offered', null, ['id' => 'datepicker', 'class' => 'form-control']) !!}
			<span class="input-group-btn">
				<button class="btn btn-default" type="button" data-toggle="tooltip" title="Select a date">
					<span class="glyphicon glyphicon-calendar"></span>
				</button>
			</span>
		</div>

		@if ($errors->has('date_offered'))
			<span class="help-block">
				<strong>{{ $errors->first('date_offered') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('date_responded') ? ' has-error' : '' }}">
	{!! Form::label('date_responded', 'Date Responded:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		<div class="input-group">
			{!! Form::text('date_responded', null, ['id' => 'datepicker1', 'class' => 'form-control']) !!}
			<span class="input-group-btn">
				<button class="btn btn-default" type="button" data-toggle="tooltip" title="Select a date">
					<span class="glyphicon glyphicon-calendar"></span>
				</button>
			</span>
		</div>

		@if ($errors->has('date_responded'))
			<span class="help-block">
				<strong>{{ $errors->first('date_responded') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('date_deferred') ? ' has-error' : '' }}">
	{!! Form::label('date_deferred', 'Date Deferred Until:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		<div class="input-group">
			{!! Form::text('date_deferred', null, ['id' => 'datepicker2', 'class' => 'form-control']) !!}
			<span class="input-group-btn">
				<button class="btn btn-default" type="button" data-toggle="tooltip" title="Select a date">
					<span class="glyphicon glyphicon-calendar"></span>
				</button>
			</span>
		</div>

		@if ($errors->has('date_deferred'))
			<span class="help-block">
				<strong>{{ $errors->first('date_deferred') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('current_status') ? ' has-error' : '' }}">
	{!! Form::label('current_status', 'Current Status:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::select('current_status', $statuses, null, ['placeholder' => "Choose a status", 'class' => 'form-control']) !!}

		@if ($errors->has('current_status'))
			<span class="help-block">
				<strong>{{ $errors->first('current_status') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('stipend') ? ' has-error' : '' }}">
	{!! Form::label('stipend', 'Stipend Amount:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::text('stipend', null, ['class' => 'form-control']) !!}

		@if ($errors->has('stipend'))
			<span class="help-block">
				<strong>{{ $errors->first('stipend') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('stipend_funding_source_id') ? ' has-error' : '' }}">
	{!! Form::label('stipend_funding_source_id', 'Stipend Funding Source:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::select('stipend_funding_source_id', $funding_sources, null, ['placeholder' => "Choose a funding source", 'class' => 'form-control']) !!}

		@if ($errors->has('stipend_funding_source_id'))
			<span class="help-block">
				<strong>{{ $errors->first('stipend_funding_source_id') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('corresponding_tuition_waiver') ? ' has-error' : '' }}">
	{!! Form::label('corresponding_tuition_waiver', 'Corresponding Tuition Waiver:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::select('corresponding_tuition_waiver', $tuition_waivers, null, ['placeholder' => "Choose a tuition waiver", 'class' => 'form-control']) !!}

		@if ($errors->has('corresponding_tuition_waiver'))
			<span class="help-block">
				<strong>{{ $errors->first('corresponding_tuition_waiver') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group">
	<div class="col-md-6 col-md-offset-4">
		<div class="btn-group">
       	{!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
       	{!! Form::button('Cancel', ['onClick' => "parent.location='/home'", 'class' => 'btn btn-danger']) !!}
        </div>
    </div>
</div>