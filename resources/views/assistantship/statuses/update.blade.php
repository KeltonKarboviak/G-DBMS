<!-- resources/views/assistantship/status/update.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Update Assistantship Status</h2>
                </div>
                <div class="panel-body">
                    {!! Form::model($status, ['route' => ['status.update_submit', $status], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}
                        @include('assistantship/statuses/partials/_status_addedit')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
