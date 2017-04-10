<!-- resources/views/tuition_waiver/store.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Add Tuition Waiver</h2>
                </div>
                <div class="panel-body">
                    {!! Form::model($waiver, ['route' => ['tuition_waiver.store_submit'], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
						@include('tuition_waiver/partials/_tuition_waiver_addedit', ['disabled' => false])
					{!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')