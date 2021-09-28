<?php

namespace App\Http\Controllers\Api;

use App\Models\AssetDetails;
use App\Models\Currency;
use App\Models\Order;
use App\Models\Wallet;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PowerDistributeLog;

class PowerDistributeLogsController extends Controller
{
    //

    public function index(Request $request)
    {
        $builder = PowerDistributeLog::with(['stage'])
            ->where('user_id', $request->user()->id)
            ->orderBy('dated','DESC');
        if($currency_id = $request->currency_id) {
            $builder->where('currency_id', $currency_id);
        }
        if ($dated = $request->dated) {
            $time = strtotime($dated);
            $builder->whereBetween('dated', [date('Y-m-01', $time), date('Y-m-t', $time)]);
        } else {
            $time = time();
            $builder->whereBetween('dated', [date('Y-m-01', $time), date('Y-m-t', $time)]);
        }

        return response()->json(['data' => $builder->get()]);
    }

    public function info(Request $request)
    {
        $request->validate(['currency_id' => 'required']);
        $currency = Currency::find($request->currency_id);
        $wallet = Wallet::query()->where([
            'user_id' => $request->user()->id,
            'currency_id' => $request->currency_id,
            'type'   => $currency->type,
        ])->first();
        $data['amount'] = AssetDetails::query()->where('user_id', $request->user()->id)
            ->sum('amount');
        $data['cny_rate'] = (currency_last(strtolower($currency->name)) ?: 0) * usdtAmount();

        $data['all'] = floatval(PowerDistributeLog::query()
            ->where(['user_id' => $request->user()->id, 'currency_id' => $request->currency_id])
            ->sum('all'));
        $data['lock'] = floatval($wallet->lock);
        $data['unlock'] = floatval($wallet->unlock);
        $data['user'] = 0;
        $data['platform'] = 0;
        $mortgages = Order::query()
            ->where('user_id', $request->user()->id)
            ->where('currency_id', $request->currency_id)
            ->whereIn('status', [Order::STATUS_EFFECTIVE, Order::STATUS_OVERDUE, Order::STATUS_INVALID])
            ->whereNotNull('mortgage')
            ->get(['id','mortgage']);
        foreach ($mortgages as $mortgage) {
            $data['user'] = add($data['user'], $mortgage->mortgage['user']);
            $data['platform'] = add($data['platform'], $mortgage->mortgage['platform']);
        }
        $data['withdrawals'] = floatval(Withdrawal::query()
            ->where(['user_id' => $request->user()->id, 'currency_id' => $request->currency_id])
            ->where('status', Withdrawal::STATUS_SUCCESS)
            ->sum('amount'));
        // 第一期的质押
        if ($request->currency_id == 3) {
            $stage_1 = Order::query()
                ->where('currency_id', 3)
                ->where('user_id', $request->user()->id)
                ->whereIn('status', [Order::STATUS_SUCCESS, Order::STATUS_EFFECTIVE, Order::STATUS_OVERDUE, Order::STATUS_INVALID])
                ->with(['product'])
                ->whereHas('product', function ($builder){
                    $builder->where('stage_id', 2);
                })->get(['id','mortgage']);
            foreach ($stage_1 as $stage) {
                $data['all'] = add($data['all'],$stage->mortgage['user']);
            }
        }
        $data['all'] = floatval($data['all']);

        return response()->json(['data' => $data]);
    }
}
