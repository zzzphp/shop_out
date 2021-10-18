<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Shop;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Support\Facades\DB;

class ShopController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Shop(), function (Grid $grid) {
            if(Admin::user()->isRole('curator')) {
                $grid->model()->where('admin_id', Admin::user()->id);
            }
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('name');
            $grid->column('phone');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
            if(!Admin::user()->isRole('admin')) {
                $grid->disableCreateButton();
                $grid->disableActions();
                $grid->disableBatchActions();
            }
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
        return Show::make($id, new Shop(), function (Show $show) {
            $show->field('id');
            $show->field('admin_id');
            $show->field('collection');
            $show->field('logo');
            $show->field('name');
            $show->field('phone');
            $show->field('title');
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
        return Form::make(new Shop(), function (Form $form) {
            $form->display('id');
            $form->select('admin_id')->options(function (){
                $roles = DB::table('admin_role_users')
                    ->where('role_id', 5)->pluck('user_id')->toArray();
                return DB::table('admin_users')
                    ->whereIn('id', $roles)->pluck('name', 'id');
            });
            $form->text('title');
            $form->text('name');
            $form->text('phone');
            $form->image('logo');
            $form->array('collection', function ($table) {
                $table->text('chain','支付名称');
                $table->textarea('data','数据');
                $table->image('qrcode', '收款二维码')->uniqueName();
            })->required();
        });
    }
}
