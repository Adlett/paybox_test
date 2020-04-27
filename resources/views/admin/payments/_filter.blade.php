<?php
$request = request();
?>
<script
        src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
        crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('#filter_toggle').on('click', function () {
            $('#filter-container').toggle();
        })
    });
</script>
<button type="button" id="filter_toggle" class="btn btn-default">Показать фильтр</button>
<div id="filter-container" style="display: none">
    <form method="get" action="{{route('admin.payment.index')}}">
        <div class="row">
            <div class="col-md-2">
                <label for="filter-amount_from">Сумма от</label>
                <input class="form-control" name="amount" id="filter-amount_from" value="{{$request->amount_from}}">

                <label for="filter-amount_to">Сумма до</label>
                <input class="form-control" name="amount" id="filter-amount_to" value="{{$request->amount_to}}">
            </div>
            <div class="col-md-2">
                <label for="filter-created_at_from">Дата создания от</label>
                <input class="form-control" type="date" name="created_at_from" id="filter-created_at_from"
                       value="{{$request->created_at_from}}">

                <label for="filter-created_at_to">Дата создания до</label>
                <input class="form-control" type="date" name="created_at_to" id="filter-created_at_to"
                       value="{{$request->created_at_to}}">
            </div>
            <div class="col-md-2">
                <label for="filter-payment_date_from">Дата платежа от</label>
                <input class="form-control" type="date" name="payment_date_from" id="filter-payment_date_from"
                       value="{{$request->payment_date_from}}">

                <label for="filter-payment_date_to">Дата платежа до</label>
                <input class="form-control" type="date" name="payment_date_to" id="filter-payment_date_to"
                       value="{{$request->payment_date_to}}">
            </div>
            <div class="col-md-4">
                <label for="filter-email">E-mail</label>
                <input class="form-control" name="email" id="filter-email" value="{{$request->email}}">

                <label for="filter-phone">Телефон</label>
                <input class="form-control" name="phone" id="filter-phone" value="{{$request->phone}}">
            </div>
            <div class="col-md-2">
                <label for="filter-status">Статус</label>
                <select name="status" id="filter-status" class="form-control">
                    <option value="" {{isset($request->status) ? '' : 'selected'}}>Выберите статус</option>
                    @foreach(\App\Payments::statusList() as $id => $name)
                        <option value="{{$id}}" {{$request->status == $id ? 'selected':''}}>{{$name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button class="btn btn-light">Фильтровать</button>
        <a href="{{route('admin.payment.index')}}" class="btn btn-danger">Сбросить</a>
    </form>
</div>
