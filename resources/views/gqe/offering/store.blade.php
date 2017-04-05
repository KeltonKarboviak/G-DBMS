<!-- resources/views/gqe/offering/store.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Add GQE Offering</h2>
                </div>
                <div class="panel-body">
                    {!! Form::model($offering, ['route' => ['gqe_offering.store_submit'], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
						@include('gqe/offering/partials/_offering_addedit')
					{!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')
