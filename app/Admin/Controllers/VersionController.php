<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Version;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class VersionController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Version(), function (Grid $grid) {
            $grid->model()->orderBy('id', 'DESC');
            $grid->column('id')->sortable();
            $grid->column('new_version');
            $grid->column('min_version');
            $grid->column('url');
//            $grid->column('update_description');
            $grid->column('size');
//            $grid->column('md5file');
//            $grid->column('terminal');
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
        return Show::make($id, new Version(), function (Show $show) {
            $show->field('id');
            $show->field('new_version');
            $show->field('min_version');
            $show->field('url');
            $show->field('update_description');
            $show->field('size');
            $show->field('md5file');
            $show->field('terminal');
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
        return Form::make(new Version(), function (Form $form) {
            $form->display('id');

            $form->text('new_version')->required();
            $form->text('min_version')->required();
            $form->text('url')->type('url')->required();
            $form->textarea('update_description')->required();
            $form->text('size')->required();
//            $form->text('md5file');
//            $form->text('terminal');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
