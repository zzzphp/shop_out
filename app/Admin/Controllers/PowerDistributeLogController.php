<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\PowerDistributeLog;
use App\Models\Currency;
use App\Models\Stage;
use App\Models\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class PowerDistributeLogController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(PowerDistributeLog::with(['user', 'currency','stage', 'powerDistribute']), function (Grid $grid) {
            $grid->model()->orderBy('dated', 'DESC');
            $grid->column('id')->sortable();
            $grid->column('user.phone','账号')->copyable();
            $grid->column('currency.name','币种');
            $grid->column('stage.name', '期数');
            // $grid->column('power_distribute_id');
            $grid->column('dated');
            $grid->column('power');
            $grid->column('all');
            $grid->column('lock');
            $grid->column('unlock');
            $grid->column('powerDistribute.last_dated', '释放日期');
            $grid->column('num', '释放次数');
            $grid->column('created_at');
//            $grid->column('updated_at')->sortable();

            // 禁用
            // $grid->disableCreateButton();
            $grid->disableActions();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->equal('currency.id', '币种')->select(function (){
                    return  \App\Models\Currency::query()->pluck('name', 'id');
                });
                $filter->equal('stage.id', '期数')->select(function (){
                    return  \App\Models\Stage::query()->pluck('name', 'id');
                });
                $filter->equal('power')->integer();
                $filter->like('user.phone','账号搜索');
                $filter->date('dated');
                $filter->date('powerDistribute.last_dated', '释放日期');
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
        return Show::make($id, new PowerDistributeLog(), function (Show $show) {
            $show->field('id');
            $show->field('user_id');
            $show->field('currency_id');
            $show->field('stage_id');
            $show->field('power_distribute_id');
            $show->field('dated');
            $show->field('power');
            $show->field('all');
            $show->field('lock');
            $show->field('unlock');
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
        return Form::make(new PowerDistributeLog(), function (Form $form) {
            $form->display('id');
            $form->select('user_id', '收益账号')->options(function (){
                $values = [];
                $users = User::all();
                foreach ($users as $user) {
                    $values[$user->id] = $user->phone . " [ " . $user->name ."]";
                }
                return $values;
            })->placeholder('请选择收益的用户')->required();
            $form->select('currency_id', '币种')->options(function (){
                $values = [];
                $currencies = Currency::all();
                foreach ($currencies as $currency) {
                    $values[$currency->id] = $currency->name;
                }
                return $values;
            })->placeholder('请选择币种')->required();
            $form->select('stage_id')->options(function (){
                $values = [];
                $stages = Stage::all();
                foreach ($stages as $stage) {
                    $values[$stage->id] = $stage->name;
                }
                return $values;
            })->required();
            $form->number('power_distribute_id')->required();
            $form->number('power')->required();
            $form->date('dated')->required();
            $form->decimal('all')->required();
            $form->decimal('lock')->required();
            $form->decimal('unlock')->required();

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
