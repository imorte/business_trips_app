@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        {!! Form::open(['method' => 'POST', 'action' => 'CompanyController@store', 'class' => 'form-inline']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Организация: ') !!}
                {!! Form::text('name', '', ['class' => 'form-control']) !!}

                {!! Form::label('city_id', 'Город: ') !!}
                {!! Form::select('city_id', ['' => 'Выберите город'] + $cities, null, ['class' => 'form-control']) !!}

                {!! Form::submit('Добавить', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
        <br>
        @include('partials._errors')

        Список компаний:

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Номер</th>
                <th>Название</th>
                <th>Город</th>
                <th>Операции</th>
            </tr>
            </thead>
            <tbody>
            @foreach($companies as $company)
                <tr>
                    <td>{{ $company->id }}</td>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->city->name }}</td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'action' => ['CompanyController@destroy', $company->id], 'class' => 'form-inline']) !!}
                            {!! Form::submit('Удалить', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop