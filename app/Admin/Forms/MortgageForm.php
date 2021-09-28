<?php

namespace App\Admin\Forms;

use App\Models\Order;
use Dcat\Admin\Contracts\LazyRenderable;
use Dcat\Admin\Widgets\Form;
use Dcat\Admin\Traits\LazyWidget;

class MortgageForm extends Form implements LazyRenderable
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
//         dump($input);
        // return $this->response()->error('Your error message.');
        Order::query()
            ->where('id', $this->payload['id'])
            ->limit(1)
            ->update(['mortgage' => $input]);
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
        $this->decimal('user', '用户质押')->required();
        $this->decimal('platform', '平台质押')->required();
    }

    /**
     * The data of the form.
     *
     * @return array
     */
    public function default()
    {
        $mortgage = Order::query()->where('id', $this->payload['id'])->value('mortgage');
        return [
            'user' => $mortgage['user'] ?? 0,
            'platform' => $mortgage['platform'] ?? 0,
        ];
    }
}
