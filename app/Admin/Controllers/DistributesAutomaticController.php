<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Batchs\Automatic\AmountEditBatch;
use App\Admin\Repositories\DistributesAutomatic;
use App\Models\Currency;
use App\Models\PowerDistribute;
use App\Models\PowerDistribute as PowerDistributeModel;
use App\Models\Stage;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class DistributesAutomaticController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(DistributesAutomatic::with(['stage', 'currency']), function (Grid $grid) {
            $currency_id = Currency::query()->value('id');
            if (!$grid->filter()->input('currency_id')) {
                $grid->model()->where('currency_id', $currency_id);
            }
            $grid->column('id')->sortable();
            $grid->column('type')->display(function ($value){
                return PowerDistribute::$typeMap[$value];
            });
            $grid->column('currency.name', '币种');
            $grid->column('stage.name', '期数');
            $grid->column('amount')->editable();
            $grid->column('formula');
            $grid->column('dated');
//            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
            $grid->batchActions([
                new AmountEditBatch(),
            ]);
            $grid->filter(function (Grid\Filter $filter) use ($currency_id) {
                // 更改为 panel 布局
                $filter->panel();
                // 展开过滤器
                $filter->expand();
                $filter->equal('currency_id', '币种')->select(function () use ($currency_id){
                    return Currency::query()->pluck('name', 'id');
                })->width(4)->default($currency_id);
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
        return Show::make($id, new DistributesAutomatic(), function (Show $show) {
            $show->field('id');
            $show->field('type');
            $show->field('currency_id');
            $show->field('stage_id');
            $show->field('amount');
            $show->field('formula');
            $show->field('dated');
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
        return Form::make(new DistributesAutomatic(), function (Form $form) {
            $form->display('id');
            $form->select('type','经济模型')
                ->options(PowerDistributeModel::$typeMap)->when(PowerDistributeModel::TYPE_LINE, function(Form $form){
                    $form->number('first', '首次释放( % )')->rules(['min:0|max:100']);
                    $form->number('line_day', '线性释放( 天 )')->rules('numeric');
                })->rules('required')->default(PowerDistributeModel::TYPE_DIRECT);
            $form->select('currency_id','币种')->options(function (){
                return Currency::query()->pluck('name', 'id');
            });
            $form->select('stage_id', '期数')->options(function (){
                return Stage::query()->pluck('name', 'id');
            });
            $form->text('amount');
            $form->text('formula');
            $form->date('dated');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
