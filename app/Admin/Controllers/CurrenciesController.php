<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Currencies;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class CurrenciesController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Currencies(), function (Grid $grid) {
            $grid->model()->orderBy('sort', 'ASC');
            $grid->column('id')->sortable();
            $grid->column('sort')->sortable();
            $grid->column('type')->display(function($value){
                return \App\Models\Currency::$typeMap[$value];
            });
            $grid->column('icon')->image('', 30,30);
            $grid->column('name');
            $grid->column('description');
            $grid->column('is_show')->switch();
            // $grid->column('updated_at')->sortable();
            $grid->disableDeleteButton();
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
        return Show::make($id, new Currencies(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('description');
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
        return Form::make(new Currencies(), function (Form $form) {
            $form->display('id');
            $form->number('sort')->default(0);
            $form->select('type')->options(\App\Models\Currency::$typeMap)->rules('required');
            $form->image('icon')->uniqueName()->rules('required');
            $form->text('name')->rules('required');
            $form->text('description')->rules('required');
            $form->array('address_data', function ($table) {
                $table->text('chain','支付名称');
                $table->textarea('data','数据');
                $table->image('qrcode', '收款二维码')->uniqueName();
            })->required();
            $form->array('chains', function ($table) {
                $table->text('chain','币种名称')->required();
                $table->decimal('min_amount','最小数量')->required();
                $table->decimal('service_charge','手续费')->required();
            })->required();
            $form->hidden('is_show')->default(true);
            // $form->display('created_at');
            // $form->display('updated_at');
        });
    }
}
