<?php

/* @var $models \App\Payments[] */
/* @var $request \Illuminate\Http\Request */
?>

@extends('admin.layouts.app_admin')

@section('content')

    <!-- Bootstrap шаблон... -->
    <div class="panel-body">
        <a href="{{route('admin.payment.create')}}" class="btn btn-success">Создать</a>
        @include('admin.payments._filter')
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Заголовок таблицы -->
                    <thead>
                    <th>Сумма</th>
                    <th>Статус</th>
                    <th>Дата создания</th>
                    <th>Дата оплаты</th>
                    <th>Телефон</th>
                    <th>E-mail</th>
                    <th>Ссылка на оплату</th>
                    <th> </th>
                    <th> </th>
                    </thead>

                    <!-- Тело таблицы -->
                    <tbody>
                    @if (count($models) > 0)
                        @foreach ($models as $model)
                            <tr>
                                <!-- Имя задачи -->
                                <td class="table-text">
                                    <div>{{ $model->amount }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $model->getStatusName() }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ \Carbon\Carbon::parse($model->created_at)->format('Y-m-d H:i') }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $model->payment_date ? \Carbon\Carbon::parse($model->payment_date)->format('Y-m-d H:i') : null }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $model->phone }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $model->email }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ route('payment.view', $model) }}</div>
                                </td>
                                <td>
                                    <a href="{{route('admin.payment.view', $model)}}" class="btn btn-info">Просмотр</a>
                                </td>
                                <td>
                                    <a href="{{route('admin.payment.edit', $model)}}" class="btn btn-primary">Редактировать</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <!-- Имя задачи -->
                            <td colspan="7" class="table-text">
                                Нет данных
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>

                {{ $models->appends(request()->request->all())->links() }}
            </div>
        </div>
    </div>

@endsection