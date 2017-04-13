@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Edit Student</h2>
				</div>
				<div class="panel-body">

					{!! Form::model($student, ['route' => ['student.update_submit', $student], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}
						@include('student/partials/_student_addedit')
					{!! Form::close() !!}
				</div>
			</div>
 		</div>

 		<div class="col-md-1">
 			{!! Form::open(['method' => 'POST', 'route' => ['prospective_student.demote', $student], 'class' => 'form-horizontal', 'onsubmit' => 'return ConfirmMessage("Are you sure you want to demote this student?")']) !!}
  				{!! Form::button('Demote Student to Prospective', ['type' => 'submit', 'class' => 'btn btn-default btn-lg btn-danger',]) !!}
  			{!! Form::close() !!}
 		</div>
	</div>
</div>
@endsection
