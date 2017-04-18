@extends('layouts.app')

@section('content')
<?php $allowChanges = Auth::user()->role->name == 'Director'; ?>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
            <div class="panel-group">

            	<!-- Start data for each advisor -->
            	@foreach ($advisors as $advisor)
            		<div class="panel panel-primary">
				      	<div class="panel-heading clearfix">
				      		<div class="panel-title pull-left" style="padding-top: 4px;">
				      			<a data-toggle="collapse" href="#collapse_outer{{ $advisor->id }}">{{ $advisor->last_name . ", " . $advisor->first_name }}</a>
				      		</div>
				      		{!! Form::open(['method' => 'DELETE', 'route' => ['advisor.delete', $advisor], 'class' => 'form-horizontal', 'onsubmit' => 'return ConfirmDelete()']) !!}
					      		<div class="btn-group pull-right">
					      			<a href="{{ url('/advisor/info/' . $advisor->id) }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="Detailed Info"><span class="glyphicon glyphicon-info-sign"></span></a>
					      			@if($allowChanges)
						      			<a href="{{ url('/advisor/' . $advisor->id) }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
						      			{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-default btn-sm', 'data-toggle' => 'tooltip', 'title' => 'Delete']) !!}
					      			@endif
					      		</div>
					      	{!! Form::close() !!}
			      		</div>
				      	<div id="collapse_outer{{ $advisor->id }}" class="panel-collapse collapse">
				        	<ul class="list-group">
				        		<li class="list-group-item">EMPLID: {{ $advisor->id }}</li>
				        		<li class="list-group-item">Email: <a href="mailto:{{ $advisor->email }}">{{ $advisor->email }} <span class="glyphicon glyphicon-envelope"></span></a></li>
			        		</ul>
					    </div>
				    </div>
            	@endforeach
            </div>
        </div>

        <!-- Affixed side nav for 'Add a Student' button -->
        @if($allowChanges)
	        <nav class="col-md-3">
	        	<div data-spy="affix" data-offset-top="-1">
	        		<ul class="nav nav-pills nav-stacked">
	        			<li><a href="{{ url('/advisor/add') }}" class="btn btn-success btn-lg">Add an Advisor</a></li>
	        		</ul>
	        	</div>
	    	</nav>
    	@endif

	</div>
</div>
@endsection
