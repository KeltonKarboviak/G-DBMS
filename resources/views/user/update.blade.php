<!-- resources/views/user/update.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <div class="panel-group">

                @can('update_pass', $user)
                    <!-- Panel for update User's Password -->
                    <div class="panel panel-und">
                        <div class="panel-heading">
                            <div class="panel-title">Update Password</div>
                        </div>
                        <div class="panel-body">
                            {!! Form::open(['method' => 'PATCH', 'route' => ['user.update_pass', $user], 'class' => 'form-horizontal']) !!}
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    {!! Form::label('password', 'Current Password:', ['class' => 'col-md-4 control-label']) !!}

                                    <div class="col-md-6">
                                        {!! Form::password('password', ['class' => 'form-control']) !!}

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                                    {!! Form::label('new_password', 'New Password:', ['class' => 'col-md-4 control-label']) !!}

                                    <div class="col-md-6">
                                        {!! Form::password('new_password', ['class' => 'form-control']) !!}

                                        @if ($errors->has('new_password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('new_password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
                                    {!! Form::label('new_password_confirmation', 'Confirm New Password:', ['class' => 'col-md-4 control-label']) !!}

                                    <div class="col-md-6">
                                        {!! Form::password('new_password_confirmation', ['class' => 'form-control']) !!}

                                        @if ($errors->has('new_password_confirmation'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <div class="btn-group">
                                            {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
                                            <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div> <!-- /.panel .panel-und User's Password -->
                @endcan

                <!-- Panel for updating User's Basic Information -->
                <div class="panel panel-und">
                    <div class="panel-heading">
                        <div class="panel-title">Update User Profile</div>
                    </div>
                    <div class="panel-body">
                        {!! Form::model($user, ['route' => ['user.update_info', $user], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}
                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                {!! Form::label('first_name', 'First Name:', ['class' => 'col-md-4 control-label']) !!}

                                <div class="col-md-6">
                                    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}

                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                {!! Form::label('last_name', 'Last Name:', ['class' => 'col-md-4 control-label']) !!}

                                <div class="col-md-6">
                                    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}

                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                {!! Form::label('email', 'E-Mail Address:', ['class' => 'col-md-4 control-label']) !!}

                                <div class="col-md-6">
                                    {!! Form::text('email', null, ['class' => 'form-control']) !!}

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @can('update_role_id', $user)
                                <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                                    {!! Form::label('role_id', 'Role:', ['class' => 'col-md-4 control-label']) !!}

                                    <div class="col-md-6">
                                        {!! Form::select('role_id', $roles, null, ['class' => 'form-control']) !!}

                                        @if ($errors->has('role_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('role_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endcan

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="btn-group">
                                        {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
                                        <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div> <!-- /.panel .panel-und User's Information -->
            </div> <!-- /.panel-group -->
        </div> <!-- /.col-md-8 .col-md-offset-2 -->

    </div>
</div>
@endsection