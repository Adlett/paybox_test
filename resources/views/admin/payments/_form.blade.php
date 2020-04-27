<?php
/* @var $model \App\Payments */
/* @var $action string */
?>
<a href="{{route('admin.payment.index')}}" class="btn btn-success">Назад</a>
<!-- Форма новой задачи -->
<form action="{{ $action }}" method="POST" class="form-horizontal">
{{ csrf_field() }}
{{ method_field($method) }}

<!-- Имя задачи -->
    <div class="form-group">
        <label for="partner-amount" class="col-sm-3 control-label">Сумма</label>
        <div class="col-sm-6">
            <input type="text" name="amount" id="partner-amount" value="{{ old('amount',$model->amount) }}"
                   class="form-control">

            @if ($errors->has('amount'))
                <span class="help-block">
                        <strong>{{ $errors->first('amount') }}</strong>
                    </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label for="partner-email" class="col-sm-3 control-label">E-mail</label>
        <div class="col-sm-6">
            <input type="email" name="email" id="partner-email" value="{{ old('email',$model->email) }}"
                   class="form-control">
            @if ($errors->has('email'))
                <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label for="partner-phone" class="col-sm-3 control-label">Телефон</label>
        <div class="col-sm-6">
            <input type="text" name="phone" id="partner-phone" value="{{ old('phone',$model->phone) }}"
                   class="form-control">

            @if ($errors->has('phone'))
                <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
            @endif
        </div>
    </div>

    <!-- Кнопка добавления задачи -->
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-default">
                <i class="fa fa-plus"></i> Сохранить
            </button>
        </div>
    </div>
</form>