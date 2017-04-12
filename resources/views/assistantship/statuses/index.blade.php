<!-- resources/views/assistantship/status/index.blade.php -->

@extends('layouts.app')

@section('content')
<?php $allowChanges = Auth::user()->role->name === 'Director'; ?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">Assistantship Statuses</h2>
                </div>
                <ul class="list-group">
                    @foreach ($statuses as $status)
                        <li class="list-group-item clearfix">
                            <div class="pull-left" style="padding-top: 4px;">
                                {{ $status->description }}
                            </div>
                            @if ($allowChanges)
                                <div class="btn-group pull-right">
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['status.delete', $status], 'class' => 'form-horizontal', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                        <a href="{{ route('status.update', $status) }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="Edit">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        <button type="submit" class="btn btn-default btn-sm" data-toggle="tooltip" title="Delete">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </button>
                                    {!! Form::close() !!}
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul> <!-- /.list-group -->
            </div> <!-- /.panel .panel-primary -->
        </div> <!-- /.col-md-2 .col-md-offset-5 -->

        <!-- Affixed side nav for 'Add a GQE Section' button -->
        @if($allowChanges)
            <nav class="col-md-2 col-md-offset-0">
            	<div data-spy="affix" data-offset-top="-1">
        			<a href="{{ url('/assistantship/status/add') }}" class="btn btn-success btn-lg">Add an Assistantship Status</a>
            	</div>
        	</nav> <!-- /.col-md-2 -->
        @endif

    </div>
</div>
@endsection
