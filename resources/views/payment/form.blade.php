<?php

/* @var $model \App\Payments */

?>

@extends('layouts.app')

@section('content')
    <form action="{{route('payment.pay', $model)}}" method="post">
        {{csrf_field()}}

        <div class="form-group">
            <div class="col-sm-6">
                <label for="payment-card">Номер карты</label>
                <input class="form-control" name="card" id="payment-card" value="{{old('card')}}" maxlength="16">

                @if ($errors->has('card'))
                    <span class="help-block">
                        <strong>{{ $errors->first('card') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-6">
                <label for="payment-month">месяц</label>
                <input class="form-control" name="month" id="payment-month" value="{{old('month')}}">

                @if ($errors->has('month'))
                    <span class="help-block">
                        <strong>{{ $errors->first('month') }}</strong>
                    </span>
                @endif
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-6">
                <label for="payment-year">год</label>
                <input class="form-control" name="year" id="payment-year" value="{{old('year')}}" maxlength="2" minlength="2">

                @if ($errors->has('year'))
                    <span class="help-block">
                        <strong>{{ $errors->first('year') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-6">
                <label for="payment-cvv">CVV</label>
                <input class="form-control" type="password" name="cvv" id="payment-cvv" value="{{old('cvv')}}" maxlength="3" minlength="3">

                @if ($errors->has('cvv'))
                    <span class="help-block">
                        <strong>{{ $errors->first('cvv') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-6">
                <label for="payment-phone">Телефон</label>
                <input class="form-control" name="phone" id="payment-phone" value="{{old('phone', $model->phone)}}">

                @if ($errors->has('phone'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-6">
                <label for="payment-email">Номер карты</label>
                <input class="form-control" name="email" id="payment-email" value="{{old('email', $model->email)}}">

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <button class="btn btn-success">Оплатить {{$model->amount}} KZT</button>
    </form>
@endsection
