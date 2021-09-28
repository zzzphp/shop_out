<?php

namespace App\Admin\Forms;

use Dcat\Admin\Widgets\Form;
use Dcat\Admin\Contracts\LazyRenderable;
use Dcat\Admin\Models\Administrator;
use Dcat\Admin\Traits\LazyWidget;
use App\Models\Order;
use Illuminate\Foundation\Auth\User;

class SetProfitDateForm extends Form implements LazyRenderable
{

    use LazyWidget; // 使用异步加载功能
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
        if ($input['end'] <= $input['begin']) {
            return $this->response()->error('结束日期 必须大于 开始日期~');
        }
        $data = ['begin' => $input['begin'], 'end' => $input['end']];
        Order::query()
            ->where('id', $id)
            ->limit(1)
            ->update(['profit_data' => $data]);
        return $this
				->response()
				->success('设置成功：' . $id)
				->refresh();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->date('begin', '收益开始')->required();
        $this->date('end', '收益结束')->required();
    }

    /**
     * The data of the form.
     *
     * @return array
     */
    public function default()
    {
        $data = Order::query()
            ->where('id', $this->payload['id'])
            ->limit(1)
            ->value('profit_data');
        return [
            'begin'  => $data['begin'] ?? '',
            'end' => $data['end'] ?? '',
        ];
    }
}
