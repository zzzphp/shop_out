<?php

namespace App\Admin\Actions\Batchs\Automatic;

use App\Admin\Forms\AutomaticEditForm;
use App\Admin\Forms\MortgageForm;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\BatchAction;
use Dcat\Admin\Traits\HasPermissions;
use Dcat\Admin\Widgets\Modal;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AmountEditBatch extends BatchAction
{
    /**
     * @return string
     */
	protected $title = '批量修改收益数量';

	protected $id;

    public function render()
    {
        $form = AutomaticEditForm::make();
        return Modal::make()
            ->lg()
            ->title($this->title)
            ->body($form)
            ->onLoad($this->getModalScript())
            ->button($this->title);
    }

    protected function getModalScript()
    {
        // 弹窗显示后往隐藏的id表单中写入批量选中的行ID
        return <<<JS
        // 获取选中的ID数组
        var key = {$this->getSelectedKeysScript()}

        $('#edit-amount-id').val(key);
        JS;
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		// return ['Confirm?', 'contents'];
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
