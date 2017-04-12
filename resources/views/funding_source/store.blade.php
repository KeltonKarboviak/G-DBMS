<!-- resources/views/funding_source/store.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Add Funding Source</h2>
                </div>
                <div class="panel-body">
                    {!! Form::model($source, ['route' => ['funding_source.store_submit'], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                        @include('funding_source/partials/_funding_source_addedit')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
