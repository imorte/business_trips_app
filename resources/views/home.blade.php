@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Административный раздел</div>

                <div class="panel-body">
                    <ul class="nav nav-pills">
                        <li role="presentation">
                            <a href="{{ route('companies') }}">Организации</a>
                        </li>
                        <li role="presentation">
                            <a href="{{ route('departments') }}">Отделы</a>
                        </li>
                        <li role="presentation">
                            <a href="{{ route('trips') }}">Командировки</a>
                        </li>
                        <li role="presentation">
                            <a href="{{ route('cities') }}">Города</a>
                        </li>
                        <li role="presentation">
                            <a href="{{ route('employees') }}">Сотрудники</a>
                        </li>
                    </ul>
                </div>
                <hr>
                <div class="panel-body">
                    asdfasd
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
