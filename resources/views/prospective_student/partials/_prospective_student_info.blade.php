<?php $showRank = isset($showRank) ? $showRank : false; ?>
<?php $sort_by = isset($sort_by) ? $sort_by : false; ?>

<div class="panel panel-primary">
  	<div class="panel-heading clearfix">
  		<div class="panel-title pull-left" style="padding-top: 4px;">
  			<a data-toggle="collapse" href="#collapse_outer{{ $student->id }}">
  				{{ $sort_by === 'first_name' ? $student->full_name : $student->proper_name }}
  			</a>
  		</div>

  		@if($allowChanges)
      		<div class="btn-group pull-right">
				@if($showRank)
      				<a data-toggle="collapse" href="#collapse_outer{{ $student->id }}" class="bg-primary btn btn-primary btn-sm">Rank: {{ $student->ranking }}</a>
      			@endif
      			<div class="btn-group">
	      			{!! Form::open(['method' => 'POST', 'route' => ['prospective_student.promote', $student], 'class' => 'form-horizontal', 'onsubmit' => 'return ConfirmMessage("Are you sure you want to promote this student? Promoting them will remove all GRE, IELTS, and TOEFL scores, as these are only used for ranking prospective students.")']) !!}
	      				{!! Form::button('Promote', ['type' => 'submit', 'class' => 'btn btn-default btn-sm', 'data-toggle' => 'tooltip', 'title' => 'Promote to full student']) !!}
	      			{!! Form::close() !!}
      			</div>
      			<div class="btn-group">
	      			{!! Form::open(['method' => 'DELETE', 'route' => ['prospective_student.delete', $student], 'class' => 'form-horizontal', 'onsubmit' => 'return ConfirmDelete()']) !!}
	      				<div class="btn-group">
			      			<a href="{{ url('/prospective_student/' . $student->id) }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
	      					{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-default btn-sm', 'data-toggle' => 'tooltip', 'title' => 'Delete']) !!}
	      				</div>
	      			{!! Form::close() !!}
      			</div>
      		</div>
      	@endif
		</div>
  	<div id="collapse_outer{{ $student->id }}" class="panel-collapse collapse">
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
        </div>
    </div>
</div>