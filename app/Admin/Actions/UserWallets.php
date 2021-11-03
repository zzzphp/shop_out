<?php

namespace App\Admin\Actions;

use App\Models\Currency;
use App\Models\PowerDistributeLog;
use Dcat\Admin\Actions\Action;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Dcat\Admin\Support\LazyRenderable;
use Dcat\Admin\Widgets\Table;
use App\Models\Wallet;

class UserWallets extends LazyRenderable
{

    public function render()
    {
        // 获取ID
        $id = $this->key;
        $wallets = Wallet::where('user_id', $id)
            ->get(['amount', 'frozen_amount', 'withdrawal_amount', 'currency_id', 'lock', 'unlock', 'user_id'])
            ->toArray();
        foreach ($wallets as $k => $wallet) {
            $wallet['user_id'] = PowerDistributeLog::query()
                ->where(['user_id' => $wallet['user_id'], 'currency_id' => $wallet['currency_id']])
                ->sum('all');
            $wallet['name'] = Currency::query()->where('id', $wallet['currency_id'])->value('name');
            unset($wallet['currency_id']);
            $wallets[$k] = $wallet;
        }
        $titles = [
            '可用数量',
            '冻结数量',
            '提现数量',
            '锁仓收益',
            '已释放',
            '总收益',
        ];

        return Table::make($titles, $wallets);
    }
}
