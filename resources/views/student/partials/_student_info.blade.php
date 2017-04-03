<?php $showRank = isset($showRank) ? $showRank : false; ?>
<?php $sort_by = isset($sort_by) ? $sort_by : false; ?>

<div class="panel panel-primary">
  	<div class="panel-heading clearfix">
  		<div class="panel-title pull-left" style="padding-top: 4px;">
  			@if($sort_by === 'first_name')
  				<a data-toggle="collapse" href="#collapse{{ $count }}">{{ $student->first_name . " " . $student->last_name }}</a>
  			@else
  				<a data-toggle="collapse" href="#collapse{{ $count }}">{{ $student->last_name . ", " . $student->first_name }}</a>
  			@endif
  		</div>
  		
  		@if($allowChanges)
  		{!! Form::open(['method' => 'DELETE', 'route' => ['student.delete', $student], 'class' => 'form-horizontal', 'onsubmit' => 'return ConfirmDelete()']) !!}
      		<div class="btn-group pull-right">
      			@if($showRank)
      				<a data-toggle="collapse" href="#collapse{{ $count }}" class="bg-primary btn btn-primary btn-sm">Rank: {{ $student->ranking }}</a>
      			@endif
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
		        		@if($student->gre != null)
		        		<li class="list-group-item">GRE Score: {{ $student->gre->score }}</li>
		        		@endif
		        	</ul>
	        	</div>
	        	<div class="col-md-6">
	        		<ul class="list-group">
	        			<li class="list-group-item">Undergrad GPA: {{ $student->undergrad_gpa }}</li>
		        		<li class="list-group-item">Faculty Sponsored: {{ $student->faculty_supported ? "Yes" : "No" }}</li>
		        		@if($student->ielts != null)
		        		<li class="list-group-item">IELTS Score: {{ $student->ielts->score }}</li>
		        		@endif
		        		@if($student->toefl != null)
		        		<li class="list-group-item">TOEFL Score: {{ $student->toefl->score }}</li>
		        		@endif
	        		</ul>
	        	</div>
	        </div>
	        <?php $spcount = 0; ?>
	        <h4>Programs: @if($allowChanges)<a href="{{ url('/student_program/add/' . $student->id) }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="Add a program for this student"><span class="glyphicon glyphicon-plus"></span></a>@endif </h4>
	        @foreach($student->programs as $stud_prog)
	        	<?php $spcount = $spcount + 1; ?>
	        	@include('student_program/partials/_student_program_info', ['student_program' => $stud_prog,
	        		'fromAdvisor' => $fromAdvisor, 'allowChanges' => $allowChanges, 
	        		'stud_prog_count' => $count . '_' . $spcount])
	        @endforeach

	        @if($student->gce_results->count() > 0)
	        	<h4>GCEs</h4>
	        	@foreach($student->gce_results as $gce)
	        		@include('gce/partials/_gce_info',['gce' => $gce, 'allowChanges' => $allowChanges])
	        	@endforeach
	        @endif
        </div>
    </div>
</div>