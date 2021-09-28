<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\LoanCreateTool;
use App\Admin\Actions\LoanDetailedModal;
use App\Admin\Actions\LoanDetailedTable;
use App\Admin\Repositories\Loan;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class LoanController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Loan::with(['user', 'currency']), function (Grid $grid) {
            $grid->toolsWithOutline(false);
            $grid->model()->orderBy('last_dated', 'DESC');
            $grid->column('id')->sortable();
            $grid->column('user.name', '姓名');
            $grid->column('user.phone', '账号');
            $grid->column('currency.name', '币种');
            $grid->column('total_amount');
            $grid->column('to_be_returned')->label('danger');
            $grid->column('already_interest')->display(function ($value){
                return $value ?: 0.00;
            })->label('success');
            $grid->column('count');
            $grid->column('interest_rate')->display(function ($value){
                return floatval($value) . " %";
            });
            $grid->post
                ->display('查看')
                ->modal('还款明细',function ($modal){
                return LoanDetailedTable::make();
            });
            $grid->column('profit_rate')->display(function ($value){
                return floatval($value) . " %";
            })->help('按照百分比收取每日收益的数量');
            $grid->column('last_dated');
            $grid->column('status')->display(function ($value){
                return \App\Models\Loan::$statusMap[$value];
            })->dot([
                \App\Models\Loan::STATUS_PENDING => 'primary',
                \App\Models\Loan::STATUS_SUCCESS => 'success',
            ]);

            $grid->disableCreateButton();
            $grid->disableBatchActions();
//            $grid->disableEditButton();
//            $grid->disableDeleteButton();
            $grid->disableActions();

            // 传入闭包
            $grid->tools(function (Grid\Tools $tools) {
                $tools->append(new LoanCreateTool());
            });
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
        return Show::make($id, new Loan(), function (Show $show) {
            $show->field('id');
            $show->field('already_interest');
            $show->field('count');
            $show->field('currency_id');
            $show->field('interest_rate');
            $show->field('last_dated');
            $show->field('status');
            $show->field('to_be_returned');
            $show->field('total_amount');
            $show->field('user_id');
            $show->field('created_at');
            $show->field('updated_at');

            $show->disableDeleteButton();
            $show->disableEditButton();
            $show->disableQuickEdit();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Loan(), function (Form $form) {
            $form->display('id');
            $form->text('already_interest');
            $form->text('count');
            $form->text('currency_id');
            $form->text('interest_rate');
            $form->text('last_dated');
            $form->text('status');
            $form->text('to_be_returned');
            $form->text('total_amount');
            $form->text('user_id');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
