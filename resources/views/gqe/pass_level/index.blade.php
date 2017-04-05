<!-- resources/views/gqe/pass_level/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">GQE Pass Levels</h2>
                </div>
                <ul class="list-group">
                    @foreach ($levels as $level)
                        <li class="list-group-item clearfix">
                            <div class="pull-left" style="padding-top: 4px;">
                                {{ $level->name }}
                            </div>
                            <div class="btn-group pull-right">
                                {!! Form::open(['method' => 'DELETE', 'route' => ['pass_level.delete', $level], 'class' => 'form-horizontal', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                    <a href="{{ route('pass_level.update', $level) }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="Edit">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    <button type="submit" class="btn btn-default btn-sm" data-toggle="tooltip" title="Delete">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                {!! Form::close() !!}
                            </div>
                        </li>
                    @endforeach
                </ul> <!-- /.list-group -->
            </div> <!-- /.panel .panel-primary -->
        </div> <!-- /.col-md-4 .col-md-offset-4 -->

        <!-- Affixed side nav for 'Add a GQE Pass Level' button -->
        <nav class="col-md-2 col-md-offset-2">
        	<div data-spy="affix" data-offset-top="-1">
    			<a href="{{ url('/gqe/passlevel/add') }}" class="btn btn-success btn-lg">Add a GQE Pass Level</a>
        	</div>
    	</nav> <!-- /.col-md-2 -->

    </div>
</div>
@endsection
