<!-- resources/views/gqe/offering/update.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Edit GQE Offering</h2>
                </div>
                <div class="panel-body">
                    {!! Form::model($offering, ['route' => ['gqe_offering.update_submit', $offering], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}
						@include('gqe/offering/partials/_offering_addedit')
					{!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')
