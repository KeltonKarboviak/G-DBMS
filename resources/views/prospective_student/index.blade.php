@extends('layouts.app')

@section('content')
<?php $allowChanges = Auth::user()->role->name === 'Director'?>
<div class="container">
	<div class="row">

		<nav class="col-md-3">
			<h3>Filters</h3>
				{!! Form::open(['method' => 'GET', 'route' => ['prospective_student.index_filter'], 'class' => 'form-horizontal']) !!}
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

					{{-- <div class="form-group">
						{!! Form::label('semester_started_id',"Semester Started:") !!}
						{!! Form::select('semester_started_id[]', $semesters, $semester_started_id, ['id' => 'sememester_started_id', 'class' => 'form-control', 'multiple']) !!}
					</div> --}}

					<div class="form-group">
						{!! Form::label('faculty_supported', 'Faculty Sponsored:') !!}
						{!! Form::select('faculty_supported', $yesNo, $faculty_supported, ['placeholder' => "", 'class' => 'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Search', ['class' => 'btn btn-info']) !!}
						{!! Form::button('Refresh', ['onClick' => "parent.location='/prospective_student'", 'class' => 'btn btn-warning']) !!}
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
            		@include('prospective_student/partials/_prospective_student_info',['student' => $student, 'allowChanges' => $allowChanges, 'showRank' => $showRank])
            	@endforeach

            </div>
        </div>

		<!-- Affixed side nav for 'Add a Student' button -->
		@if($allowChanges)
	        <nav class="col-md-2">
	        	<div data-spy="affix" data-offset-top="-1">
	    			<a href="{{ url('/prospective_student/add') }}" class="btn btn-success btn-lg">Add a Prospective Student</a>
	        	</div>
	    	</nav>
    	@endif

	</div>
</div>
@endsection
