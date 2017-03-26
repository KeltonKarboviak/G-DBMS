@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Advisor Information</h2>
				</div>
				<div class="panel-body">
		        	<ul class="list-group">
		        		<li class="list-group-item">Name: {{ $advisor->first_name . " " . $advisor->last_name }}</li>
		        		<li class="list-group-item">EMPLID: {{ $advisor->id }}</li>
		        		<li class="list-group-item">Email: {{ $advisor->email }}</li>
		        	</ul>
		        <h3>Students advised</h3>
		        <!-- Start data for each student -->
		        <?php $count = 0?>
            	@foreach ($students as $student)
            		<?php $count = $count+1; ?>

            		<div class="panel panel-primary">
				      	<div class="panel-heading clearfix">
				      		<div class="panel-title pull-left" style="padding-top: 4px;">
				      			<a data-toggle="collapse" href="#collapse{{ $count }}">{{ $student->last_name . ", " . $student->first_name }}</a>
				      		</div>
			      		</div>
				      	<div id="collapse{{ $count }}" class="panel-collapse collapse">
				      		<div class="panel-body">
					      		<div class="row">
					      			<div class="col-md-6">
							        	<ul class="list-group">
							        		<li class="list-group-item">EMPLID: {{ $student->id }}</li>
							        		<li class="list-group-item">Email: <a href="mailto:{{ $student->email }}">{{ $student->email }} <span class="glyphicon glyphicon-envelope"></span></a></li>
							        		<li class="list-group-item">Program: {{ $student->program->name }}</li>
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
			</div>
 		</div>
	</div>
</div>
@endsection
