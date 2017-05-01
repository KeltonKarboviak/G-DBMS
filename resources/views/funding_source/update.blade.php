<!-- resources/views/funding_source/update.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-und">
                <div class="panel-heading">
                    <h2 class="panel-title">Update Funding Source</h2>
                </div>
                <div class="panel-body">
                    {!! Form::model($source, ['route' => ['funding_source.update_submit', $source], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}
                        @include('funding_source/partials/_funding_source_addedit')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
