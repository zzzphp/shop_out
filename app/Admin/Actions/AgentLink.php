<?php

namespace App\Admin\Actions;

use Dcat\Admin\Actions\Action;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Dcat\Admin\Admin;

class AgentLink extends Action
{
    /**
     * @return string
     */
	protected $title = '+ 查看推广链接';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        // dump($this->getKey());

        //return $this->response()->success('Processed successfully.')->redirect('/');
    }

    /**
     * @return string|array|void
     */
    public function confirm()
    {
        return ['请复制推广链接', config('app.client_url') . '/#/pages/register/index?agent_id=' . Admin::user()->id];
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
