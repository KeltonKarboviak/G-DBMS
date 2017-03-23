@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
            <div class="panel-group">

            	<?php $count = 0; ?>

            	<!-- Start data for each advisor -->
            	@foreach ($advisors as $advisor)
            		<?php $count = $count+1; ?>

            		<div class="panel panel-primary">
				      	<div class="panel-heading clearfix">
				      		<div class="panel-title pull-left" style="padding-top: 4px;">
				      			<a data-toggle="collapse" href="#collapse{{ $count }}">{{ $advisor->last_name . ", " . $advisor->first_name }}</a>
				      		</div>
				      		{!! Form::open(['method' => 'DELETE', 'route' => ['advisor.delete', $advisor], 'class' => 'form-horizontal', 'onsubmit' => 'return ConfirmDelete()']) !!}
					      		<div class="btn-group pull-right">
					      			<a href="{{ url('/advisor/' . $advisor->id) }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
					      			{!! Form::button('<i class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-default btn-sm']) !!}
					      		</div>
					      	{!! Form::close() !!}
			      		</div>
				      	<div id="collapse{{ $count }}" class="panel-collapse collapse">
				      		<div class="panel-body">
					      		<div class="row">
					      			<!-- <div class="col-md-6"> -->
							        	<ul class="list-group">
							        		<li class="list-group-item">EMPLID: {{ $advisor->id }}</li>
							        		<li class="list-group-item">Email: <a href="mailto:{{ $advisor->email }}">{{ $advisor->email }} <span class="glyphicon glyphicon-envelope"></span></a></li>
						        		</ul>
						        	<!-- </div> -->
						        </div>
					        </div>
					    </div>
				    </div>
            	@endforeach
            </div>
        </div>

        <!-- Affixed side nav for 'Add a Student' button -->
        <nav class="col-md-3">
        	<div data-spy="affix" data-offset-top="0">
        		<ul class="nav nav-pills nav-stacked">
        			<li><a href="{{ url('/advisor/add') }}" class="btn btn-success btn-lg">Add an Advisor</a></li>
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
	  if (x)
	    return true;
	  else
	    return false;
  }

</script>
@endsection