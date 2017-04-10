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
});
</script>
@endsection