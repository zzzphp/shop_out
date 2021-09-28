<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\News;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class NewsController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new News(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('type')->display(function($value){
                return \App\Models\News::$typeMap[$value];
            })->badge();;
            $grid->column('title')->limit(20, '...');
            // $grid->column('content');
            // $grid->column('looks');
            // $grid->column('stars');
            // $grid->column('look_up');
            // $grid->column('look_down');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
            
            $grid->disableViewButton();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->equal('type')->Select(\App\Models\News::$typeMap);
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
        return Show::make($id, new News(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('type');
            $show->field('content');
            $show->field('looks');
            $show->field('stars');
            $show->field('look_up');
            $show->field('look_down');
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
        return Form::make(new News(), function (Form $form) {
            $form->select('type')->options(\App\Models\News::$typeMap);
            $form->display('id');
            $form->text('title');
            $form->editor('content');
            $form->number('stars')->attribute('min', 0)->attribute('max', 5);
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
