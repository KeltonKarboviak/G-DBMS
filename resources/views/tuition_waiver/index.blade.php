<!-- resources/views/tuition_waiver/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <nav class="col-md-3">
            <h3>Filters</h3>
            <h4>Results: {{ $waivers->count() }}</h4>
        </nav>

        <div class="col-md-7">
            <div class="panel-group">

                @foreach ($waivers as $waiver)
                    <div class="panel panel-primary">
                        <div class="panel-heading clearfix">
                            <div class="panel-title pull-left" style="padding-top: 4px;">
                                <a data-toggle="collapse" href="#collapse{{ $waiver->id }}">
                                    {{ $waiver->description }}
                                </a>
                            </div>
                            <div class="btn-group pull-right">
                                {!! Form::open(['method' => 'DELETE', 'route' => ['tuition_waiver.delete', $waiver], 'class' => 'form-horizontal', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                    <a href="{{ route('tuition_waiver.update', $waiver) }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="Edit">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    <button type="submit" class="btn btn-default btn-sm" data-toggle="tooltip" title="Delete" >
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div id="collapse{{ $waiver->id }}" class="panel-collapse collapse">
                            <ul class="list-group">
                                <li class="list-group-item">Date Received: {{ $waiver->date_received }}</li>
                                <li class="list-group-item">Amount Received: {{ $waiver->amount_received }}</li>
                                <li class="list-group-item">Credit Hours: {{ $waiver->credit_hours }}</li>
                                <li class="list-group-item">Funding Source: {{ $waiver->funding_source->name }}</li>
                                <li class="list-group-item{{ !$waiver->received ? ' list-group-item-warning' : '' }}">
                                    Received: {{ $waiver->received ? "Yes" : "No" }}
                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach

            </div> <!-- /.panel-group -->
        </div> <!-- /.col-md-7 -->

        <!-- Affixed side nav for 'Add a Tuition Waiver' button -->
        <nav class="col-md-2">
        	<div data-spy="affix" data-offset-top="-1">
    			<a href="{{ url('/waiver/add') }}" class="btn btn-success btn-lg">Add a Tuition Waiver</a>
        	</div>
    	</nav> <!-- /.col-md-2 -->

    </div>
</div>
@endsection
