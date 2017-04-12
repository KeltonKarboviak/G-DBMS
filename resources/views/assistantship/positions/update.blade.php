<!-- resources/views/gqe/section/update.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Update Assistantship Position</h2>
                </div>
                <div class="panel-body">
                    {!! Form::model($position, ['route' => ['position.update_submit', $position], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}
                        @include('assistantship/positions/partials/_position_addedit')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
