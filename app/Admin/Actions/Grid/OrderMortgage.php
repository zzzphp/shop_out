<?php

namespace App\Admin\Actions\Grid;

use App\Admin\Forms\MortgageForm;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Dcat\Admin\Widgets\Modal;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OrderMortgage extends RowAction
{

    public function render()
    {
        $form = MortgageForm::make()->payload(['id' => $this->getKey()]);

        return Modal::make()
            ->lg()
            ->title($this->title)
            ->body($form)
            ->button($this->title);
    }

    /**
     * @return string
     */
	protected $title = '设置质押币';

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
