<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Http\Services\PaymentService;
use App\Payments;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    /**
     * todo rename or divide to another actions for view and payment
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function view(Payments $model)
    {
        if($model->status == Payments::STATUS_SUCCESS || $model->status == Payments::STATUS_ERROR){
            return view('payment.success_payment', ['model' => $model]);
        }

        return view('payment.form', ['model' => $model]);
    }

    public function pay(PaymentRequest $request, Payments $model)
    {
        $validator = Validator::make($request->all(), $request->rules());
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $service = new PaymentService();
        $service->fill($request->all());
        if($service->execute($model)){
            return redirect(route('payment.view', $model));
        } else {
            \Session::flash('error', 'Возникла ошибка');
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
    }
}
