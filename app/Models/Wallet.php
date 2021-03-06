<?php

namespace App\Models;

use App\Exceptions\InternalException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Wallet extends Model
{
    use HasFactory;

    const TYPE_LEFAL = 'legal';
    const TYPE_COIN = 'coin';

    public static $typeMap = [
            self::TYPE_LEFAL => '法币',
            self::TYPE_COIN =>  '币币',
    ];

    protected $fillable = [
        'hash_key',
        'user_id',
        'currency_id',
        'amount',
        'type',
        'frozen_amount',
        'withdrawal_amount',
        'lock',
        'unlock',
        'bond',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function($model){
            // 验证hash_key是否一致
           if($model->hash_key !== hashKey($model->user_id, $model->currency_id, $model->type)) {
               return false;
           }

        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function subAmount($amount, $detail_type, $remark = '')
    {
        if (comp($amount, $this->attributes['amount'])) {
            $currency = Currency::find($this->attributes['currency_id']);
            throw new InternalException("当前". $currency->name ."资产不足，请充值");
        }
        $after_amount = sub($this->attributes['amount'], $amount);
        // 增加流水
        AssetDetails::query()->create([
            'user_id' => $this->attributes['user_id'],
            'currency_id' => $this->attributes['currency_id'],
            'front_amount' => $this->attributes['amount'],
            'amount' => $amount,
            'after_amount' => $after_amount,
            'type' => $detail_type,
            'remark' => $remark,
        ]);
        $result = $this->newQuery()
            ->where(['id' => $this->getKey(), 'amount' => $this->attributes['amount']])
            ->update(['amount' => $after_amount]);
        if (!$result) throw new InternalException('扣款失败，请重试');
    }

    public function addAmount($amount, $detail_type, $remark = '')
    {
        $after_amount = add($this->attributes['amount'], $amount);
        // 增加流水
        AssetDetails::query()->create([
            'user_id' => $this->attributes['user_id'],
            'currency_id' => $this->attributes['currency_id'],
            'front_amount' => $this->attributes['amount'],
            'amount' => $amount,
            'after_amount' => $after_amount,
            'type' => $detail_type,
            'remark' => $remark,
        ]);
        $result = $this->newQuery()
            ->where(['id' => $this->getKey(), 'amount' => $this->attributes['amount']])
            ->update(['amount' => $after_amount]);
        if (!$result) throw new InternalException('充值失败，请重试');
    }

    public function addFrozenAmount($amount)
    {
        $after_amount = add($this->attributes['frozen_amount'], $amount);
        $result = $this->newQuery()
            ->where(['id' => $this->getKey(), 'frozen_amount' => $this->attributes['frozen_amount']])
            ->update(['frozen_amount' => $after_amount]);
        if (!$result) throw new InternalException('冻结失败，请重试');
    }

    public function subFrozenAmount($amount)
    {
        $after_amount = sub($this->attributes['frozen_amount'], $amount);
        $result = $this->newQuery()
            ->where(['id' => $this->getKey(), 'frozen_amount' => $this->attributes['frozen_amount']])
            ->update(['frozen_amount' => $after_amount]);
        if (!$result) throw new InternalException('冻结扣款失败，请重试');
    }

    public function addWithdrawalAmount($amount)
    {
        $after_amount = add($this->attributes['withdrawal_amount'], $amount);
        $result = $this->newQuery()
            ->where(['id' => $this->getKey(), 'withdrawal_amount' => $this->attributes['withdrawal_amount']])
            ->update(['withdrawal_amount' => $after_amount]);
        if (!$result) throw new InternalException('提现失败，请重试');
    }

    public function addBondAmount($amount)
    {
        if (comp($amount, $this->attributes['amount'])) {
            throw new InternalException("余额不足");
        }
        $result = $this->newQuery()
                    ->where(['id' => $this->getKey(), 'bond' => $this->attributes['bond']])
                    ->update(['bond' => add($this->attributes['bond'], $amount)]);
        if (!$result) throw new InternalException('保证金充值失败，请重试');
    }
    public function subBondAmount($amount)
    {
        if (comp($amount, $this->attributes['bond'])) {
            throw new InternalException("保证金不足");
        }
        $result = $this->newQuery()
            ->where(['id' => $this->getKey(), 'bond' => $this->attributes['bond']])
            ->update(['bond' => sub($this->attributes['bond'], $amount)]);
        if (!$result) throw new InternalException('扣除失败，请重试');
    }

    public function addLockAmount($amount)
    {
        if (comp($amount, $this->attributes['bond'])) {
            throw new InternalException("保证金不足");
        }
        $result = $this->newQuery()
            ->where(['id' => $this->getKey(), 'lock' => $this->attributes['lock']])
            ->update(['lock' => add($this->attributes['lock'], $amount)]);
        if (!$result) throw new InternalException('保证金冻结失败，请重试');
    }

    public function subLockAmount($amount)
    {
        if (comp($amount, $this->attributes['lock'])) {
            throw new InternalException("冻结保证金不足");
        }
        $result = $this->newQuery()
            ->where(['id' => $this->getKey(), 'lock' => $this->attributes['lock']])
            ->update(['lock' => sub($this->attributes['lock'], $amount)]);
        if (!$result) throw new InternalException('解除保证金失败，请重试');
    }


}
