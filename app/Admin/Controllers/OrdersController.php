<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\OrderForceRelease;
use App\Admin\Actions\Grid\OrderTakeGoods;
use App\Admin\Actions\Grid\OrderUnlock;
use App\Admin\Repositories\Orders;
use App\Models\Currency;
use App\Models\Product;
use App\Models\Stage;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Admin;
use App\Models\Order;
use Dcat\Admin\Tree\RowAction;

class OrdersController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Orders::with(['currency', 'product.stage', 'user']), function (Grid $grid) {
            if(Admin::user()->isRole('curator')) {
                $grid->model()->whereHas('product', function($builder){
                    $builder->where('admin_id', Admin::user()->id);
                });
            }
            if(Admin::user()->isRole('service_provider')) {
                $grid->model()->whereHas('product', function($builder){
                    $builder->where('admin_id', parent::getShopAdminId());
                });
            }
            $grid->column('id');

            $grid->model()
//                ->whereHas('product', function ($query){
//                    $query->where('type', Product::TYPE_ROB);
//                })
                ->whereNotNull('paid_at')
                ->where('closed', false)
                ->orderBy('id', 'desc');

                $grid->column('user.idcard_data.name', '姓名');
                $grid->column('user.phone', '账号')->copyable();
//                $grid->column('currency.name', '币种')->badge();
//                $grid->column('product.stage.name', '期数');
                $grid->column('product.type', '订单类型')->display(function ($title){
                   return Product::$typeMap[$title];
                });
                $grid->column('product.title', '产品名')->limit(6, '...');
                $grid->column('amount')->label('success');
                $grid->column('total_amount')->label('success');
                $grid->column('paid_at');
                $grid->column('paid_prove')->image('', 50,50);
                $grid->column('payment_method')->badge();
                $grid->column('status')->display(function($value){
                    return \App\Models\Order::$statusMap[$value];
                })->dot(
                    [
                        Order::STATUS_PENDING => 'primary',
                        Order::STATUS_FAILED => 'danger',
                        Order::STATUS_SUCCESS => 'success',
                        Order::STATUS_RELEASE => Admin::color()->blue1(),
                        Order::STATUS_WAIT_GOODS => Admin::color()->yellow(),
                        Order::STATUS_COMPLETE_SELL => Admin::color()->success(),
                    ],
                    'primary' // 第二个参数为默认值
                );
            $grid->actions(function (Grid\Displayers\Actions $actions){
                  if (in_array($actions->row->status, [Order::STATUS_WAIT_GOODS, Order::STATUS_RECEIVING])) {
                      $actions->append(new \App\Admin\Actions\Grid\OrderWriteNumber());
                  }
                  if ($actions->row->status === Order::STATUS_RELEASE && $actions->row->product->type === Product::TYPE_ROB) {
                      $actions->append(new \App\Admin\Actions\Grid\OrderPaidVerifyRow());
                      $actions->append(new \App\Admin\Actions\Grid\OrderPaidFailedRow());
                  }
                  if ($actions->row->status === Order::STATUS_LOCK) {
                      $actions->append(new OrderUnlock());
                  }
                  if ($actions->row->status === Order::STATUS_SUCCESS) {
                        $actions->append(new OrderTakeGoods());
                  }
                  if ($actions->row->status === Order::STATUS_RELEASE && $actions->row->product->type === Product::TYPE_AUCTION) {
                    $actions->append(new OrderForceRelease());
                  }
                $actions->append(new \App\Admin\Actions\Grid\OrderRemark());
            });
            if(Admin::user()->isRole('service_provider')) {
                $grid->disableActions();
            }
            // 禁用编辑按钮
            $grid->disableEditButton();
            // 禁用删除按钮
            $grid->disableDeleteButton();
            $grid->disableCreateButton();
            $grid->disableViewButton();
            // 导出功能
            $grid->export();
            $grid->export()->rows(function (array $rows){
                foreach ($rows as $k => $row) {
                    $rows[$k]['status'] = Order::$statusMap[$row['status']];
                }
                return $rows;
            });
            $grid->filter(function (Grid\Filter $filter) {
                // 更改为 panel 布局
                $filter->panel();
                 // 展开过滤器
                $filter->expand();
                $filter->equal('user.phone', '用户账号')->width(4);
                $filter->equal('status', '支付状态')->width(4)->select(Order::$statusMap)->width(4);;
                $filter->equal('currency_id', '币种')->select(function (){
                    return Currency::query()->pluck('name', 'id');
                })->width(4);
                $filter->equal('product.type', '订单类型')->select(function (){
                    return Product::$typeMap;
                })->width(4);
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
        return Show::make($id, new Orders(), function (Show $show) {
            $show->field('id');
            $show->field('no');
            $show->field('user_id');
            $show->field('currency_id');
            $show->field('product_id');
            $show->field('amount');
            $show->field('total_amount');
            $show->field('remark');
            $show->field('paid_at');
            $show->field('paid_prove');
            $show->field('payment_method');
            $show->field('closed');
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
        return Form::make(new Orders(), function (Form $form) {
            $form->display('id');
            $form->text('no');
            $form->text('user_id');
            $form->text('currency_id');
            $form->text('product_id');
            $form->text('amount');
            $form->text('total_amount');
            $form->text('remark');
            $form->text('paid_at');
            $form->text('paid_prove');
            $form->text('payment_method');
            $form->text('closed');
            $form->text('status');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
