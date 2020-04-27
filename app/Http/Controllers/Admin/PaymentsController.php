<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $models = Payments::getModelsForIndex(2);
        return view('admin.payments.index', ['models' => $models]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $model = new Payments();
        return view('admin.payments.create', ['model' => $model]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $model = new Payments();

        $validator = Validator::make($request->all(), $model->rules, $model->messages());
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $model->fill($request->all());
        $model->amount = $this->cutAmount($model->amount, 2);
        $model->created_at = now('Asia/Almaty');
        $model->status = $model::STATUS_NEW;

        if ($model->save()) {
            \Session::flash('success', 'Успешно сохранен платеж');
        } else {
            \Session::flash('error', 'Возникла ошибка');
        }

        return redirect(route('admin.payment.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Payments $model
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(Payments $model)
    {
        return view('admin.payments.view', ['model' => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Payments $model
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function edit(Payments $model)
    {
        if ($model->status == Payments::STATUS_SUCCESS) {
            \Session::flash('error', 'Нельзя редактировать оплаченные платежи');
            return redirect(route('admin.payment.view', $model));
        }
        return view('admin.payments.edit', ['model' => $model]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Payments $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Payments $model)
    {
        $validator = Validator::make($request->all(), $model->rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $model->fill($request->all());
        $model->amount = $this->cutAmount($model->amount, 2);
        if ($model->update()) {
            \Session::flash('success', 'Успешно обновлен платеж');
        } else {
            \Session::flash('error', 'Возникла ошибка');
        }

        return redirect(route('admin.payment.index'));
    }

    protected function cutAmount(float $amount, int $len)
    {
        $n = pow(10, $len);
        return intval($amount * $n) / $n;
    }
}
