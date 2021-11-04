<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\Shops\AchievementTable;
use App\Admin\Actions\Grid\Shops\QuickLogin;
use App\Admin\Actions\Grid\Shops\Recharge;
use App\Admin\Repositories\Shop;
use App\Models\Currency;
use App\Models\ServiceShop;
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
            if(Admin::user()->isRole('service_provider')) {
                $grid->model()->where('service_id', Admin::user()->id);
            }
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('name');
            $grid->column('phone');
            $grid->column('logo')->image('', '', 50);
            $grid->post('业绩明细')
                ->display('查看')
                ->modal('业绩明细',function ($modal){
                    return AchievementTable::make();
                });
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
            if(!Admin::user()->isRole('administrator') && !Admin::user()->isRole('service_provider')) {
                $grid->disableCreateButton();
                $grid->disableBatchActions();
                $grid->disableFilterButton();
            }
            $grid->disableDeleteButton();
            if(Admin::user()->isRole('service_provider')) {
                $grid->actions(new Recharge());
            }
            if(!Admin::user()->isRole('curator') && !Admin::user()->isRole('service_provider')) {
                $grid->actions(new QuickLogin());
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
        return Show::make($id, new Shop(), function (Show $show) use ($id) {
            $show->field('id');
            $show->field('name');
            $show->field('phone');
            $show->field('title');
            $show->content('额度')->as(function () use ($id){
                $service = \App\Models\Shop::find($id);
                $label = "";
                foreach ($service->quota_data as $data) {
                    $label .= Currency::where('id', $data['currency_id'])->value('name') . ":";
                    $label .= $data['amount'] . "  ";
                }

                return "$label";
            });
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
            $form->select('admin_id', '请绑定管理员')->options(function ($value){
                $shops = \App\Models\Shop::query()
                    ->where('admin_id', '<>', $value)
                    ->pluck('admin_id');
                $roles = DB::table('admin_role_users')
                    ->where('role_id', 5)->pluck('user_id')->toArray();
                return DB::table('admin_users')
                    ->whereNotIn('id', $shops)
                    ->whereIn('id', $roles)->pluck('name', 'id');
            });
            $form->select('service_id', '所属综合服务商')->options(function ($value){
                $services = ServiceShop::query()
                    ->where('admin_id', '<>', $value)
                    ->pluck('admin_id');
                $roles = DB::table('admin_role_users')
                    ->where('role_id', 10)->pluck('user_id')->toArray();
                return DB::table('admin_users')
                    ->whereNotIn('id', $services)
                    ->whereIn('id', $roles)->pluck('name', 'id');
            });
            $form->text('title');
            $form->text('name');
            $form->text('phone');
            $form->image('logo');
            if(Admin::user()->isRole('administrator')) {
                $form->array('quota_data','货币额度', function ($table) {
                    $table->select('currency_id', '货币')->options(function (){
                        return Currency::query()->pluck('name', 'id');
                    });
                    $table->decimal('amount','当前额度');
                })->required();
            }
            $form->array('collection', function ($table) {
                $table->text('chain','支付名称');
                $table->textarea('data','数据');
                $table->image('qrcode', '收款二维码')->uniqueName();
            })->required();
            $form->disableViewButton();
            $form->disableDeleteButton();
        });
    }
}
