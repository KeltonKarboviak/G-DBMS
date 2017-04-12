<!-- resources/views/gqe/result/index.blade.php -->

@extends('layouts.app')

@section('styles')
<style>
    th {
        text-align: center;
    }

    .table > thead > tr > th,
    .table > tbody > tr > td {
        padding: 0;
    }

    .table > tbody > tr > td > div.success,
    .table > tbody > tr.success > td,
    .table > tbody > tr.success > th,
    .table > tbody > tr > td.success,
    .table > tbody > tr > th.success,
    .table > tfoot > tr.success > td,
    .table > tfoot > tr.success > th,
    .table > tfoot > tr > td.success,
    .table > tfoot > tr > th.success,
    .table > thead > tr.success > td,
    .table > thead > tr.success > th,
    .table > thead > tr > td.success,
    .table > thead > tr > th.success {
        color: #3c763d;
        background-color: #dff0d8;
        border: 1px solid #d6e9c6;
    }

    .table > tbody > tr > td > div.danger,
    .table > tbody > tr.danger > td,
    .table > tbody > tr.danger > th,
    .table > tbody > tr > td.danger,
    .table > tbody > tr > th.danger,
    .table > tfoot > tr.danger > td,
    .table > tfoot > tr.danger > th,
    .table > tfoot > tr > td.danger,
    .table > tfoot > tr > th.danger,
    .table > thead > tr.danger > td,
    .table > thead > tr.danger > th,
    .table > thead > tr > td.danger,
    .table > thead > tr > th.danger {
        color: #a94442;
        background-color: #f2dede;
        border: 1px solid #ebccd1;
    }

    .table > tbody > tr > td > div.info,
    .table > tbody > tr.info > td,
    .table > tbody > tr.info > th,
    .table > tbody > tr > td.info,
    .table > tbody > tr > th.info,
    .table > tfoot > tr.info > td,
    .table > tfoot > tr.info > th,
    .table > tfoot > tr > td.info,
    .table > tfoot > tr > th.info,
    .table > thead > tr.info > td,
    .table > thead > tr.info > th,
    .table > thead > tr > td.info,
    .table > thead > tr > th.info {
        color: #31708f;
        background-color: #d9edf7;
        border: 1px solid #bce8f1;
    }

    .table > tbody > tr > td > div.warning,
    .table > tbody > tr.warning > td,
    .table > tbody > tr.warning > th,
    .table > tbody > tr > td.warning,
    .table > tbody > tr > th.warning,
    .table > tfoot > tr.warning > td,
    .table > tfoot > tr.warning > th,
    .table > tfoot > tr > td.warning,
    .table > tfoot > tr > th.warning,
    .table > thead > tr.warning > td,
    .table > thead > tr.warning > th,
    .table > thead > tr > td.warning,
    .table > thead > tr > th.warning {
        color: #8a6d3b;
        background-color: #fcf8e3;
        border: 1px solid #faebcc;
    }

    .modal-body {
        text-align: left;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">

        <nav class="col-md-3">
            <h3>Filters</h3>
            {!! Form::open(['method' => 'GET', 'url' => url('gqe/result'), 'class' => 'form-horiztonal']) !!}
                <div class="form-group">
                    {!! Form::label('sort_by', 'Sort By:') !!}
                    {!! Form::select('sort_by', $sort_options, $sort_by, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('current_students', 'Current Students:') !!}
                    {!! Form::select('current_students[]', $current_students_choices, $current_students_choice, ['id' => 'current_students', 'class' => 'form-control', 'multiple']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('semester_id', 'Semester:') !!}
                    {!! Form::select('semester_id[]', $semesters, $semester_id, ['id' => 'semester_id', 'class' => 'form-control', 'multiple']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('gqe_section_id', 'GQE Section:') !!}
                    {!! Form::select('gqe_section_id[]', $sections, $gqe_section_id, ['id' => 'gqe_section_id', 'class' => 'form-control', 'multiple']) !!}
                </div>

                <div class="form-group">
					{!! Form::submit('Search', ['class' => 'btn btn-info']) !!}
					{!! Form::button('Refresh', ['onClick' => "parent.location='/gqe/result'", 'class' => 'btn btn-warning']) !!}
				</div>
            {!! Form::close() !!}
            <h4>Results: {{ $students->count() }}</h4>
        </nav>

        <div class="col-md-7">

            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead>
                        <tr class="bg-primary">
                            <th>Student</th>

                            @foreach ($sections as $section_id => $section_name)
                                <th>{{ $section_name }}</th>
                            @endforeach

                            @if (!$display_aggs) <!-- If user is not filtering GQE Sections -->
                                <th>Finished?</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>
                                    <div>{{ $student->full_name }}</div>
                                    <div>{{ $student->id }}</div>
                                    <div>{{ $student->programs->last()->program->name }}</div>
                                </td>

                                <?php
                                    $section_results = $student
                                        ->gqe_results->sortBy(function ($result) {
                                            return sprintf('%-12s%s', $result->offering->gqe_section_id, $result->offering->date);
                                        })
                                        ->values()
                                        ->groupBy(function ($result) {
                                            return $result->offering->gqe_section_id;
                                        });

                                    $pass_level_needed = $student->programs->last()->program->pass_level_needed_id;

                                    $finished_gqes = $section_results->sum(function ($section) use ($pass_level_needed) {
                                        return $section->contains(function ($index, $result) use ($pass_level_needed) {
                                            return $result->pass_level_id >= $pass_level_needed;
                                        });
                                    });
                                ?>

                                @foreach ($sections as $section_id => $section_name)
                                    <td>
                                        <?php $results = $section_results->get($section_id, []); ?>
                                        @foreach ($results as $result)
                                            <div data-toggle="modal" data-target="#modal_{{ $result->student_id }}_{{ $result->offer_id }}" data-backdrop="static"
                                                class="{{ $result->pass_level_id === null
                                                    ? 'warning'
                                                    : ($result->pass_level_id >= $pass_level_needed
                                                        ? 'success'
                                                        : 'danger') }}">
                                                {{ sprintf("%.2f  (%s)", $result->score, $result->pass_level !== null ? $result->pass_level->name : 'Pending') }}
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modal_{{ $result->student_id }}_{{ $result->offer_id }}" role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content -->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">{{ "{$student->full_name}'s GQE Result for {$result->offering->full_name}" }}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <form class="form-horizontal">
                                                                        <div class="form-group">
                                                                            <label class="col-md-6 control-label">GQE Section:</label>
                                                                            <div class="col-md-6">
                                                                                <p class="form-control-static">{{ $result->offering->section->name }}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-md-6 control-label">Semester Taken:</label>
                                                                            <div class="col-md-6">
                                                                                <p class="form-control-static">{{ $result->offering->semester->full_name }}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-md-6 control-label">Date:</label>
                                                                            <div class="col-md-6">
                                                                                <p class="form-control-static">{{ $result->offering->date }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <form class="form-horizontal">
                                                                        <div class="form-group">
                                                                            <label class="col-md-6 control-label">Score Received:</label>
                                                                            <div class="col-md-6">
                                                                                <p class="form-control-static">{{ sprintf("%.2f", $result->score) }}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-md-6 control-label">Pass Level:</label>
                                                                            <div class="col-md-6">
                                                                                <p class="form-control-static">{{ $result->pass_level !== null ? $result->pass_level->name : 'Pending' }}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-md-6 control-label">MS Cutoff Score:</label>
                                                                            <div class="col-md-6">
                                                                                <p class="form-control-static">{{ $result->offering->cutoff_ms }}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-md-6 control-label">PhD Cutoff Score:</label>
                                                                            <div class="col-md-6">
                                                                                <p class="form-control-static">{{ $result->offering->cutoff_phd }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['gqe_result.delete', $student, $result->offering], 'class' => 'form-horizontal', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                            <div class="btn-group">
                                                                <a href="{{ route('gqe_result.update', [$student->id, $result->offering->id]) }}" class="btn btn-default" data-toggle="tooltip" title="Edit">
                                                                    <span class="glyphicon glyphicon-edit"></span>
                                                                </a>
                                                                <button type="submit" class="btn btn-default" data-toggle="tooltip" title="Delete">
                                                                    <span class="glyphicon glyphicon-trash"></span>
                                                                </button>
                                                            </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div><!-- /.modal -->
                                        @endforeach <!-- /foreach ($results as $result) -->
                                    </td>
                                @endforeach <!-- /foreach ($sections as $section) -->

                                @if (!$display_aggs) <!-- If user is not filtering GQE Sections -->
                                    <td>
                                        <span class="glyphicon glyphicon-{{ $finished_gqes >= $student->programs->last()->program->gqes_needed ? 'ok' : 'remove' }}"></span>
                                    </td>
                                @endif
                            </tr>
                        @endforeach <!-- /foreach ($students as $student) -->
                    </tbody>
                    @if ($display_aggs)
                        <tfoot>
                            @foreach (['max', 'min', 'avg', 'total'] as $agg)
                                <tr class="bg-primary">
                                    <th>{{ $agg }}</th>

                                    @foreach ($sections as $section_id => $section_name)
                                        <th>{{ sprintf('%.2f', $aggregates[$section_id][$agg]) }}</th>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tfoot>
                    @endif
                </table>
            </div> <!-- /.table-responsive -->

        </div> <!-- /.col-md-7 -->

        <!-- Affixed side nav for 'Add a GQE Result' button -->
        <nav class="col-md-2">
        	<div data-spy="affix" data-offset-top="-1">
    			<a href="{{ url('/gqe/result/add') }}" class="btn btn-success btn-lg">Add a GQE Result</a>
        	</div>
    	</nav> <!-- /.col-md-2 -->

    </div>
</div>
@endsection
