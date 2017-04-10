<!-- resources/views/tuition_waiver/update.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Edit Tuition Waiver</h2>
                </div>
                <div class="panel-body">
                    {!! Form::model($waiver, ['route' => ['tuition_waiver.update_submit', $waiver], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}
						@include('tuition_waiver/partials/_tuition_waiver_addedit', [
						    'students' => [$waiver->student_id => $waiver->student->full_name],
						    'semesters' => [$waiver->semester_id => $waiver->semester->full_name],
                            'disabled' => true,
						])
					{!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')
