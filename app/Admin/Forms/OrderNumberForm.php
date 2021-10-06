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
        $this->textarea('address', '收货信息');
    }

    /**
     * The data of the form.
     *
     * @return array
     */
    public function default()
    {
        $order = Order::where('id', $this->payload['id'])->first();
        $express_data = $order->express_data;
        $address_data = $order->address;
        $address = "联系姓名：{$address_data['contact_name']}\r\n联系电话：{$address_data['contact_phone']}\r\n收货地址：{$address_data['full_address']}";
        return [
            'company'  => $express_data['company'] ?? '',
            'number'  => $express_data['number'] ?? '',
            'address' => $address,
        ];
    }
}
