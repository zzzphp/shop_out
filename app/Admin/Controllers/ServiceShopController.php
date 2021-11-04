<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\Shops\Recharge;
use App\Admin\Repositories\ServiceShop;
use App\Models\Currency;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Support\Facades\DB;

class ServiceShopController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new ServiceShop(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('phone');
//            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
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
        return Show::make($id, new ServiceShop(), function (Show $show) {
            $show->field('id');
            $show->field('admin_id');
            $show->field('name');
            $show->field('phone');
            $show->field('recharge_data');
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
        return Form::make(new ServiceShop(), function (Form $form) {
            $form->display('id');
            $form->select('admin_id', '请绑定管理员')->options(function (){
                $roles = DB::table('admin_role_users')
                    ->where('role_id', 10)->pluck('user_id')->toArray();
                return DB::table('admin_users')
                    ->whereIn('id', $roles)
                    ->pluck('name', 'id');
            })->required();
            $form->text('name')->required();
            $form->text('phone')->required();
            $form->array('recharge_data','货币额度', function ($table) {
                $table->select('currency_id', '货币')->options(function (){
                    return Currency::query()->pluck('name', 'id');
                });
                $table->decimal('amount','当前额度');
            })->required();
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
