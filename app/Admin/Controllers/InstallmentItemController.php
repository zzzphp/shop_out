<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\InstallmentPayFailed;
use App\Admin\Actions\Grid\InstallmentPaySuccess;
use App\Admin\Repositories\InstallmentItem;
use App\Models\Installment;
use App\Models\InstallmentItem as Model;
use App\Models\Order;
use Carbon\Carbon;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class InstallmentItemController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(InstallmentItem::with(['installment.order', 'installment.user']), function (Grid $grid) {

            $due_date = Carbon::now();
            $grid->model()
                ->orWhere(function ($builder) use ($due_date){
                        $builder->whereDate('due_date', '<=',$due_date->toDateString())
                            ->where('status', \App\Models\InstallmentItem::STATUS_PENDING);
                    })
                ->orWhere(function ($builder) use ($due_date){
                    $builder->where('status', \App\Models\InstallmentItem::STATUS_PENDING)
                    ->whereBetween('due_date', [$due_date->toDateString(), $due_date->addDays(7)->toDateString()]);
                })->orWhere(function ($builder) use ($due_date){
                    $builder->where('status', \App\Models\InstallmentItem::STATUS_PROCESSING);
                });
            $grid->column('id')->sortable();
            $grid->column('installment.user.phone', '账号');
            $grid->column('sequence')->display(function ($value){
                return $value + 1 . ' 期';
            });
            $grid->column('base')->label('success');
            $grid->column('due_date');
            $grid->column('paid_at');
//            $grid->column('payment_method');
//            $grid->column('refund_status');
            $grid->column('pay_prove')->image('', 50, 50);
            $grid->column('status')->display(function ($value){
                return Model::$statusMap[$value];
            })->dot(
                [
                    Model::STATUS_PENDING => 'primary',
                    Model::STATUS_FAILED => 'danger',
                    Model::STATUS_SUCCESS => 'success',
                    Model::STATUS_PROCESSING => Admin::color()->primary(),
                ],
                'primary' // 第二个参数为默认值
            );
            $grid->column('created_at');

            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->append(new InstallmentPaySuccess());
                $actions->append(new InstallmentPayFailed());
            });

            $grid->disableCreateButton();
            $grid->disableDeleteButton();
            $grid->disableEditButton();
            $grid->disableBatchActions();
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
        return Show::make($id, new InstallmentItem(), function (Show $show) {
            $show->disableEditButton();
            $show->disableDeleteButton();
            $show->disableQuickEdit();

            $show->field('id');
            $show->field('installment_id');
            $show->field('sequence');
            $show->field('base');
            $show->field('due_date');
            $show->field('paid_at');
            $show->field('payment_method');
            $show->field('refund_status');
            $show->field('pay_prove');
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
        return Form::make(new InstallmentItem(), function (Form $form) {
            $form->display('id');
            $form->text('installment_id');
            $form->text('sequence');
            $form->text('base');
            $form->text('due_date');
            $form->text('paid_at');
            $form->text('payment_method');
            $form->text('refund_status');
            $form->text('pay_prove');
            $form->text('status');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
