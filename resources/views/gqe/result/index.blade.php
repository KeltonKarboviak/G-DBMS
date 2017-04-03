<!-- resources/views/gqe/result/index.blade.php -->

@extends('layouts.app')

@section('styles')
<style>
    .table > tbody > tr > td > div:nth-child(even) {
        /*color: red;*/
        /*border-top: 1px dashed black;
        border-bottom: 1px dashed black;*/
        /*margin-top: 3px;
        margin-bottom: 3px;*/
    }

    th {
        text-align: center;
    }

    .table > thead > tr > th,
    .table > tbody > tr > td {
        padding: 0;
    }

    span.glyphicon-remove {
        color: red;
    }

    span.glyphicon-ok {
        color: green;
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
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">

        <nav class="col-md-3">
            <h3>Filters</h3>
            <h4>Results: {{ $students->count() }}</h4>
        </nav>

        <div class="col-md-9">

            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead>
                        <tr>
                            <th>Student</th>

                            @foreach ($sections as $section)
                                <th>{{ $section->name }}</th>
                            @endforeach

                            <th>Finished?</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>
                                    <div>{{ $student->full_name }}</div>
                                    <div>{{ $student->id }}</div>
                                    <div>{{ $student->current_program->program->name }}</div>
                                </td>

                                <?php
                                    $section_results = $student
                                        ->gqe_results->sortBy(function ($result) {
                                            return sprintf('%-12s%s', $result->offering->gqe_section_id, $result->offering->date);
                                        })
                                        ->values()
                                        ->groupBy(function ($result) {
                                            return $result->offering->section->id;
                                        });

                                    $pass_level_needed = $student->program->pass_level_needed_id;

                                    $finished_gqes = $section_results->sum(function ($section) use ($pass_level_needed) {
                                        return $section->contains(function ($index, $result) use ($pass_level_needed) {
                                            return $result->pass_level_id >= $pass_level_needed;
                                        });
                                    });
                                ?>

                                @foreach ($sections as $section)
                                    <td>
                                        <?php $results = !$section_results->isEmpty() ? $section_results[$section->id] : []; ?>
                                        @foreach ($results as $result)
                                            <div class="
                                            {{ $result->pass_level_id === null
                                                ? 'warning'
                                                : ($result->pass_level_id >= $pass_level_needed
                                                    ? 'success'
                                                    : 'danger')
                                            }}">
                                                {{ sprintf("%.2f  (%s)", $result->score, $result->pass_level !== null ? $result->pass_level->name : 'N/A') }}
                                            </div>
                                        @endforeach
                                    </td>
                                @endforeach

                                <td>
                                    <span class="glyphicon glyphicon-{{ $finished_gqes >= $student->program->gqes_needed ? 'ok' : 'remove' }}"></span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
@endsection
