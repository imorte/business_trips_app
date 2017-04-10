@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        Список сотрудников:

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Номер</th>
                <th>ФИО</th>
                <th>Компания</th>
                <th>Отдел</th>
            </tr>
            </thead>
            <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>
                        <a href="{{ route('employees.edit', $employee->id) }}">
                            {{ $employee->name }} {{ $employee->last_name }}
                        </a>
                    </td>
                    <td>{{ $employee->company->name }}</td>
                    <td>{{ $employee->department->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop