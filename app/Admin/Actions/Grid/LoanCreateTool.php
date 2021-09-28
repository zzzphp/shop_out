<?php

namespace App\Admin\Actions\Grid;

use App\Admin\Forms\LoanCreateForm;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\Tools\AbstractTool;
use Dcat\Admin\Traits\HasPermissions;
use Dcat\Admin\Widgets\Modal;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LoanCreateTool extends AbstractTool
{
    /**
     * @return string
     */
	protected $title = '添加借款信息';

    protected $style = 'btn btn-white waves-effect';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        return $this->response()
            ->success('Processed successfully.')
            ->redirect('/');
    }

    public function render()
    {

        $form = LoanCreateForm::make()->payload(['id' => $this->getKey()]);

        return Modal::make()
            ->lg()
            ->title($this->title)
            ->body($form)
            ->button(' <a class="btn btn-white waves-effect">＋ '.$this->title.'</a>');
    }

    /**
     * @return string|void
     */
    protected function href()
    {
        // return admin_url('auth/users');
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
