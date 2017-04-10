@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        {!! Form::open(['method' => 'POST', 'action' => 'DepartmentController@store', 'class' => 'form-inline']) !!}
        <div class="form-group">
            {!! Form::label('name', 'Отдел: ') !!}
            {!! Form::text('name', '', ['class' => 'form-control']) !!}

            {!! Form::label('company_id', 'Компания: ') !!}
            {!! Form::select('company_id', ['' => 'Выберите компанию'] + $companies, null, ['class' => 'form-control']) !!}

            {!! Form::submit('Добавить', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
        <br>
        @include('partials._errors')

        Список отделов:

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Номер</th>
                    <th>Компания</th>
                    <th>Отдел</th>
                </tr>
            </thead>
            <tbody>
            @foreach($departments as $department)
                <tr>
                    <td>{{ $department->id }}</td>
                    <td>{{ $companies[$department->company_id] }}</td>
                    <td>{{ $department->name }}</td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'action' => ['DepartmentController@destroy',
                            $department->id], 'class' => 'form-inline']) !!}
                        {!! Form::submit('Удалить', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop