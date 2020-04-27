<?php

/* @var $model \App\Payments */

?>

@extends('layouts.app')

@section('content')
    <div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Тело таблицы -->
                    <tbody>
                    <tr>
                        <td style="float: right">Статус</td>
                        <td><?= $model->getStatusName() ?></td>
                    </tr>
                    <tr>
                        <td style="float: right">Сумма</td>
                        <td><?= $model->amount ?></td>
                    </tr>
                    <tr>
                        <td style="float: right">Дата платежа</td>
                        <td><?= $model->getAttributeValueForHuman('payment_date') ?></td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
