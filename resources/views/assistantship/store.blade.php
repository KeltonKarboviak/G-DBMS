@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-und">
				<div class="panel-heading">
					<h2 class="panel-title">Add an Assistantship</h2>
				</div>
				<div class="panel-body">

					{!! Form::model($assist, ['route' => ['assistantship.store_submit', $assist], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
						@include('assistantship/partials/_assistantship_addedit')
					{!! Form::close() !!}
				</div>
			</div>
 		</div>
	</div>
</div>
@endsection
