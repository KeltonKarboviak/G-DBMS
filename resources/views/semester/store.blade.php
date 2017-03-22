@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Add a Semester</h2>
				</div>
				<div class="panel-body">
					{!! Form::open(['method' => 'POST', 'route' => ['semester.store_submit',$semester]]) !!}
						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							{!! Form::label('name', 'Name:', ['class' => 'col-md-4 control-label']) !!}

							<div class="col-md-6">
								{!! Form::select('name', $names, null, ['class' => 'form-control']) !!}

								@if ($errors->has('name'))
									<span class="help-block">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('calendar_year') ? ' has-error' : '' }}">
							{!! Form::label('calendar_year', 'Calendar Year:', ['class' => 'col-md-4 control-label']) !!}

							<div class="col-md-6">
								{!! Form::number('calendar_year', null, ['class' => 'form-control']) !!}

								@if ($errors->has('calendar_year'))
									<span class="help-block">
										<strong>{{ $errors->first('calendar_year') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('academic_year') ? ' has-error' : '' }}">
							{!! Form::label('academic_year', 'Academic Year:', ['class' => 'col-md-4 control-label']) !!}

							<div class="col-md-6">
								{!! Form::text('academic_year', null, ['class' => 'form-control','readonly']) !!}

								@if ($errors->has('academic_year'))
									<span class="help-block">
										<strong>{{ $errors->first('academic_year') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="btn-group">
						       	{!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
								{!! Form::button('Cancel', ['onClick' => "parent.location='" . session()->pull('previousURL','/home') . "'", 'class' => 'btn btn-danger']) !!} 
						        </div>
						    </div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
 		</div>
	</div>
</div>
@endsection

@section('scripts')
	<script>
	$(document).ready(function(){
		$("input[name=calendar_year], select[name=name]").change(function(){
			var year = parseInt($("input[name=calendar_year]").val());
			// console.log(year);
			if($("select[name=name]").val() === "Fall")
			{
				$("input[name=academic_year]").val(year);
			}
			else
			{
				$("input[name=academic_year]").val(year-1);
				// $("input[name=academic_year]").val($("input[name=name]").val());
			}
		});
	});
	</script>
@endsection