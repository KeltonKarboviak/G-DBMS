@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
            <div class="panel-group" id="accordian">
            	<?php $count = 0; ?>

            	<!-- Start data for each student -->
            	@foreach (App\Student::orderBy('last_name')->get() as $student)
            		<?php $count = $count + 1; ?>
            		<div class="panel panel-default">
				      	<div class="panel-heading vertical-center">
					        <h3 class="panel-title pull-left">
					          	<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $count }}">{{ $student->last_name . ", " . $student->first_name }}</a>
					        </h3>
						    <div class="panel-title pull-right" >
						      	<div class="btn-group">
							        <a href="{{ url('/student/' . $student->id) }}" class="btn" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
							        <a class="btn" data-toggle="tooltip" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
					      		</div>
					      	</div>
					      	<div class="clearfix"></div>
			      		</div>
				      	<div id="collapse{{ $count }}" class="panel-collapse collapse">
				        	<div class="panel-body">
					        	<ul>
					        		<li class="list-group-item">EMPLID: {{ $student->id }}</li>
					        		<li class="list-group-item">Email: {{ $student->email }}</li>
					        		<li class="list-group-item">Program: {{ $student->program_id }}</li>
					        		<li class="list-group-item">Advisor: {{ $student->advisor_id }} <a href="#" class="glyphicon glyphicon-new-window"></a></li>
					        		<li class="list-group-item">Undergrad GPA: {{ $student->undergrad_gpa }}</li>
					        		<li class="list-group-item">Has Program of Study: {{ $student->has_program_study == 1 ? "Yes" : "No"}}</li>
					        		<li class="list-group-item">Semester Started: {{ $student->semester_started_id }}</li>
					        		<li class="list-group-item">Current: {{ $student->is_current ? "Yes" : "No"}}</li>
					        		<li class="list-group-item">Graduated: {{ $student->is_graduated ? "Yes" : "No" }}</li>
					        		<li class="list-group-item">Semester Graduated: {{ $student->semester_graduated_id ?: "N/A"}}</li>
					        		<li class="list-group-item">Faculty Supported (for Ranking): {{ $student->faculty_supported ? "Yes" : "No" }}</li>
					        	</ul>
					        </div>
					    </div>
				    </div>
            	@endforeach

            </div> 
        </div>
	</div>
</div>
@endsection
