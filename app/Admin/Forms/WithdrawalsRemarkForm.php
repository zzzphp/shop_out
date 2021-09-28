<?php

namespace App\Admin\Forms;

use App\Models\Withdrawal;
use Dcat\Admin\Contracts\LazyRenderable;
use Dcat\Admin\Traits\LazyWidget;
use Dcat\Admin\Widgets\Form;

class WithdrawalsRemarkForm extends Form implements LazyRenderable
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
        Withdrawal::query()
            ->where('id', $this->payload['id'])
            ->limit(1)
            ->update(['remark' => $input['remark']]);
        return $this
				->response()
				->success('操作成功！')
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
        return [
            'remark'  => Withdrawal::query()
                ->where('id', $this->payload['id'])
                ->limit(1)
                ->value('remark'),
        ];
    }
}
