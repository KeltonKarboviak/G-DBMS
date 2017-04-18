<!-- resources/views/user/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            {{-- <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="col-md-3">User's Name</th><th class="col-md-6">Email</th><th class="col-md-3">Permissions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->full_name }}</td>
                                <td><a href="mailto:{{ $user->email }}"><span class="glyphicon glyphicon-envelope"></span> {{ $user->email }}</a></td>
                                <td>{{ $user->role->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> --}}

            <div class="panel-group">
                <?php $count = 0; ?>

                @foreach ($users as $user)
                    <?php $count += 1; ?>

                    <div class="panel panel-primary">
                        <div class="panel-heading clearfix">
                            <div class="panel-title pull-left">
                                <a data-toggle="collapse" href="#collapse_outer{{ $count }}">
                                    {{ "{$user->proper_name} - {$user->role->name}" }}
                                </a>
                            </div>
                            <div class="btn-group pull-right">
                                {!! Form::open(['method' => 'DELETE', 'route' => ['user.delete', $user], 'class' => 'form-horizontal', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                    <a href="{{ route('user.update', $user) }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="Edit">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    <button type="submit" class="btn btn-default btn-sm" data-toggle="tooltip" title="Delete">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div id="collapse_outer{{ $count }}" class="panel-collapse collapse">
                            <ul class="list-group">
                                <li class="list-group-item">User's Name: {{ $user->full_name }}</li>
                                <li class="list-group-item">Email: <a href="mailto:{{ $user->email }}">{{ $user->email }} <span class="glyphicon glyphicon-envelope"></span></a></li>
                                <li class="list-group-item">Permissions: {{ $user->role->name }}</li>
                            </ul>
                        </div>
                    </div> <!-- /.panel panel-primary -->
                @endforeach

            </div> <!-- /.panel-group -->

        </div>

    </div>
</div>
@endsection