<?php

namespace App\Models;

use Carbon\Carbon;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, HasDateTimeFormatter;

    const STATUS_PENDING = 'pending';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED  = 'failed';
    const STATUS_EFFECTIVE = 'effective';
    const STATUS_INVALID = 'invalid'; // overdue
    const STATUS_OVERDUE = 'overdue';
    const STATUS_PLEDGE_RETURN = 'pledge_return';

    public static $statusMap = [
            self::STATUS_PENDING => '审核中',
            self::STATUS_SUCCESS => '支付成功',
            self::STATUS_FAILED => '支付失败',
            self::STATUS_EFFECTIVE => '有效算力',
            self::STATUS_INVALID => '算力失效',
            self::STATUS_OVERDUE => '逾期欠费',
            self::STATUS_PLEDGE_RETURN => '质押已退',
    ];

    protected $fillable = [
        'remark','paid_prove', 'paid_at',
        'payment_method', 'closed', 'status','amount',
        'total_amount','profit_data','product_id','mortgage',
        'total_powers', 'payment_price','currency_id',
    ];

    // protected $dates = [
    //     'paid_at',
    // ];

    protected $appends = [
        'is_installment', 'surplus_days'
    ];

    protected $casts = [
        'closed'    => 'boolean',
        // 'paid_at'   => 'datetime:Y-m-d H:i:s',
        //'created_at'   => 'datetime:Y-m-d H:i:s',
        //'updated_at'   => 'datetime:Y-m-d H:i:s',
        'profit_data'  => 'json',
        'mortgage'     => 'json',
    ];

    public function getIsInstallmentAttribute()
    {
        return Installment::query()->where('order_id', $this->attributes['id'])->exists();
    }

    protected static function boot()
    {
        parent::boot();
        // 监听模型创建时间，写入数据库之前触发
        static::creating(function ($model) {
            // 如果模型的 no 字段为空
            if (!$model->no) {
                // 调用findAvailableNo 生成订单流水号
                $model->no = static::findAvailableNo();
                // 如果订单生成失败，则终止创建订单
                if (!$model->no) {
                    return false;
                }
            }
        });
    }

    public static function findAvailableNo()
    {
        // 订单流水号生成
        $prefix = date('YmdHis');
        for ($i = 0; $i < 10; $i++) {
            // 随机生成6位数字
            $no = $prefix.str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            // 判断是否已存在
            if (!static::query()->where('no', $no)->exists()) {
                return $no;
            }
        }
        Log::warning('find order no failed');
        return false;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function getSurplusDaysAttribute()
    {
        if (isset($this->attributes['profit_data']) && $this->attributes['profit_data']) {
            $profit_data = json_decode($this->attributes['profit_data'], true);
            if (Carbon::today()->gte($profit_data['begin'])) {
                $days = (strtotime($profit_data['end']) - strtotime(Carbon::today()->toDateString()))/86400;
            } else {
                $days = (strtotime($profit_data['end']) - strtotime($profit_data['begin']))/86400;
            }
            return $days > 0 ? $days : 0;
        }
    }
}
