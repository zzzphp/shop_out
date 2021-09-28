<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Carousel;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class CarouselController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Carousel(), function (Grid $grid) {
            $grid->model()->orderBy('sort');
            // $grid->column('id')->sortable();
            $grid->column('sort')->sortable();
            $grid->column('name');
            $grid->column('image')->image('', 50,50);
            $grid->column('link');
            // $grid->column('created_at');
            // $grid->column('updated_at')->sortable();
        
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
        return Show::make($id, new Carousel(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('image');
            $show->field('link');
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
        return Form::make(new Carousel(), function (Form $form) {
            // $form->display('id');
            $form->number('sort');
            $form->text('name')->rules('required');
            $form->image('image')->rules('required');
            $form->text('link')->rules('required');
        
            // $form->display('created_at');
            // $form->display('updated_at');
        });
    }
}
