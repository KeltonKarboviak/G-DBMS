<ul class="list-group">
  <li class="list-group-item clearfix">
  		<div class="pull-left" style="padding-top: 4px;">
  				<text>Date: {{ $gce->date }}</text>
  				<text> - {{ $gce->passed ? 'Passed' : 'Failed'}}</text>
  		</div>
  		
  		@if($allowChanges)
  		{!! Form::open(['method' => 'DELETE', 'route' => ['gce.delete', $gce], 'class' => 'form-horizontal', 'onsubmit' => 'return ConfirmDelete()']) !!}
      		<div class="btn-group pull-right">
      			<a href="{{ url('/gce/' . $gce->id) }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
      			{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-default btn-sm', 'data-toggle' => 'tooltip', 'title' => 'Delete']) !!}
      		</div>
      	{!! Form::close() !!}
      	@endif
	</li>
</ul>