<?php

namespace App\Admin\Actions\Grid;

use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Admin\Forms\SetProfitDateForm;
use Dcat\Admin\Widgets\Modal;

class SetProfitDate extends RowAction
{
    
    
    /**
     * @return string
     */
	protected $title = '设置收益日期';

    public function render()
    {
        // 实例化表单类并传递自定义参数
        $form = SetProfitDateForm::make()->payload(['id' => $this->getKey()]);

        return Modal::make()
            ->lg()
            ->title($this->title)
            ->body($form)
            ->button($this->title);
    }
    /**
     * @param Model|Authenticatable|HasPermissions|null $user
     *
     * @return bool
     */
    protected function authorize($user): bool
    {
        return true;
    }

    /**
     * @return array
     */
    protected function parameters()
    {
        return [];
    }
}
