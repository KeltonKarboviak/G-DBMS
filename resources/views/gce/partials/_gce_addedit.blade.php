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

<div class="form-group{{ $errors->has('passed') ? ' has-error' : '' }}">
	{!! Form::label('passed', 'Passed:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::checkbox('passed', null) !!}
	</div>
</div>

<div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
	{!! Form::label('date', 'Date of Exam:', ['class' => 'col-md-4 control-label']) !!}

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

<div class="form-group">
	<div class="col-md-6 col-md-offset-4">
		<div class="btn-group">
       	{!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
       	{!! Form::button('Cancel', ['onClick' => "parent.location='/home'", 'class' => 'btn btn-danger']) !!}
        </div>
    </div>
</div>