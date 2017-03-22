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
						      	
						        {!! Form::open(['method' => 'DELETE', 'route' => ['student.delete', $student], 'class' => 'form-horizontal', 'onsubmit' => 'return ConfirmDelete()']) !!}
						        	<div class="btn-group">
					        			<!-- <button class="btn" data-toggle="tooltip" title="Edit"> --><a class="btn btn-default" data-toggle="tooltip" title="Edit" href="{{ url('/student/' . $student->id) }}"><span class="glyphicon glyphicon-edit"></span></a><!-- </button> -->
						        		{!! Form::button('<i class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-default']) !!}
						        	</div>
						        {!! Form::close() !!}
					      		
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
        <div class="col-md-1">
	        {!! Form::open(['method' => 'GET', 'route' => ['student.store']]) !!}
	        	{!! Form::button('Add a Student', ['type' => 'submit', 'class' => 'btn']) !!}
	        {!! Form::close() !!}      		
	        <!-- <a href="{{ url('/student/add') }}" class="btn">Add a User</a> -->
        </div>
	</div>
</div>
@endsection

@section('scripts')
<script>

  function ConfirmDelete()
  {
	  var x = confirm("Are you sure you want to delete?");
	  if (x)
	    return true;
	  else
	    return false;
  }

</script>
@endsection