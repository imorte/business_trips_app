@extends('layouts.admin')

@section('content')
    <div class="col-md-8">
        @include('partials._errors')

        @if(count($trips))
            Командировки:

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Сотрудник</th>
                    <th>Компания</th>
                    <th>До окончания</th>
                    <th>Список расходов</th>
                </tr>
                </thead>
                <tbody>
                @if(count($trips))
                    @foreach($trips as $trip)
                        <tr>
                            <td>{{ $trip->name }}</td>
                            <td>
                                <a href="{{ route('employees.edit', $trip->user->id) }}">
                                    {{ $trip->user->name }} {{ $trip->user->last_name }}
                                </a>
                            </td>
                            <td>{{ $trip->company->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($trip->trip_end)->diffForHumans() }}</td>
                            <td>
                                @if(Auth::user()->role->id == 1)
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#list">Просмотреть</button>
                                @else
                                    <button type="button" class="btn btn-primary" data-trip="{{ $trip->id }}" data-toggle="modal" data-target="#costs">Заполнить</button>
                                @endif
                            </td>
                            @if(Auth::user()->role->id == 1)
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'action' => ['TripController@destroy', $trip->id], 'class' => 'form-inline']) !!}
                                        {!! Form::hidden('user_id', $trip->user->id) !!}
                                        {!! Form::submit('Отменить', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        @endif

        @if(Auth::user()->role->id == 1)
            {!! Form::open(['method' => 'POST', 'action' => 'TripController@store', 'class' => 'bordered-group']) !!}
                <div class="form-group">
                    {!! Form::label('trip_start', 'Начало поездки', ['class' => 'control-label']) !!}
                    {{ Form::date('trip_start', $start = Carbon\Carbon::now()->addDay()) }}
                </div>

                <div class="form-group">
                    {!! Form::label('trip_end', 'Окончание поездки', ['class' => 'control-label']) !!}
                    {{ Form::date('trip_end', $start->addMonth()) }}
                </div>

                <div class="form-group">
                    {!! Form::label('name', 'Описание', ['class' => 'control-label']) !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('company_id', 'Компания: ', ['class' => 'control-label']) !!}
                    {!! Form::select('company_id', ['' => 'Выберите компанию'] + $companies, null, ['class' => 'form-control', 'data-company-employees']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('user_id', 'Сотрудник: ', ['class' => 'control-label']) !!}
                    {!! Form::select('user_id', ['' => 'Снача выберите компанию'], null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        @endif
    </div>

    @if(Auth::user()->role->id == 1)
        <div id="list" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Список расходов</h4>
                    </div>
                    <div class="modal-body">
                        <p>Some text in the modal.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    @else
        <div id="costs" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Список расходов</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['method' => 'POST', 'action' => 'CostController@store', 'class' => 'bordered-group', 'data-costs-form']) !!}

                            <div data-costs-container>
                                <div data-costs-item>
                                    <div style="width: 45%; display: inline-block">
                                        <div class="form-group">
                                            {!! Form::label('name', 'Описание', ['class' => 'control-label']) !!}
                                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div style="width: 45%; display: inline-block">
                                        <div class="form-group">
                                            {!! Form::label('costs', 'Стоимость', ['class' => 'control-label']) !!}
                                            {!! Form::text('costs', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Подтвердить', ['class' => 'btn btn-success', 'data-costs-save']) !!}
                            </div>

                        {!! Form::close() !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>

            </div>
        </div>
    @endif
@stop