@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        {!! Form::open(['method' => 'POST', 'action' => 'CityController@store', 'class' => 'form-inline']) !!}
        <div class="form-group">
            {!! Form::label('name', 'Город: ') !!}
            {!! Form::text('name', '', ['class' => 'form-control']) !!}

            {!! Form::submit('Добавить', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
        <br>
        @include('partials._errors')

        Список городов:

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Номер</th>
                    <th>Название</th>
                    <th>Операции</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cities as $city)
                    <tr>
                        <td>{{ $city->id }}</td>
                        <td>{{ $city->name }}</td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'action' => ['CityController@destroy', $city->id], 'class' => 'form-inline']) !!}
                                {!! Form::submit('Удалить', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop