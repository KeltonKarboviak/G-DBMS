<?php $readonly = isset($readonly) ? $readonly : false?>
<div class="form-group{{ $errors->has('student_id') ? ' has-error' : '' }}">
	{!! Form::label('student_id', 'Student:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::select('student_id', $students, null, ['placeholder' => 'Choose a student', 'class' => 'form-control', 'disabled' => $readonly]) !!}

		<span class="help-block" id="assist_amounts">
			
		</span>
		@if ($errors->has('student_id'))
			<span class="help-block">
				<strong>{{ $errors->first('student_id') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
	{!! Form::label('position', 'Position:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::select('position', $positions, null, ['placeholder' => "Choose a position", 'class' => 'form-control']) !!}

		@if ($errors->has('position'))
			<span class="help-block">
				<strong>{{ $errors->first('position') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('semester_name_id') || $errors->has('semester_year')? ' has-error' : '' }}">
	{!! Form::label('semester_id', 'For Semester:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		<div class='row'>
            <div class='col-sm-6'>
                {!! Form::select('semester_name_id', $semester_names, $assist == null ? null : $assist->semester->name_id, ['placeholder' => "", 'class' => 'form-control']) !!}

                @if ($errors->has('semester_name_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('semester_name_id') }}</strong>
                    </span>
                @endif
            </div>
            <div class='col-sm-6'>
                {!! Form::number('semester_year', $assist == null ? null : $assist->semester->calendar_year, ['class' => 'form-control', 'placeholder' => 'Year']) !!}

                @if ($errors->has('semester_year'))
                    <span class="help-block">
                        <strong>{{ $errors->first('semester_year') }}</strong>
                    </span>
                @endif
            </div>
        </div>
	</div>
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

<div class="form-group{{ $errors->has('defer_date') ? ' has-error' : '' }}">
	{!! Form::label('defer_date', 'Date Deferred Until:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		<div class="input-group">
			{!! Form::text('defer_date', null, ['id' => 'datepicker2', 'class' => 'form-control']) !!}
			<span class="input-group-btn">
				<button class="btn btn-default" type="button" data-toggle="tooltip" title="Select a date">
					<span class="glyphicon glyphicon-calendar"></span>
				</button>
			</span>
		</div>

		@if ($errors->has('defer_date'))
			<span class="help-block">
				<strong>{{ $errors->first('defer_date') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('current_status_id') ? ' has-error' : '' }}">
	{!! Form::label('current_status_id', 'Current Status:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::select('current_status_id', $statuses, null, ['placeholder' => "Choose a status", 'class' => 'form-control']) !!}

		@if ($errors->has('current_status_id'))
			<span class="help-block">
				<strong>{{ $errors->first('current_status_id') }}</strong>
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

<div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
	{!! Form::label('time', 'Time:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::text('time', null, ['class' => 'form-control', 'placeholder' => '1/4 time, 1/2 time, etc']) !!}

		@if ($errors->has('time'))
			<span class="help-block">
				<strong>{{ $errors->first('time') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('funding_source_id') ? ' has-error' : '' }}">
	{!! Form::label('funding_source_id', 'Stipend Funding Source:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::select('funding_source_id', $funding_sources, null, ['placeholder' => "Choose a funding source", 'class' => 'form-control']) !!}

		@if ($errors->has('funding_source_id'))
			<span class="help-block">
				<strong>{{ $errors->first('funding_source_id') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('corresponding_tuition_waiver_id') ? ' has-error' : '' }}">
	{!! Form::label('corresponding_tuition_waiver_id', 'Corresponding Tuition Waiver:', ['class' => 'col-md-4 control-label']) !!}

	<div class="col-md-6">
		{!! Form::select('corresponding_tuition_waiver_id', $tuition_waivers, null, ['placeholder' => "Choose a tuition waiver", 'class' => 'form-control']) !!}

		@if ($errors->has('corresponding_tuition_waiver_id'))
			<span class="help-block">
				<strong>{{ $errors->first('corresponding_tuition_waiver_id') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="panel panel-und hidden" id="gta_assignment_panel">
	<div class="panel-heading">
		<h2 class="panel-title">GTA Assignment</h2>
	</div>
	<div class="panel-body">
		<div class="form-group{{ $errors->has('instructor_id') ? ' has-error' : '' }}">
			{!! Form::label('instructor_id', 'Instructor:', ['class' => 'col-md-4 control-label']) !!}

			<div class="col-md-6">
				{!! Form::select('instructor_id', $instructors, $assignment == null ? null : $assignment->instructor_id, ['placeholder' => "Choose an Instructor", 'class' => 'form-control', 'disabled']) !!}

				@if ($errors->has('instructor_id'))
					<span class="help-block">
						<strong>{{ $errors->first('instructor_id') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-group{{ $errors->has('course') ? ' has-error' : '' }}">
			{!! Form::label('course', 'Course:', ['class' => 'col-md-4 control-label']) !!}

			<div class="col-md-6">
				{!! Form::text('course', $assignment == null ? null : $assignment->course, ['class' => 'form-control', 'placeholder' => 'CS160, etc','disabled']) !!}

				@if ($errors->has('course'))
					<span class="help-block">
						<strong>{{ $errors->first('course') }}</strong>
					</span>
				@endif
			</div>
		</div>
	</div>
</div>

<div class="form-group">
	<div class="col-md-6 col-md-offset-4">
		<div class="btn-group">
       	{!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
       	{!! Form::button('Cancel', ['onClick' => "parent.location='/assistantship'", 'class' => 'btn btn-danger']) !!}
        </div>
    </div>
</div>

@foreach ($assist_amounts as $student => $msg)
	<input type="hidden" id="msg_{{ $student }}" value="{{ $msg }}" />
@endforeach

@section('scripts')
<script>
$(function () {
	$('select[name="student_id"').change(function () {
		$('span#assist_amounts').html(
			$('#msg_' + $(this).val()).val()
		);
	});

	$('select[name="position"]').change(function () {
		var position = $(this).children('option:selected').html();
		console.log(position);
		var $gta_panel = $('div#gta_assignment_panel');
		if (position === "GTA") {
			$gta_panel.removeClass('hidden')
				.find('select').attr('disabled', false)
				.end()
				.find('input').attr('disabled', false);
		}
		else
			$gta_panel.addClass('hidden')
				.find('select').attr('disabled', true)
				.end()
				.find('input').attr('disabled', true);
	}).change();
});
</script>
@endsection