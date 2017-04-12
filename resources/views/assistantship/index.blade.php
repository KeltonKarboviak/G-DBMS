@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		<nav class="col-md-3">
			<h3>Filters</h3>
				{!! Form::open(['method' => 'GET', 'route' => ['assistantship.index_filter'], 'class' => 'form-horizontal']) !!}
					<div class="form-group">
						{!! Form::label('sort_by', 'Sort By:') !!}
						{!! Form::select('sort_by', $sort_options, $sort_by, ['class' => 'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('first_name',"First Name:") !!}
						{!! Form::text('first_name', $first_name, ['class' => 'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('last_name',"Last Name:") !!}
						{!! Form::text('last_name', $last_name, ['class' => 'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('current_status_id',"Current Status:") !!}
						{!! Form::select('current_status_id[]', $statuses, $current_status_id, ['id' => 'current_status_id', 'class' => 'form-control', 'multiple']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('program_id',"Program:") !!}
						{!! Form::select('program_id[]', $programs, $program_id, ['id' => 'program_id', 'class' => 'form-control', 'multiple']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('semester_id',"Semester:") !!}
						{!! Form::select('semester_id[]', $semesters, $semester_id, ['id' => 'semester_id', 'class' => 'form-control', 'multiple']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('funding_source_id',"Funding Source:") !!}
						{!! Form::select('funding_source_id[]', $funding_sources, $funding_source_id, ['id' => 'funding_source_id', 'class' => 'form-control', 'multiple']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Search', ['class' => 'btn btn-info']) !!}
						{!! Form::button('Refresh', ['onClick' => "parent.location='/assistantship'", 'class' => 'btn btn-warning']) !!}
					</div>
				{!! Form::close() !!}
			<h4>Results: {{ count($assists) }}</h4>
		</nav>

		<div class="col-md-7">
            <div class="panel-group">

            	<?php $assist_count = 0; ?>
            	<div class="btn-group">
	            	<a class="btn btn-default" id="expand_all">Expand All</a>
	            	<a class="btn btn-default" id="collapse_all">Collapse All</a>
	            </div>

            	<!-- Start data for each student -->
            	@foreach($assists as $assist)
            		<?php $assist_count = $assist_count + 1; ?>
            		@include('assistantship/partials/_assistantship_info',['assist' => $assist, 'allowChanges' => true, 'assist_count' => $assist_count,])
            	@endforeach

            </div>
        </div>

		<!-- Affixed side nav for 'Add an Assistantship' button -->
        <nav class="col-md-2">
        	<div data-spy="affix" data-offset-top="-1">
    			<a href="{{ url('/assistantship/add') }}" class="btn btn-success btn-lg">Add an Assistantship</a>
        	</div>
    	</nav>

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
