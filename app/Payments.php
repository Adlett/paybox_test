<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Payments
 *
 * @property int $id
 * @property float $amount
 * @property int $status
 * @property \Illuminate\Support\Carbon $created_at
 * @property string|null $payment_date
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $card_number
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payments query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payments whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payments whereCardNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payments whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payments wherePaymentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payments wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payments whereStatus($value)
 * @mixin \Eloquent
 */
class Payments extends Model
{
    const STATUS_NEW = 10;
    const STATUS_SUCCESS = 20;
    const STATUS_ERROR = 30;

    public $timestamps = false;

    protected $fillable = ['amount', 'phone', 'email'];

    protected $guarded = ['status', 'created_at', 'payment_date'];

    public $rules = [
        'amount' => 'numeric|required',
        'phone' => 'max:255',
        'email' => 'email|max:255',
    ];

    public function messages()
    {
        return [
            'amount.required' => 'Сумма обязательна',
        ];
    }

    /**
     * @return string[]
     */
    public static function statusList()
    {
        return [
            self::STATUS_NEW => 'Создан',
            self::STATUS_SUCCESS => 'Оплачен',
            self::STATUS_ERROR => 'Ошибка при оплате',
        ];
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        return static::statusList()[$this->status] ?? '';//todo return some message of error
    }

    /**
     * todo use resourses/langs/* and Lang::get() or something like this
     * @return array
     */
    public static function attributeLabels()
    {
        return [
            'amount' => 'Сумма',
            'created_at' => 'Дата создания платежа',
            'status' => 'Статус',
            'payment_date' => 'Дата оплаты',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'card_number' => 'Номер карты',
        ];
    }

    public function getAttributeValueForHuman($key)
    {
        $value = parent::getAttributeValue($key);
        if($key == 'status'){
            $value = $this->getStatusName();
        }
        if($value !== null && in_array($key,['created_at', 'payment_date'])){
            $value = date('Y-m-d H:i', strtotime($value));
        }
        return $value;
    }

    /**
     * @param int $perPage
     * @return mixed
     */
    public static function getModelsForIndex($perPage = 10)
    {
        $request = request();
        return Payments::when($request->amount_from, function ($query) use ($request) {
            return $query->where('amount', '>=', $request->amount_from);
        })
            ->when($request->amount_to, function ($query) use ($request) {
                return $query->where('amount', '<=', $request->amount_to);
            })
            ->when($request->created_at_from, function ($query) use ($request) {
                return $query->where('created_at', '>=', $request->created_at_from);
            })
            ->when($request->created_at_to, function ($query) use ($request) {
                return $query->where('created_at', '<=', $request->created_at_to . ' 23:59:59');
            })
            ->when($request->payment_date_from, function ($query) use ($request) {
                return $query->where('payment_date', '>=', $request->payment_date_from);
            })
            ->when($request->payment_date_to, function ($query) use ($request) {
                return $query->where('payment_date', '<=', $request->payment_date_to . ' 23:59:59');
            })
            ->when($request->status, function ($query) use ($request) {
                return $query->where('status', $request->status);
            })
            ->when($request->phone, function ($query) use ($request) {
                return $query->where('phone', 'like', '%' . $request->phone . '%');
            })
            ->when($request->email, function ($query) use ($request) {
                return $query->where('email', 'like', '%' . $request->email . '%');
            })->orderBy('id', 'desc')
            ->paginate($perPage);
    }
}
