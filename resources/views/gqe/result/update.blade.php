<!-- resources/views/gqe/result/update.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Edit GQE Result</h2>
                </div>
                <div class="panel-body">
                    {!! Form::model($result, ['route' => ['gqe_result.update_submit', $result->student_id, $result->offer_id], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}
						@include('gqe/result/partials/_result_addedit', [
						    'students' => [$result->student_id => $result->student->full_name],
						    'offerings' => [$result->offer_id => $result->offering->full_name],
						    'disabled' => true,
						])
					{!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')