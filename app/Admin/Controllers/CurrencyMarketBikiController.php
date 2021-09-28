<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\CurrencyMarketBiki;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class CurrencyMarketBikiController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new CurrencyMarketBiki(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('symbol');
            $grid->column('image')->image('', 50, 50);

            $grid->quickSearch(['symbol']);
            $grid->showQuickEditButton();
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
        return Show::make($id, new CurrencyMarketBiki(), function (Show $show) {
            $show->field('id');
            $show->field('symbol');
            $show->field('image');
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
        return Form::make(new CurrencyMarketBiki(), function (Form $form) {
            $form->display('id');
            $form->text('symbol');
            $form->image('image')->uniqueName();
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
