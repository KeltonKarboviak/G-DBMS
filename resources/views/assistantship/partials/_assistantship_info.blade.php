<div class="panel panel-primary">
  	<div class="panel-heading clearfix">
  		<div class="panel-title pull-left" style="padding-top: 4px;">
  				<a data-toggle="collapse" href="#collapse_outer{{ $assist->id }}">{{ $assist->student->full_name . ' - ' . $assist->position . ' - ' . $assist->semester->full_name}}</a>
  		</div>

  		@if ($allowChanges)
	  		{!! Form::open(['method' => 'DELETE', 'route' => ['assistantship.delete', $assist], 'class' => 'form-horizontal', 'onsubmit' => 'return ConfirmDelete()']) !!}
	      		<div class="btn-group pull-right">
	      			<a href="{{ route('assistantship.update', $assist->id) }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
	      			{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-default btn-sm', 'data-toggle' => 'tooltip', 'title' => 'Delete']) !!}
	      		</div>
	      	{!! Form::close() !!}
      	@endif
	</div>
  	<div id="collapse_outer{{ $assist->id }}" class="panel-collapse collapse }}">
  		<div class="panel-body">
      		<div class="row">
      			<div class="col-md-6">
		        	<ul class="list-group">
		        		<li class="list-group-item">Date Offered: {{ $assist->date_offered }}</li>
		        		<li class="list-group-item">Date Deferred: {{ $assist->defer_date }}</li>
		        		<li class="list-group-item">Stipend: {{ $assist->stipend }}</li>
                <li class="list-group-item">Time: {{ $assist->time }}</li>
		        	</ul>
	        	</div>
	        	<div class="col-md-6">
	        		<ul class="list-group">
		        		<li class="list-group-item">Date Responded: {{ $assist->date_responded }}</li>
		        		<li class="list-group-item">Current Status: {{ $assist->status->description }}</li>
		        		<li class="list-group-item">Funding Source: {{ $assist->funding_source->name }}</li>
		        	</ul>
	        	</div>
	        </div>
	        @if($assist->corresponding_waiver != null)
	        	<ul class='list-group'>
      				<li class="list-group-item">Tuition Waiver: {{ $assist->corresponding_waiver->credit_hours }} credits</li>
      			</ul>
      		@endif
          @if($assist->gta_assignment != null)
            <div class='panel panel-info'>
              <div class='panel-heading'>GTA Assignment:</div>
<!--               <div class='panel-body' style="padding-bottom">
                <div class="row">
                  <div class="col-md-6"> -->
                    <ul class="list-group">
                      <li class="list-group-item">Course: {{ $assist->gta_assignment->course }}</li>                
                    <!-- </ul> -->
                  <!-- </div> -->
                  <!-- <div class="col-md-6"> -->
                    <!-- <ul class="list-group"> -->
                      <li class="list-group-item">Instructor: {{ $assist->gta_assignment->instructor->proper_name }}</li>
                    </ul>
                  <!-- </div> -->
<!--                 </div>
              </div> -->
            </div>
          @endif
        </div>
    </div>
</div>