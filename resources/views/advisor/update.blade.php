@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Edit Advisor</h2>
				</div>
				<div class="panel-body">

					{!! Form::model($advisor, ['route' => ['advisor.update_submit', $advisor], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}
						@include('advisor/partials/_advisor_addedit')
					{!! Form::close() !!}
				</div>
			</div>
 		</div>
	</div>
</div>
@endsection
