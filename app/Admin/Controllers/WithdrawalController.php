<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Withdrawal;
use App\Models\Currency;
use App\Models\User;
use App\Models\Wallet;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Widgets\Card;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\Withdrawal as WithdrawalModel;
use Dcat\Admin\Admin;

class WithdrawalController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Withdrawal::with(['user','currency']), function (Grid $grid) {
            $grid->model()->orderBy('id', 'DESC');
            if(Admin::user()->isRole('curator')) {
               $grid->model()->whereHas('user', function($builder){
                   $builder->where('admin_id', Admin::user()->id);
               });
            }
            $grid->column('user.idcard_data.name','姓名');
            $grid->column('user.phone','账号')->copyable();
            $grid->column('currency.name','币种')->badge();
            $grid->column('amount')->copyable()->badge('success');
            $grid->column('service_charge')->badge('danger');
            $grid->column('actual_amount')->copyable()->badge('success');
            $grid->column('status')->display(function($value){
                return WithdrawalModel::$statusMap[$value];
            })->dot(
                [
                    WithdrawalModel::STATUS_PENDING => 'primary',
                    WithdrawalModel::STATUS_FAILED => 'danger',
                    WithdrawalModel::STATUS_SUCCESS => 'success',
                ],
                'primary' // 第二个参数为默认值
            );
            $grid->column('created_at');
            $grid->column('coin_address')->display('查看') // 设置按钮名称
            ->expand(function () {
                // 返回显示的详情
                // 这里返回 content 字段内容，并用 Card 包裹起来
                $s = '';
                $data = $this->coin_address;
                switch ($data['type']) {
                    case 'bank':
                        $data['type'] = '银行收款';
                        break;
                    case 'alipay':
                        $data['type'] = '支付宝收款';
                        break;
                    case 'weixin':
                        $data['type'] = '微信收款';
                        break;
                }
                foreach ($data as $item) {
                    $s .= '<br>' . $item;
                }
                $card = new Card(null, $s);
                return "<div style='padding:10px 10px 0'>$card</div>";
            });
            // $grid->column('updated_at')->sortable();
            $grid->actions(new \App\Admin\Actions\Grid\Withdrawals\WithdrawalsAgree());
            $grid->actions(new \App\Admin\Actions\Grid\Withdrawals\WithdrawalsReject());
            $grid->actions(new \App\Admin\Actions\Grid\Withdrawals\WithdrawalsRemark());
            // 禁用编辑按钮
            $grid->disableEditButton();
            // 禁用删除按钮
            $grid->disableDeleteButton();
            // 禁用
            $grid->disableBatchActions();
            // 禁用
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
                $filter->equal('status', '审核状态')->select(WithdrawalModel::$statusMap)->width(5);
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
        return Show::make($id, new Withdrawal(), function (Show $show) {
            $show->field('id');
            $show->field('user_id');
            $show->field('currency_id');
            $show->field('chain');
            $show->field('coin_address');
            $show->field('amount');
            $show->field('service_charge');
            $show->field('actual_amount');
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
        return Form::make(new Withdrawal(), function (Form $form) {
            $form->display('id');
            $form->select('user_id', '提币用户')->options(function (){
                $values = [];
                $users = User::all();
                foreach ($users as $user) {
                    $values[$user->id] = $user->phone . " [ " . $user->name ."]";
                }
                return $values;
            })->placeholder('请选择要提币的用户')->required();
            $form->select('currency_id', '提币币种')->options(function (){
                $values = [];
                $currencies = Currency::all();
                foreach ($currencies as $currency) {
                    $values[$currency->id] = $currency->name;
                }
                return $values;
            })->placeholder('请选择币种')->required();
            $form->text('chain')->required();
            $form->text('coin_address')->required();
            $form->decimal('amount')->required();
            $form->text('service_charge')->required();
            $form->text('actual_amount')->required();
            $form->select('status')->options(function (){
                return [WithdrawalModel::STATUS_PENDING => '审核中'];
            })->default(WithdrawalModel::STATUS_PENDING)->required();;

            $form->display('created_at');
            $form->display('updated_at');

            $form->saving(function (Form $form){
                if (($form->service_charge + $form->actual_amount) != $form->amount) {
                    return $form->response()->error('提币数不正确，请检查！');
                }
                if ($form->isCreating()) {
                    $wallet = Wallet::where(['user_id' => $form->user_id, 'currency_id' => $form->currency_id])->first();
                    if($wallet->amount < $form->amount) {
                        return $form->response()->error('当前可用资产不足');
                    }
                    // 增加 冻结资产 减少 可用资产
                    $wallet->amount = sub($wallet->amount, $form->amount);
                    $wallet->frozen_amount = add($wallet->frozen_amount, $form->amount);
                    $wallet->save();
                }
            });
        });
    }
}
