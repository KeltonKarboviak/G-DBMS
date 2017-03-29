@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Advisor Information</h2>
				</div>
				<div class="panel-body">
		        	<ul class="list-group">
		        		<li class="list-group-item">Name: {{ $advisor->first_name . " " . $advisor->last_name }}</li>
		        		<li class="list-group-item">EMPLID: {{ $advisor->id }}</li>
		        		<li class="list-group-item">Email: <a href="mailto:{{ $advisor->email }}">{{ $advisor->email }} <span class="glyphicon glyphicon-envelope"></span></a></li>
		        	</ul>
			        <h3>Students advised</h3>
			        <!-- Start data for each student -->
			        <?php $count = 0?>
			        <div class="panel-group">
		            	@foreach ($students as $student)
		            		<?php $count = $count+1; ?>
		            		@include('student/partials/_student_info',['student' => $student, 'fromAdvisor' => true, 'allowChanges' => false])
		            	@endforeach
	            	</div>
				</div>
			</div>
 		</div>
	</div>
</div>
@endsection
