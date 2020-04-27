<?php


namespace App\Http\Services;


use App\Payments;
use Illuminate\Database\Eloquent\Model;

class PaymentService extends Model
{

    protected $fillable = ['year', 'month', 'card', 'email', 'phone'];

    /**
     * @param Payments $model
     * @return bool
     */
    public function execute(Payments $model)
    {
        if ($this->is_valid_credit_card() && $this->checkDate()) {
            $model->status = Payments::STATUS_SUCCESS;
            \Session::flash('success', 'Оплата проведена успешно');
        } else {
            $model->status = Payments::STATUS_ERROR;
        }
        $model->payment_date = now('Asia/Almaty');
        $model->card_number = $this->card;
        $model->phone = $this->phone;
        $model->email = $this->email;

        return $model->save();
    }

    /**
     * @return bool
     */
    private function is_valid_credit_card()
    {
        $s = strrev(preg_replace('/[^\d]/', '', $this->card));

        $sum = 0;
        for ($i = 0, $j = strlen($s); $i < $j; $i++) {
            if (($i % 2) == 0) {
                $val = $s[$i];
            } else {
                $val = $s[$i] * 2;
                if ($val > 9) $val -= 9;
            }
            $sum += $val;
        }

        if (!(($sum % 10) == 0)) {
            \Session::flash('error', 'Неверно введена карта');
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    private function checkDate()
    {
        if ($this->year < date('y')) {
            \Session::flash('error', 'Срок действия карты истек');
            return false;
        }
        if ($this->year == date('y')) {
            if ($this->month <= date('m')) {
                \Session::flash('error', 'Срок действия карты истек');
                return false;//считается что ошибка, даже если ввод происходит 1го числа, а срок истекает позже но этого же месяца
            }
        }
        return true;
    }
}