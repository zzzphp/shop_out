<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Ally;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\Ally as AllyModel;

class AllyController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Ally::with(['user']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('user.phone', '用户账号');
            $grid->column('name');
            $grid->column('phone');
            $grid->column('address');
            $grid->column('ability')->display(function($value){
                return $value ? '是':'否';
            });
            $grid->column('status')->display(function($value){
                return AllyModel::$statusMap[$value];
            });
            
            
            $grid->disableDeleteButton();
            $grid->disableEditButton();
            $grid->actions(new \App\Admin\Actions\Grid\allies\AllyAgree());
            $grid->column('created_at');
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
        return Show::make($id, new Ally(), function (Show $show) {
            $show->field('id');
            $show->field('user_id');
            $show->field('name');
            $show->field('phone');
            $show->field('address');
            $show->field('ability');
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
        return Form::make(new Ally(), function (Form $form) {
            $form->display('id');
            $form->text('user_id');
            $form->text('name');
            $form->text('phone');
            $form->text('address');
            $form->text('ability');
            $form->text('status');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
