@extends('layouts.admin')

@section('content')
    <div class="col-md-8">
        @include('partials._errors')
        <h3>{{ $employee->name }} {{ $employee->last_name }}</h3>

        {!! Form::model($employee, ['method' => 'PATCH', 'action' => ['EmployeeController@update', $employee->id], 'class' => 'bordered-group']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Имя', ['class' => 'control-label']) !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('last_name', 'Фамилия', ['class' => 'control-label']) !!}
                {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('email', 'E-mail', ['class' => 'control-label']) !!}
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('department_id', 'Отдел', ['class' => 'control-label']) !!}
                {!! Form::select('department_id', $departments, null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Пароль', ['class' => 'control-label']) !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Обновить', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}

        {!! Form::open(['method' => 'DELETE', 'action' => ['EmployeeController@destroy', $employee->id]]) !!}
        <div class="form-group">
            {!! Form::submit('Удалить', ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop