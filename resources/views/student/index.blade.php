@extends('layouts.app')

@section('content')
<?php $allowChanges = Auth::user()->role->name === 'Director' || Auth::user()->role->name === 'Secretary'?>
<div class="container">
	<div class="row">

		<nav class="col-md-3">
			<h3>Filters</h3>
				{!! Form::open(['method' => 'GET', 'route' => ['student.index_filter'], 'class' => 'form-horizontal']) !!}
					<div class="form-group">
						{!! Form::label('sort_by', 'Sort By:') !!}
						{!! Form::select('sort_by', $sort_options, $sort_by, ['class' => 'form-control']) !!}
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
						{!! Form::select('advisor_id[]', $advisors, $advisor_id, ['id' => 'advisor_id', 'class' => 'form-control', 'multiple']) !!}
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
						{!! Form::label('faculty_supported', 'Faculty Sponsored:') !!}
						{!! Form::select('faculty_supported', $yesNo, $faculty_supported, ['placeholder' => "", 'class' => 'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Search', ['class' => 'btn btn-info']) !!}
						{!! Form::button('Refresh', ['onClick' => "parent.location='/student'", 'class' => 'btn btn-warning']) !!}
					</div>
				{!! Form::close() !!}
			<h4>Results: {{ count($students) }}</h4>
		</nav>

		<div class="col-md-7">
            <div class="panel-group">

            	<div class="btn-group">
	            	<a class="btn btn-default" id="expand_all">Expand All</a>
	            	<a class="btn btn-default" id="collapse_all">Collapse All</a>
	            </div>

            	<!-- Start data for each student -->
            	@foreach($students as $student)
            		@include('student/partials/_student_info',['student' => $student, 'fromAdvisor' => false, 'allowChanges' => $allowChanges, 'showRank' => $showRank])
            	@endforeach

            </div>
        </div>

		<!-- Affixed side nav for 'Add a Student' button -->
		@if($allowChanges)
	        <nav class="col-md-2">
	        	<div data-spy="affix" data-offset-top="-1">
	    			<a href="{{ url('/student/add') }}" class="btn btn-success btn-lg">Add a Student</a>
	        	</div>
	    	</nav>
    	@endif

	</div>
</div>
@endsection
