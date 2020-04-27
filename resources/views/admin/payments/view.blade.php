<?php

/* @var $model \App\Payments */

?>

@extends('admin.layouts.app_admin')

@section('content')

    <a href="{{route('admin.payment.index')}}" class="btn btn-success">Все платежи</a>
    <!-- Bootstrap шаблон... -->
    <div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Тело таблицы -->
                    <tbody>
                    <?php foreach ($model->getAttributes() as $attribute => $value): ?>
                    <tr>
                        <td style="float: right"><?= \App\Payments::attributeLabels()[$attribute] ?? $attribute ?></td>
                        <td><?= $model->getAttributeValueForHuman($attribute) ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection