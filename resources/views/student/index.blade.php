@extends('layouts.app')

@section('styles')
<style>
	label {
		padding-top: 3px;
	}
</style>
@endsection

@section('content')
<div class="container">
	<div class="row">

		<!-- Affixed side nav for filtering results -->
		<nav class="col-md-3">
			<!-- <div data-spy="affix" data-offset-top="-1"> -->
				<h3>Filters</h3>
					{!! Form::open(['method' => 'GET', 'route' => ['student.index_filter'], 'class' => 'form-horizontal']) !!}
						<div class="form-group">
							For the multiple select boxes, hold Ctrl (Windows) or Cmd (Mac) to select multiple options.
						</div>
						<div class="form-group">
							{!! Form::label('first_name',"First Name:") !!}
							{!! Form::text('first_name', $first_name, ['class' => 'form-control']) !!}
						</div>

						<div class="form-group">
							{!! Form::label('last_name',"Last Name:") !!}
							{!! Form::text('last_name', $last_name, ['class' => 'form-control']) !!}
						</div>

						<div class="form-group">
							{!! Form::label('advisor_id',"Advisor:") !!}
							{!! Form::select('advisor_id[]', $advisors, $advisors, ['id' => 'advisor_id', 'class' => 'form-control', 'multiple']) !!}
						</div>

						<div class="form-group">
							{!! Form::label('program_id',"Program:") !!}
							{!! Form::select('program_id[]', $programs, $program_id, ['id' => 'program_id', 'class' => 'form-control', 'multiple']) !!}
						</div>

						<div class="form-group">
							{!! Form::label('semester_started_id',"Semester Started:") !!}
							{!! Form::select('semester_started_id[]', $semesters, $semester_started_id, ['id' => 'sememester_started_id', 'class' => 'form-control', 'multiple']) !!}
						</div>

						<div class="form-group">
							{!! Form::label('semester_graduated_id',"Semester Graduated:") !!}
							{!! Form::select('semester_graduated_id[]', $semesters, $semester_graduated_id, ['id' => 'semester_graduated_id', 'class' => 'form-control', 'multiple']) !!}
						</div>

						<div class="form-group">
							{!! Form::label('is_current', 'Current Student:') !!}
							{!! Form::select('is_current', $yesNo, $is_current, ['placeholder' => "", 'class' => 'form-control']) !!}
						</div>

						<div class="form-group">
							{!! Form::label('has_committee', 'Has Committee:') !!}
							{!! Form::select('has_committee', $yesNo, $has_committee, ['placeholder' => "", 'class' => 'form-control']) !!}
						</div>

						<div class="form-group">
							{!! Form::label('has_program_study', 'Has Program of Study:') !!}
							{!! Form::select('has_program_study', $yesNo, $has_program_study, ['placeholder' => "", 'class' => 'form-control']) !!}
						</div>

						<div class="form-group">
							{!! Form::label('is_graduated', 'Graduated:') !!}
							{!! Form::select('is_graduated', $yesNo, $is_graduated, ['placeholder' => "", 'class' => 'form-control']) !!}
						</div>

						<div class="form-group">
							{!! Form::label('faculty_supported', 'Faculty Supported:') !!}
							{!! Form::select('faculty_supported', $yesNo, $faculty_supported, ['placeholder' => "", 'class' => 'form-control']) !!}
						</div>

						<div class="form-group">
							{!! Form::submit('Search', ['class' => 'btn btn-info']) !!}
							{!! Form::button('Refresh', ['onClick' => "parent.location='/student'", 'class' => 'btn btn-warning']) !!}
						</div>
					{!! Form::close() !!}
				<h4>Results: {{ count($students) }}</h4>
			<!-- </div> -->
		</nav>

		<div class="col-md-7">
            <div class="panel-group">

            	<?php $count = 0; ?>

            	<!-- Start data for each student -->
            	@foreach ($students as $student)
            		<?php $count = $count + 1; ?>

            		<div class="panel panel-primary">
				      	<div class="panel-heading clearfix">
				      		<div class="panel-title pull-left" style="padding-top: 4px;">
				      			<a data-toggle="collapse" href="#collapse{{ $count }}">{{ $student->last_name . ", " . $student->first_name }}</a>
				      		</div>
				      		{!! Form::open(['method' => 'DELETE', 'route' => ['student.delete', $student], 'class' => 'form-horizontal', 'onsubmit' => 'return ConfirmDelete()']) !!}
					      		<div class="btn-group pull-right">
					      			<a href="{{ url('/student/' . $student->id) }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
					      			{!! Form::button('<i class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-default btn-sm']) !!}
					      		</div>
					      	{!! Form::close() !!}
			      		</div>
				      	<div id="collapse{{ $count }}" class="panel-collapse collapse">
				      		<div class="panel-body">
					      		<div class="row">
					      			<div class="col-md-6">
							        	<ul class="list-group">
							        		<li class="list-group-item">EMPLID: {{ $student->id }}</li>
							        		<li class="list-group-item">Email: <a href="mailto:{{ $student->email }}">{{ $student->email }} <span class="glyphicon glyphicon-envelope"></span></a></li>
							        		<li class="list-group-item">Program: {{ $student->program->name }}</li>
							        		<li class="list-group-item">Advisor: {{ $student->advisor->full_name }} <a href={{ "/advisor/info/" . $student->advisor_id}} class="glyphicon glyphicon-new-window"></a></li>
							        		<li class="list-group-item">Undergrad GPA: {{ $student->undergrad_gpa }}</li>
							        		<li class="list-group-item{{ !$student->has_program_study ? ' list-group-item-danger' : '' }}">Has Program of Study: {{ $student->has_program_study == 1 ? "Yes" : "No" }}</li>
							        	</ul>
						        	</div>
						        	<div class="col-md-6">
						        		<ul class="list-group">
						        			<li class="list-group-item">Semester Started: {{ $student->semester_started->full_name }}</li>
							        		<li class="list-group-item">Current: {{ $student->is_current ? "Yes" : "No" }}</li>
							        		<li class="list-group-item">Graduated: {{ $student->is_graduated ? "Yes" : "No" }}</li>
							        		<li class="list-group-item">Semester Graduated: {{ $student->semester_graduated != null ? $student->semester_graduated->full_name : "N/A" }}</li>
							        		<li class="list-group-item">Faculty Supported (for Ranking): {{ $student->faculty_supported ? "Yes" : "No" }}</li>
							        		<li class="list-group-item{{ !$student->has_committee ? ' list-group-item-danger' : '' }}">Has Committee: {{ $student->has_committee == 1 ? "Yes" : "No" }}</li>
						        		</ul>
						        	</div>
						        </div>
					        </div>
					    </div>
				    </div>
            	@endforeach

            </div>

			<!-- <h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1> -->
        </div>

		<!-- Affixed side nav for 'Add a Student' button -->
        <nav class="col-md-2">
        	<div data-spy="affix" data-offset-top="-1">
        		<ul class="nav nav-pills nav-stacked">
        			<li><a href="{{ url('/student/add') }}" class="btn btn-success btn-lg">Add a Student</a></li>
        		</ul>
        	</div>
    	</nav>

	</div>
</div>
@endsection
