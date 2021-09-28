<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Distribute;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\Distribute as DistributeModel;
use App\Models\Product;

class DistributeController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Distribute::with('product'), function (Grid $grid) {
            $grid->model()->orderBy('day', 'desc');
            $grid->column('id')->sortable();
            // $grid->column('hask_key');
            $grid->column('day');
            $grid->column('product', '产品')->display(function($product){
                return "id:{$product->id}，产品名:{$product->title}，价格:{$product->price}";
            });
            $grid->column('total_amount');
            $grid->column('info');
            $grid->column('status')->display(function($value){
                return DistributeModel::$statusMap[$value];
            });
            $grid->actions(new \App\Admin\Actions\Grid\Distributes\LssueCurrency());
            //$grid->column('created_at');
            //$grid->column('updated_at')->sortable();
            $grid->disableDeleteButton();
            $grid->disableViewButton();
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
        return Show::make($id, new Distribute(), function (Show $show) {
            $show->field('id');
            $show->field('hask_key');
            $show->field('day');
            $show->field('product_id');
            $show->field('total_amount');
            $show->field('info');
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
        return Form::make(new Distribute(), function (Form $form) {
            $form->display('id');
            // $form->text('hask_key');
            $form->date('day')->rules('required');
            $form->select('product_id', '请选择矿机')->options(function(){
                $products = Product::all();
                $values = [];
                foreach ($products as $product) {
                    $values[$product->id] = "id:{$product->id}，产品名:{$product->title}，价格:{$product->price}";
                }
            
                return $values;
            });
            $form->decimal('total_amount')->rules('required');
            //$form->text('info');
            //$form->text('status');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
