<div class="panel panel-primary">
  	<div class="panel-heading clearfix">
  		<div class="panel-title pull-left" style="padding-top: 4px;">
  			<a data-toggle="collapse" href="#collapse{{ $count }}">{{ $student->last_name . ", " . $student->first_name }}</a>
  		</div>
  		@if($allowChanges)
  		{!! Form::open(['method' => 'DELETE', 'route' => ['student.delete', $student], 'class' => 'form-horizontal', 'onsubmit' => 'return ConfirmDelete()']) !!}
      		<div class="btn-group pull-right">
      			<a href="{{ url('/student/' . $student->id) }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
      			{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-default btn-sm', 'data-toggle' => 'tooltip', 'title' => 'Delete']) !!}
      		</div>
      	{!! Form::close() !!}
      	@endif
		</div>
  	<div id="collapse{{ $count }}" class="panel-collapse collapse">
  		<div class="panel-body">
      		<div class="row">
      			<div class="col-md-6">
		        	<ul class="list-group">
		        		<li class="list-group-item">EMPLID: {{ $student->id }}</li>
		        		<li class="list-group-item">Email: <a href="mailto:{{ $student->email }}">{{ $student->email }} <span class="glyphicon glyphicon-envelope"></span></a></li>
		        		<li class="list-group-item">Program: {{ $student->program->name }}</li>
		        		@if(!$fromAdvisor)
		        		<li class="list-group-item">Advisor: {{ $student->advisor->full_name }} <a href={{ "/advisor/info/" . $student->advisor_id}} class="glyphicon glyphicon-new-window"></a></li>
		        		@endif
		        		<li class="list-group-item">Undergrad GPA: {{ $student->undergrad_gpa }}</li>
		        		<li class="list-group-item{{ !$student->has_program_study ? ' list-group-item-danger' : '' }}">Has Program of Study: {{ $student->has_program_study == 1 ? "Yes" : "No" }}</li>
		        		<?php $passedGCE = App\GceResult::where('student_id',$student->id)->where('passed',true)->count() > 0; ?>
		        		@if($student->program->needs_gce)
		        		<li class="list-group-item{{ !$passedGCE ? ' list-group-item-danger' : '' }}">GCE Completed: {{ $passedGCE ? "Yes" : "No" }}</li>
		        		@endif
		        		@if($student->gre != null)
		        		<li class="list-group-item">GRE Score: {{ $student->gre->score }}</li>
		        		@endif
		        	</ul>
	        	</div>
	        	<div class="col-md-6">
	        		<ul class="list-group">
	        			<li class="list-group-item">Semester Started: {{ $student->semester_started->full_name }}</li>
		        		<li class="list-group-item{{ !$student->is_current ? ' list-group-item-warning' : '' }}">Current: {{ $student->is_current ? "Yes" : "No" }}</li>
		        		<li class="list-group-item">Graduated: {{ $student->is_graduated ? "Yes" : "No" }}</li>
		        		<li class="list-group-item">Semester Graduated: {{ $student->semester_graduated != null ? $student->semester_graduated->full_name : "N/A" }}</li>
		        		<li class="list-group-item">Faculty Sponsored: {{ $student->faculty_supported ? "Yes" : "No" }}</li>
		        		@if($student->program->needs_committee)
		        		<li class="list-group-item{{ !$student->has_committee ? ' list-group-item-danger' : '' }}">Has Committee: {{ $student->has_committee == 1 ? "Yes" : "No" }}</li>
		        		@endif
		        		@if($student->program->needs_gce && $passedGCE)
		        		<li class="list-group-item">GCE Completion Date: {{ $passedGCE ? App\GceResult::select('date')->where('student_id',$student->id)->where('passed',true)->get()[0]["date"] : "" }}
		        		@endif
		        		@if($student->ielts != null)
		        		<li class="list-group-item">IELTS Score: {{ $student->ielts->score }}</li>
		        		@endif
		        		@if($student->toefl != null)
		        		<li class="list-group-item">TOEFL Score: {{ $student->toefl->score }}</li>
		        		@endif
	        		</ul>
	        	</div>
	        </div>
	        <ul class="list-group">
        		<li class="list-group-item">Topic: {{ $student->topic }}</li>
        	</ul>
        </div>
    </div>
</div>