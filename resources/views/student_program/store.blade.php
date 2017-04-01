@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Add Program to Student</h2>
				</div>
				<div class="panel-body">

					{!! Form::model($student_program, ['route' => ['student_program.store_submit', $student_program], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
						@include('student_program/partials/_student_program_addedit')
					{!! Form::close() !!}
				</div>
			</div>
 		</div>
	</div>
</div>
@endsection
