@extends('admin.layouts.app_admin')

@section('content')
{{--    @include('common.errors')--}}
    @include('admin.payments._form', ['model' => $model, 'action' => route('admin.payment.store'), 'method' => 'POST'])

@endsection
