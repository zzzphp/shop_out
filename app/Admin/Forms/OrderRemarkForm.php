<?php

namespace App\Admin\Forms;

use App\Models\Order;
use Dcat\Admin\Contracts\LazyRenderable;
use Dcat\Admin\Traits\LazyWidget;
use Dcat\Admin\Widgets\Form;

class OrderRemarkForm extends Form implements LazyRenderable
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
        $remrks = $order->remark;
        $remrks[] = "平台：{$input['remark']}";
        $order->remark = $remrks;
        $order->save();
        return $this
				->response()
				->success('成功.')
				->refresh();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->textarea('remarks')->disable();
        $this->text('remark')->required();
    }

    /**
     * The data of the form.
     *
     * @return array
     */
    public function default()
    {
        $data = Order::where('id', $this->payload['id'])->value('remark');
        $data = $data ? implode("\r\n", $data) : '';
        return [
            'remarks'  => $data,
        ];
    }
}
