<?php

namespace App\Admin\Forms;

use App\Models\DistributesAutomatic;
use Dcat\Admin\Traits\LazyWidget;
use Dcat\Admin\Widgets\Form;
use Dcat\Admin\Contracts\LazyRenderable;

class AutomaticEditForm extends Form implements LazyRenderable
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
         $id = explode(",", $input['id']);
         DistributesAutomatic::query()->whereIn('id', $id)
                            ->update(['amount' => $input['amount']]);
         return $this->response()->success('设置成功，请检查参数')->refresh();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->hidden('id')->attribute('id', 'edit-amount-id');
        $this->decimal('amount')->required();
    }

}
