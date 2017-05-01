<!-- resources/views/gqe/section/store.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-und">
                <div class="panel-heading">
                    <h2 class="panel-title">Add an Assistantship Position</h2>
                </div>
                <div class="panel-body">
                    {!! Form::model($position, ['route' => ['position.store_submit'], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                        @include('assistantship/positions/partials/_position_addedit')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
