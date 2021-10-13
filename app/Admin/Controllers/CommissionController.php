<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Commission;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\Commission as CommissionModel;

class CommissionController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Commission::with(['order', 'user']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('order.no', '订单流水号');
            $grid->column('user.name', '奖励用户');
            $grid->column('user.phone', '手机号');
            $grid->column('level')->display(function($value){
                return CommissionModel::$levelMap[$value];
            });
            $grid->column('amount');
            $grid->column('status')->display(function($value){
                return CommissionModel::$statusMap[$value];
            });
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
            $grid->disableActions();
            $grid->disableCreateButton();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

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
        return Show::make($id, new Commission(), function (Show $show) {
            $show->field('id');
            $show->field('order_id');
            $show->field('user_id');
            $show->field('level');
            $show->field('amount');
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
        return Form::make(new Commission(), function (Form $form) {
            $form->display('id');
            $form->text('order_id');
            $form->text('user_id');
            $form->text('level');
            $form->text('amount');
            $form->text('status');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
