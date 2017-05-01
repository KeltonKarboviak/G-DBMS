<!-- resources/views/gqe/result/store.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-und">
                <div class="panel-heading">
                    <h2 class="panel-title">Add GQE Result</h2>
                </div>
                <div class="panel-body">
                    {!! Form::model($result, ['route' => ['gqe_result.store_submit'], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
						@include('gqe/result/partials/_result_addedit', ['disabled' => false])
					{!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')