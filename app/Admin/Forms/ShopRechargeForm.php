<?php

namespace App\Admin\Forms;

use App\Exceptions\InternalException;
use App\Models\Currency;
use App\Models\Order;
use App\Models\ServiceShop;
use App\Models\Shop;
use Dcat\Admin\Admin;
use Dcat\Admin\Contracts\LazyRenderable;
use Dcat\Admin\Widgets\Form;
use Dcat\Admin\Traits\LazyWidget;
use Illuminate\Support\Facades\DB;

class ShopRechargeForm extends Form implements LazyRenderable
{
    use LazyWidget;
    /**
     * Handle the form request.
     *
     * @param array $input
     *
     * @return mixed
     */

    public function handle(array $input)
    {
        $id = $this->payload['id'];
        DB::transaction(function () use ($id, $input){
            // 当前账号为综合服务商
            if(Admin::user()->isRole('service_provider')) {
                $service = ServiceShop::query()
                    ->lockForUpdate()
                    ->where('admin_id', Admin::user()->id)
                    ->first();
                if (!$service) {
                    throw new InternalException('当前账号未开通服务提供商，请联系平台管理员');
                }
                // 当前币种
                $current_coin = [];
                $data = $service->recharge_data;
                if (!$data) {
                    throw new InternalException('未开通当前币种充值权限');
                }
                foreach ($data as $k => $value) {
                    if (intval($value['currency_id']) === intval($input['currency_id'])) {
                        $current_coin['key'] = $k;
                        $current_coin['amount'] = $value['amount'];
                    }
                }
                if (!$current_coin) {
                    throw new InternalException('未开通当前币种充值权限');
                }
                if (comp($input['amount'], $current_coin['amount'])) {
                    throw new InternalException('当前额度不足，请联系平台充值');
                }
                // 扣除当前额度
                $data[$current_coin['key']]['amount'] = sub($current_coin['amount'], $input['amount']);
                $service->recharge_data = $data;
                $service->save();
                // 增加馆长额度
                $shop = Shop::query()->where('id', $id)->lockForUpdate()->first();
                $shop_data = $shop->quota_data;
                $coin = [];
                foreach ($shop_data as $k => $datum) {
                    if (intval($datum['currency_id']) === intval($input['currency_id'])) {
                        $coin['key'] = $k;
                        $coin['amount'] = $datum['amount'];
                    }
                }
                if ($coin) {
                    $shop_data[$coin['key']]['amount'] = add($coin['amount'], $input['amount']);
                } else {
                    $coin['currency_id'] = $input['currency_id'];
                    $coin['amount'] = $input['amount'];
                    $shop_data[] = $coin;
                }
                $shop->quota_data = $shop_data;
                $shop->save();
            } else {
                if (!Admin::user()->isRole('administrator')) {
                    throw new InternalException('非法充值！');
                }
            }
        });
        return $this
				->response()
				->success('操作成功')
				->refresh();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->select('currency_id', '选择货币')->options(function (){
            return Currency::query()->pluck('name', 'id');
        });
        $this->decimal('amount', '充值数量')->required();
    }

    /**
     * The data of the form.
     *
     * @return array
     */
    public function default()
    {
        return [
        ];
    }
}
