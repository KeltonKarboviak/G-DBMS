<!-- resources/views/funding_source/index.blade.php -->

@extends('layouts.app')

@section('content')
<?php $allowChanges = Auth::user()->role->name === 'Director'; ?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">Funding Sources</h2>
                </div>
                <ul class="list-group">
                    @foreach ($sources as $source)
                        <li class="list-group-item clearfix">
                            <div class="pull-left" style="padding-top: 4px;">
                                {{ $source->name }}
                            </div>
                            @if ($allowChanges)
                                <div class="btn-group pull-right">
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['funding_source.delete', $source], 'class' => 'form-horizontal', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                        <a href="{{ route('funding_source.update', $source) }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="Edit">
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

        @if ($allowChanges)
            <!-- Affixed side nav for 'Add a Funding Source' button -->
            <nav class="col-md-2 col-md-offset-1">
            	<div data-spy="affix" data-offset-top="-1">
        			<a href="{{ url('/source/add') }}" class="btn btn-success btn-lg">Add a Funding Source</a>
            	</div>
        	</nav> <!-- /.col-md-2 -->
        @endif

    </div>
</div>
@endsection
