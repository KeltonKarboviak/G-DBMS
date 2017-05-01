@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-und">
				<div class="panel-heading">
					<h2 class="panel-title">Edit Student's Program Info</h2>
				</div>
				<div class="panel-body">
					{!! Form::model($student_program, ['route' => ['student_program.update_submit', $student_program], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}
						@include('student_program/partials/_student_program_addedit', ['needs_committee' => $needs_committee])
					{!! Form::close() !!}
				</div>
			</div>
 		</div>
	</div>
</div>
@endsection
