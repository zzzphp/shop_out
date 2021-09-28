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
        Order::query()
            ->where('id', $id)
            ->limit(1)
            ->update(['remark' => $input['remark']]);
        return $this
				->response()
				->success('备注成功.')
				->refresh();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->textarea('remark')->required();
    }

    /**
     * The data of the form.
     *
     * @return array
     */
    public function default()
    {
        $data = Order::where('id', $this->payload['id'])->value('remark');
        return [
            'remark'  => $data,
        ];
    }
}
