<div class="panel panel-info">
  	<div class="panel-heading clearfix">
  		<div class="panel-title pull-left" style="padding-top: 4px;">
  				<a data-toggle="collapse" href="#collapse_stud_prog_partial{{ $student_program->id }}">{{ $student_program->program->name . ($student_program->is_graduated ? ' - Graduated' : '') }}</a>
  		</div>

  		@if($allowChanges)
  		{!! Form::open(['method' => 'DELETE', 'route' => ['student_program.delete', $student_program], 'class' => 'form-horizontal', 'onsubmit' => 'return ConfirmDelete()']) !!}
      		<div class="btn-group pull-right">
      			<a href="{{ url('/student_program/' . $student_program->id) }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
      			{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-default btn-sm', 'data-toggle' => 'tooltip', 'title' => 'Delete']) !!}
      		</div>
      	{!! Form::close() !!}
      	@endif
	</div>
  	<div id="collapse_stud_prog_partial{{ $student_program->id }}" class="panel-collapse {{ $student_program == null ? '' : (!$student_program->is_current ? 'collapse' : 'in') }}">
  		<div class="panel-body">
      		<div class="row">
      			<div class="col-md-6">
		        	<ul class="list-group">
		        		@if(!$fromAdvisor)
		        		<li class="list-group-item">Advisor: {{ $student_program->advisor->full_name }} <a href={{ "/advisor/info/" . $student_program->advisor_id}} class="glyphicon glyphicon-new-window"></a></li>
		        		@endif
		        		<li class="list-group-item">Semester Started: {{ $student_program->semester_started->full_name }}</li>
		        		<li class="list-group-item{{ !$student_program->has_program_study ? ' list-group-item-danger' : '' }}">Has Program of Study: {{ $student_program->has_program_study == 1 ? "Yes" : "No" }}</li>
		        		<?php $passedGCE = false; ?>
		        		@if($student_program != null && !$student_program->gce_results->isEmpty())
		        			<?php $passedGCE = $student_program->gce_results->contains(function ($index, $result) { return $result->passed; }); ?>
		        		@endif
		        		@if($student_program->program->needs_gce)
		        		<li class="list-group-item{{ !$passedGCE ? ' list-group-item-danger' : '' }}">GCE Completed: {{ $passedGCE ? "Yes" : "No" }}</li>
		        		@endif
		        		<li class="list-group-item{{ !$student_program->passed_gqes ? ' list-group-item-danger' : ''}}">GQEs Passed: {{ $student_program->num_gqes_passed . "/" . $student_program->num_gqes_needed }}</li>
		        	</ul>
	        	</div>
	        	<div class="col-md-6">
	        		<ul class="list-group">
		        		<li class="list-group-item{{ !$student_program->is_current ? ' list-group-item-warning' : '' }}">Current: {{ $student_program->is_current ? "Yes" : "No" }}</li>
		        		<li class="list-group-item">Graduated: {{ $student_program->is_graduated ? "Yes" : "No" }}</li>
		        		<li class="list-group-item">Semester Graduated: {{ $student_program->semester_graduated != null ? $student_program->semester_graduated->full_name : "N/A" }}</li>
		        		@if($student_program->program->needs_committee)
		        		<li class="list-group-item{{ !$student_program->has_committee ? ' list-group-item-danger' : '' }}">Has Committee: {{ $student_program->has_committee == 1 ? "Yes" : "No" }}</li>
		        		@endif
		        		@if($student_program->program->needs_gce && $passedGCE)
		        		<li class="list-group-item">GCE Completion Date: {{ $passedGCE ? App\GceResult::select('date')->where('student_id',$student_program->student_id)->where('passed',true)->get()[0]["date"] : "" }}
		        		@endif
	        		</ul>
	        	</div>
	        </div>
	        <ul class="list-group">
        		<li class="list-group-item">Topic: {{ $student_program->topic }}</li>
        	</ul>
        </div>
    </div>
</div>