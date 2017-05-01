<!-- resources/views/welcome.blade.php -->

@extends('layouts.app')

@section('styles')
<style>
    body {
        /*background-color: #4c4945;*/
        background: rgba(76,73,69,1); /* Old Browsers */
        background: -moz-radial-gradient(center, ellipse cover, rgba(76,73,69,1) 0%, rgba(76,73,69,1) 26%, rgba(87,84,81,1) 51%, rgba(94,92,89,1) 71%, rgba(117,114,110,1) 100%); /* FF3.6+ */
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(76,73,69,1)), color-stop(26%, rgba(76,73,69,1)), color-stop(51%, rgba(87,84,81,1)), color-stop(71%, rgba(94,92,89,1)), color-stop(100%, rgba(117,114,110,1))); /* Chrome, Safari4+ */
        background: -webkit-radial-gradient(center, ellipse cover, rgba(76,73,69,1) 0%, rgba(76,73,69,1) 26%, rgba(87,84,81,1) 51%, rgba(94,92,89,1) 71%, rgba(117,114,110,1) 100%); /* Chrome10+,Safari5.1+ */
        background: -o-radial-gradient(center, ellipse cover, rgba(76,73,69,1) 0%, rgba(76,73,69,1) 26%, rgba(87,84,81,1) 51%, rgba(94,92,89,1) 71%, rgba(117,114,110,1) 100%); /* Opera 11.10+ */
        background: -ms-radial-gradient(center, ellipse cover, rgba(76,73,69,1) 0%, rgba(76,73,69,1) 26%, rgba(87,84,81,1) 51%, rgba(94,92,89,1) 71%, rgba(117,114,110,1) 100%); /* IE 10+ */
        background: radial-gradient(ellipse at center, rgba(76,73,69,1) 0%, rgba(76,73,69,1) 26%, rgba(87,84,81,1) 51%, rgba(94,92,89,1) 71%, rgba(117,114,110,1) 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#4c4945', endColorstr='#75726e', GradientType=1); /* IE6-9 fallback on horizontal gradient */
    }
</style>
@endsection

@section('content')
<div class="jumbotron">
    <h1>Welcome to Graduate DBMS!</h1>
    <h3>Department of Computer Science</h3>
    {{-- <img src="{{ asset('storage/csci_logo.png') }}" alt="Department of Computer Science, University of North Dakota" class="img-responsive" /> --}}
    <img src="{{ asset('storage/und_banner.png') }}" alt="University of North Dakota" class="img-responsive" />
    <a href="{{ url('/login') }}" class="btn btn-lg">Click to Login</a>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-2 col-md-offset-5">
            <img src="{{ asset('storage/flame.png') }}" alt="" class="img-responsive" />
        </div>
    </div>
</div>
@endsection
