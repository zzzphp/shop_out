<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\AssetDetail;
use App\Models\Currency;
use App\Models\User;
use App\Models\Wallet;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\AssetDetails;
use Dcat\Admin\Admin;
use Illuminate\Support\Facades\DB;

class AssetDetailController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(AssetDetail::with(['user', 'currency']), function (Grid $grid) {
            $grid->model()->orderBy('id','desc');
            if(Admin::user()->isRole('agent')) {
               $grid->model()->whereHas('user', function($builder){
                   $builder->where('admin_id', Admin::user()->id);
               });
            }
            if(isMobile()) {
                $grid->column('full_data', '数据')->display(function(){
                    $html = "<p><span style='color:blue;font-size:12px;'>账号:{$this->user->phone}</span></p>";
                    $html .= "<p style='font-size:12px;'>币种：{$this->currency->name}</p>";
                    $html .= "<p><span class='label' style='background:#21b978'>交易前：".$this->front_amount."</span></p>";
                    $html .= "<p><span class='label' style='background:#21b978'>交易量：".$this->amount."</span></p>";
                    $html .= "<p><span class='label' style='background:#DC143C'>交易后：".$this->after_amount."</span></p>";
                    $html .= "<p><span class='label' style='background:#21b978'>类型：".$this->type."</span></p>";
                });
            } else {
                $grid->column('id')->sortable();
                $grid->column('user.phone', '账号')->copyable();
                $grid->column('currency.name', '币种')->badge();
                $grid->column('front_amount')->badge('success');
                $grid->column('amount')->badge('success');
                $grid->column('after_amount')->badge('success');
                $grid->column('type')->display(function($value){
                    return AssetDetails::$typeMap[$value];
                })->badge('danger');
                $grid->column('remark')->limit(10);
                $grid->column('created_at');
            }
                $grid->enableDialogCreate();
                $grid->disableCreateButton();
                $grid->disableActions();
                // 禁用
                $grid->disableBatchActions();
            $grid->filter(function (Grid\Filter $filter) {
                // 更改为 panel 布局
                $filter->panel();
                 // 展开过滤器
                $filter->expand();

                $filter->equal('user.phone', '用户账号')->width(4);
                $filter->equal('type', '交易类型')->select(AssetDetails::$typeMap)->width(4);
                $filter->between('created_at', '按日期查询')->date()->width(8);
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
        return Show::make($id, new AssetDetail(), function (Show $show) {
            $show->field('id');
            $show->field('user_id');
            $show->field('currency_id');
            $show->field('front_amount');
            $show->field('amount');
            $show->field('after_amount');
            $show->field('type');
            $show->field('remark');
            $show->field('sign');
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
        return Form::make(new AssetDetail(), function (Form $form) {
            $form->display('id');
            $form->select('type')->options(AssetDetails::$typeMap)
                ->help('“注意：算力收益”、“释放收益”、“充值”、“佣金奖励”、“退还质押币” 为 增加。　　　　　　　　　　　　　　　　　　　　　　　　　　　　
                “提现”、“借贷扣款”、“质押扣款” 为 扣款。')
                ->required();
            $form->select('currency_id', '币种')->options(function (){
                $values = [];
                $currencies = Currency::all();
                foreach ($currencies as $currency) {
                    $values[$currency->id] = $currency->name;
                }
                return $values;
            })->placeholder('请选择币种')->required();
            $form->select('user_id', '用户')->options(function () use ($form){
                $values = [];
                $users = User::all();
                foreach ($users as $user) {
                    $values[$user->id] = $user->phone . " [ " . $user->name ."]";
                }
                return $values;
            })->placeholder('请选择用户')->required();
            $form->hidden('front_amount');
            $form->decimal('amount')->required();
            $form->hidden('after_amount');
            $form->text('remark');
            $form->display('created_at');
            $form->display('updated_at');
            $form->saving(function (Form $form){
                if ($form->isCreating()) {
                    // 判断增加 和 扣款操作
                    DB::beginTransaction();
                    try {
                        $sub = [AssetDetails::TYPE_WITHDRAWALS, AssetDetails::TYPE_LOAN, AssetDetails::TYPE_PLEDGE];
                        $wallet = Wallet::query()
                            ->where(['user_id' => $form->input('user_id'),
                                'currency_id' => $form->input('currency_id'),
                                'type' => Wallet::TYPE_COIN,
                            ])->first();
                        if (in_array($form->input('type'), $sub) && comp($form->input('amount'), $wallet->amount)) {
                            return $form->response()->error("当前用户钱包余额不足 ~");
                        }
                        $form->front_amount = $wallet->amount;
                        if (in_array($form->input('type'), $sub)) {
                            // 扣款操作
                            $wallet->amount = sub($wallet->amount, $form->input('amount'));

                        } else {
                            // 增加余额
                            $wallet->amount = add($wallet->amount, $form->input('amount'));
                        }
                        $form->after_amount = $wallet->amount;
                        $wallet->save();

                        DB::commit();
                    } catch (\Exception $exception) {
                        DB::rollBack();
                        return $form->response()->error($exception->getMessage());
                    }
                }
            });
        });
    }
}
