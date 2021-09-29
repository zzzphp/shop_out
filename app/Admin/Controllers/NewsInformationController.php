<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\NewsInformation;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class NewsInformationController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new NewsInformation(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('author');
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
        return Show::make($id, new NewsInformation(), function (Show $show) {
            $show->field('id');
            $show->field('author');
            $show->field('content');
            $show->field('resource');
            $show->field('resource_id');
            $show->field('resource_url');
            $show->field('summary');
            $show->field('thumbnail');
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
        return Form::make(new NewsInformation(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->text('author');
            $form->image('thumbnail');
            $form->editor('content');
            $form->text('resource');
            $form->hidden('resource_id')->value(0);
            $form->hidden('summary')->value(0);
            $form->text('resource_url');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
