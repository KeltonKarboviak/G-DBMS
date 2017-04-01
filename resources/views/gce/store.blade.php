@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Add a GCE Result</h2>
				</div>
				<div class="panel-body">

					{!! Form::model($gce, ['route' => ['gce.store_submit', $gce], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
						@include('gce/partials/_gce_addedit')
					{!! Form::close() !!}
				</div>
			</div>
 		</div>
	</div>
</div>
@endsection
