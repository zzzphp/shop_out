<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Recharges;
use App\Models\Currency;
use App\Models\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\Recharge;
use Dcat\Admin\Admin;

class RechargesController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Recharges::with(['user']), function (Grid $grid) {
            $grid->model()->orderBy('id', 'DESC');
            if(Admin::user()->isRole('agent')) {
               $grid->model()->whereHas('user', function($builder){
                   $builder->where('admin_id', Admin::user()->id);
               });
            }
            $grid->column('id')->sortable();
            $grid->column('user.idcard_data.name', '姓名')->copyable();
            $grid->column('user.phone', '账号')->copyable();
            $grid->column('currency');
//            $grid->column('chain');
            $grid->column('amount')->label('success');
            $grid->column('recharge_prove')->image('', 30,30);
            $grid->column('status')->display(function($value){
                return Recharge::$statusMap[$value];
            })->dot([
                Recharge::STATUS_PENDING => 'primary',
                Recharge::STATUS_SUCCESS => 'success',
                Recharge::STATUS_FALED   => 'danger',
            ]);
            $grid->column('created_at');
//            $grid->column('updated_at')->sortable();
            $grid->showQuickEditButton();

            $grid->actions(new \App\Admin\Actions\Grid\Recharges\AgreeVerify());

            $grid->actions(new \App\Admin\Actions\Grid\Recharges\RefuseVerify());
            // 禁用删除按钮
            $grid->disableDeleteButton();
            // 禁用编辑按钮
            $grid->disableEditButton();
            // 禁用批量删除按钮
            $grid->disableBatchDelete();
            // 禁用新增
//            $grid->disableCreateButton();
            $grid->enableDialogCreate();
            $grid->filter(function (Grid\Filter $filter) {
                // 展开过滤器
                $filter->expand();
                // 更改为 panel 布局
                $filter->panel();
                $filter->equal('currency_id', '币种')->select(function (){
                    return Currency::query()->pluck('name', 'id');
                })->width(4);
                $filter->equal('status', '审核状态')->select(Recharge::$statusMap)->width(5);
                $filter->equal('user.phone', '用户账号')->width(4);
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Recharges(), function (Show $show) {
            $show->field('id');
            $show->field('user_id');
            $show->field('currency');
            $show->field('chain');
            $show->field('amount');
            $show->field('recharge_prove');
            $show->field('status');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Recharges(), function (Form $form) {
            $form->display('id');
            $form->select('user_id', '充值用户')->options(function (){
                $values = [];
                $users = User::all();
                foreach ($users as $user) {
                    $values[$user->id] = $user->phone . " [ " . $user->name ."]";
                }
                return $values;
            })->placeholder('请选择要充值的用户')->required();
            $form->select('currency_id', '充值币种')->options(function (){
                $values = [];
                $currencies = Currency::all();
                foreach ($currencies as $currency) {
                    $values[$currency->id] = $currency->name;
                }
                return $values;
            })->placeholder('请选择币种')->required();
            $form->text('currency')->required();
            $form->text('chain')->required();
            $form->decimal('amount')->required();
            $form->text('remark')->default('后台手动充值');
            $form->image('recharge_prove')->default(env('APP_URL') . '/vendor/dcat-admin/images/logo.png')->required();
            $form->select('status')->options(function (){
                return [Recharge::STATUS_PENDING => '审核中'];
            })->default(Recharge::STATUS_PENDING)->required();;
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
