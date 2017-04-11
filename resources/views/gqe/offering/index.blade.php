<!-- resources/views/gqe/offering/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <nav class="col-md-3">
            <h3>Filters</h3>
            {!! Form::open(['method' => 'GET', 'class' => 'form-horiztonal']) !!}
                <div class="form-group">
                    {!! Form::label('sort_by', 'Sort By:') !!}
                    {!! Form::select('sort_by', $sort_options, $sort_by, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('semester_id', 'Semester:') !!}
                    {!! Form::select('semester_id[]', $semesters, $semester_id, ['id' => 'semester_id', 'class' => 'form-control', 'multiple']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('gqe_section_id', 'GQE Section:') !!}
                    {!! Form::select('gqe_section_id[]', $sections, $section_id, ['id' => 'gqe_section_id', 'class' => 'form-control', 'multiple']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Search', ['class' => 'btn btn-info']) !!}
                    {!! Form::button('Refresh', ['onclick' => 'parent.location="/gqe/offering"', 'class' => 'btn btn-warning']) !!}
                </div>
            {!! Form::close() !!}
            <h4>Results: {{ $offerings->count() }}</h4>
        </nav> <!-- /.col-md-3 Filters -->

        <div class="col-md-7">
            <div class="panel-group">

                @foreach ($offerings as $offering)
                    <div class="panel panel-primary">
                        <div class="panel-heading clearfix">
                            <div class="panel-title pull-left" style="padding-top: 4px;">
                                <a data-toggle="collapse" href="#collapse{{ $offering->id }}">
                                    {{ $offering->full_name }}
                                </a>
                            </div>
                            <div class="btn-group pull-right">
                                {!! Form::open(['method' => 'DELETE', 'route' => ['gqe_offering.delete', $offering], 'class' => 'form-horizontal', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                    <a href="{{ route('gqe_offering.update', $offering) }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="Edit">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    <button type="submit" class="btn btn-default btn-sm" data-toggle="tooltip" title="Delete">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div id="collapse{{ $offering->id }}" class="panel-collapse collapse">
                            <ul class="list-group">
                                <li class="list-group-item">GQE Section: {{ $offering->section->name }}</li>
                                <li class="list-group-item">Semester Offered: {{ $offering->semester->full_name }}</li>
                                <li class="list-group-item">Date: {{ $offering->date }}</li>
                                <li class="list-group-item">MS Cutoff Score: {{ $offering->cutoff_ms }}</li>
                                <li class="list-group-item">PhD Cutoff Score: {{ $offering->cutoff_phd }}</li>
                            </ul>
                        </div>
                    </div>
                @endforeach

            </div>
        </div> <!-- /.col-md-7 -->

        <!-- Affixed side nav for 'Add a GQE Offering' button -->
        <nav class="col-md-2">
        	<div data-spy="affix" data-offset-top="-1">
    			<a href="{{ url('/gqe/offering/add') }}" class="btn btn-success btn-lg">Add a GQE Offering</a>
        	</div>
    	</nav> <!-- /.col-md-2 -->

    </div>
</div>
@endsection
