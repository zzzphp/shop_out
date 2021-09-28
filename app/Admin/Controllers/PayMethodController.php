<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\PayMethod;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\PayMethod  as PayModel;

class PayMethodController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new PayMethod(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('sort');
            $grid->column('name');
            $grid->column('e_name');
            $grid->column('icon')->image('', 50, 50);
//            $grid->column('info');
//            $grid->column('created_at');
//            $grid->column('updated_at')->sortable();

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
        return Show::make($id, new PayMethod(), function (Show $show) {
            $show->field('id');
            $show->field('sort');
            $show->field('name');
            $show->field('e_name');
            $show->field('info');
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
        return Form::make(new PayMethod(), function (Form $form) {
            $form->display('id');
            $form->number('sort');
            $form->text('name');
            $form->text('e_name');
            $form->image('icon')->uniqueName();
            $form->radio('type')->options(PayModel::$typeMap)
                ->when(PayModel::TYPE_REAL, function (Form $form){
                    $form->table('real_info', function($table){
                        $table->text('name', '户名')->required();
                        $table->text('account', '账号')->required();
                        $table->text('bank', '开户行')->required();
                    })->rules('required');
                })->when([PayModel::TYPE_DIGITAL, PayModel::TYPE_LEGAL], function (Form $form){
                    $form->table('info', function($table){
                        $table->text('title', '链名');
                        $table->text('value', '地址');
                        $table->image('image', '二维码')->uniqueName()->saveFullUrl();
                    });
                })->when([PayModel::TYPE_LEGAL, PayModel::TYPE_REAL], function (Form $form){
                    $form->decimal('rate')->value(usdtAmount())->default(usdtAmount());
                })->required();

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
