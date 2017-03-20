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

					{!! Form::model($student, ['route' => ['student.update', $student], 'class' => 'form-horizontal']) !!}
						@include('student/partials/_student_info')
					{!! Form::close() !!}
				</div>
			</div>
 		</div>
	</div>
</div>
@endsection
