<!-- resources/views/gqe/pass_level/update.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-und">
                <div class="panel-heading">
                    <h2 class="panel-title">Update GQE Pass Level</h2>
                </div>
                <div class="panel-body">
                    {!! Form::model($level, ['route' => ['pass_level.update_submit', $level], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}
                        @include('gqe/pass_level/partials/_pass_level_addedit')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
