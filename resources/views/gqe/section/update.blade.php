<!-- resources/views/gqe/section/update.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Update GQE Section</h2>
                </div>
                <div class="panel-body">
                    {!! Form::model($section, ['route' => ['gqe_section.update_submit', $section], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}
                        @include('gqe/section/partials/_section_addedit')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
