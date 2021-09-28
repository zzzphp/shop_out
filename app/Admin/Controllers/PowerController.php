<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Power;
use App\Models\Stage;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class PowerController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Power::with(['user', 'currency', 'stage']), function (Grid $grid) {
            $grid->column('id')->sortable();
//            $grid->column('hash_key');
            $grid->column('user.phone', '账号')->copyable();
            $grid->column('currency.name', '币种')->badge();
            $grid->column('stage.name', '期数');
            $grid->column('power')->label('success');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->disableDeleteButton();
            $grid->disableBatchActions();
            $grid->disableActions();
            $grid->disableCreateButton();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                // 展开过滤器
                $filter->expand();
                $filter->equal('user.phone', '账号')->width(4);
                $filter->equal('stage.id', '期数')->select(function (){
                    $stages = Stage::all();
                    $values = [];
                    foreach ($stages as $stage) {
                        $values[$stage->id] = $stage->name;
                    }
                    return $values;
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
        return Show::make($id, new Power(), function (Show $show) {
            $show->field('id');
            $show->field('hash_key');
            $show->field('user_id');
            $show->field('currency_id');
            $show->field('stage_id');
            $show->field('power');
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
        return Form::make(new Power(), function (Form $form) {
            $form->display('id');
            $form->text('hash_key');
            $form->text('user_id');
            $form->text('currency_id');
            $form->text('stage_id');
            $form->text('power');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
