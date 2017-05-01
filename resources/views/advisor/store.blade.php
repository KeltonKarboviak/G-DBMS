@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-und">
				<div class="panel-heading">
					<h2 class="panel-title">Add Advisor</h2>
				</div>
				<div class="panel-body">

					{!! Form::model($advisor, ['route' => ['advisor.store_submit', $advisor], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
						@include('advisor/partials/_advisor_addedit')
					{!! Form::close() !!}
				</div>
			</div>
 		</div>
	</div>
</div>
@endsection
