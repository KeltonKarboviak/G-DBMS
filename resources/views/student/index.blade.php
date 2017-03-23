@extends('layouts.app')

@section('styles')
<style>

</style>
@endsection

@section('content')
<div class="container">
	<div class="row">

		<!-- Affixed side nav for filtering results -->
		<nav class="col-md-3">
			<div data-spy="affix" data-offset-top="0">
				<h3>Filters</h3>
				<ul class="nav nav-pills nav-stacked">
					<li><a href="#">Filter 1</a></li>
					<li><a href="#">Filter 2</a></li>
					<li><a href="#">Filter 3</a></li>
				</ul>
				<h4>Results: {{ count($students) }}</h4>
			</div>
		</nav>

		<div class="col-md-6">
            <div class="panel-group">

            	<?php $count = 0; ?>

            	<!-- Start data for each student -->
            	@foreach ($students as $student)
            		<?php $count = $count++; ?>

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
							        		<li class="list-group-item">Advisor: {{ $student->advisor->full_name }} <a href="#" class="glyphicon glyphicon-new-window"></a></li>
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
						        		</ul>
						        	</div>
						        </div>
					        </div>
					    </div>
				    </div>
            	@endforeach

            </div>

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
			<h1>Some text to enable scrolling</h1>
			<h1>Some text to enable scrolling</h1>
        </div>

		<!-- Affixed side nav for 'Add a Student' button -->
        <nav class="col-md-3">
        	<div data-spy="affix" data-offset-top="0">
        		<ul class="nav nav-pills nav-stacked">
        			<li><a href="{{ url('/student/add') }}" class="btn btn-success btn-lg">Add a Student</a></li>
        		</ul>
        	</div>
    	</nav>

	</div>
</div>
@endsection

@section('scripts')
<script>

function ConfirmDelete()
{
  var x = confirm("Are you sure you want to delete?");
  return x;
}

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endsection