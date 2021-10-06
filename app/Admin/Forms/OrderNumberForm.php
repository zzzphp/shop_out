<?php

namespace App\Admin\Forms;

use App\Models\Order;
use Dcat\Admin\Contracts\LazyRenderable;
use Dcat\Admin\Traits\LazyWidget;
use Dcat\Admin\Widgets\Form;

class OrderNumberForm extends Form implements LazyRenderable
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
        $order = Order::find($id);
        $order->express_data = ['company' => $input['company'], 'number' => $input['number']];
        $order->status = Order::STATUS_RECEIVING;
        $order->save();
        return $this
				->response()
				->success('发货成功.')
				->refresh();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->text('company', '物流公司')->required();
        $this->text('number', '订单号')->required();
    }

    /**
     * The data of the form.
     *
     * @return array
     */
    public function default()
    {
        $data = Order::where('id', $this->payload['id'])->value('express_data');
        return [
            'company'  => $data['company'] ?? '',
            'number'  => $data['number'] ?? '',
        ];
    }
}
