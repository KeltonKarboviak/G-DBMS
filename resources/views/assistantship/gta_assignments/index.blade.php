@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		<nav class="col-md-3">
			<h3>Filters</h3>
				{!! Form::open(['method' => 'GET', 'route' => ['gta_assignment.index_filter'], 'class' => 'form-horizontal']) !!}
					<div class="form-group">
						{!! Form::label('sort_by', 'Sort By:') !!}
						{!! Form::select('sort_by', $sort_options, $sort_by, ['class' => 'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('first_name',"TA First Name:") !!}
						{!! Form::text('first_name', $first_name, ['class' => 'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('last_name',"TA Last Name:") !!}
						{!! Form::text('last_name', $last_name, ['class' => 'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('instructor_id',"Instructor:") !!}
						{!! Form::select('instructor_id[]', $instructors, $instructor_id, ['class' => 'form-control', 'multiple']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('semester_id',"Semester:") !!}
						{!! Form::select('semester_id[]', $semesters, $semester_id, ['id' => 'semester_id', 'class' => 'form-control', 'multiple']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Search', ['class' => 'btn btn-info']) !!}
						{!! Form::button('Refresh', ['onClick' => "parent.location='/assistantship/gta_assignments/'", 'class' => 'btn btn-warning']) !!}
					</div>
				{!! Form::close() !!}
			<h4>Results: {{ count($gtas) }}</h4>
		</nav>

		<div class="col-md-7">
            <div class="panel-group">

            	<?php $gta_count = 0; ?>
            	<!-- <div class="btn-group">
	            	<a class="btn btn-default" id="expand_all">Expand All</a>
	            	<a class="btn btn-default" id="collapse_all">Collapse All</a>
	            </div> -->
	            <div class='panel panel-primary'>
        			<div class='panel-heading clearfix'>
        				<div class='panel-title'>
        					GTA Assignments
        				</div>
        			</div>
        			<table class='table table-striped table-condensed table-bordered'>
        				<tr>
        					<td><strong>Course</strong></td>
        					<td><strong>GTA</strong></td>
        					<td><strong>Instructor</strong></td>
        					<td><strong>Semester</strong></td>
        				</tr>
	            		<!-- Start data for each student -->
		            	@foreach($gtas as $gta)
		            		<?php $gta_count = $gta_count + 1; ?>
		            		<tr>
		            			<td>{{ $gta->course }}</td>
		            			<td>{{ $gta->assistantship->student->proper_name }}</td>
		            			<td>{{ $gta->instructor->proper_name }}</td>
		            			<td>{{ $gta->assistantship->semester->full_name }}
		            		</tr>
		            	@endforeach
	            	</table>
            	</div>

            </div>
        </div>
	</div>
</div>
@endsection

@section('scripts')
<script>
$(function () {
	$("#collapse_all").click(function(){
		$('div[id*="collapse"]').collapse('hide');
	});

	$("#expand_all").click(function(){
		$('div[id*="collapse"]').collapse('show');
	});
});
</script>
@endsection
