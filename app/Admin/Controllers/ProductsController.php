<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Products;
use App\Models\Category;
use App\Models\Currency;
use App\Models\PayMethod;
use App\Models\Product;
use App\Models\Stage;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ProductsController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Products::with(['currency','stage']), function (Grid $grid) {
            if(Admin::user()->isRole('curator')) {
                $grid->model()->where('admin_id', Admin::user()->id);
            }
            $grid->model()->where('type', Product::TYPE_ROB);
            $grid->column('id')->sortable();
            $grid->column('image')->image('', 50, 50);
            $grid->column('title')->display(function ($title){
                return "【". Product::$typeMap[$this->type] ."】" . $title;
            });
            $grid->column('original_price');
            $grid->column('price');
            // $grid->column('attributes');
            // $grid->column('detail');
            //$grid->column('begin_at');
            //$grid->column('end_at');
            $grid->column('stock');
            $grid->column('on_sale')->switch();
            // $grid->column('created_at');
            // $grid->column('updated_at')->sortable();
            $grid->disableViewButton();
            $grid->filter(function (Grid\Filter $filter) {
                // 更改为 panel 布局
                $filter->panel();
                // 展开过滤器
                $filter->expand();
                $filter->equal('stage.id', '期数')->select(function (){
                    return Stage::query()->pluck('name', 'id');
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
        return Show::make($id, new Products(), function (Show $show) {
            $show->field('id');
            $show->field('currency_id');
            $show->field('image');
            $show->field('title');
            $show->field('description');
            $show->field('original_price');
            $show->field('price');
            $show->field('attributes');
            $show->field('detail');
            $show->field('begin_at');
            $show->field('end_at');
            $show->field('stock');
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
        return Form::make(new Products(), function (Form $form) {
            $form->display('id');
//            $form->select('', '顶级分类')->options(function($value){
//                return \App\Models\Category::all()
//                    ->where('parent_id', 0)
//                    ->pluck('name', 'id');
//            })->load('category_id', 'children');
            $form->select('category_id', '产品分类')
                ->options(function ($value){
//                    $parent_id = Category::query()
//                        ->where('id', $value)
//                        ->value('parent_id');
                    $builder =  \App\Models\Category::query()
                        ->where('parent_id', 1);
                    if (Admin::user()->isRole('curator')) {
                        $builder->where('admin_id', Admin::user()->id);
                    }
                    return $builder->pluck('name', 'id');
                })
                ->required();
            $form->text('title')->required();
            $form->hidden('amount')->value(1);
            $form->image('image')->uniqueName()->required();
            $form->text('original_price')->required();
            $form->text('price')->required();
            $form->hidden('admin_id');
            $form->array('attributes', function($form){
                $form->column(8, function ($form){
                    $form->text('title', '属性标题');
                    $form->text('value', '属性值');
                    $form->text('mark',  '备注信息');
                });
                $form->column(4, function ($form){
                    $form->color('color', '颜色')->default("#333333")->value("#333333");
                    $form->switch('bold', '加粗');
                    $form->select('show', '位置')
                        ->options(['all' => '全部', 'list' => '列表', 'detail' => '详情']);
                });
            })->required();
//            $form->time('begin_at')->required();
//            $form->time('end_at')->required();
            $form->number('stock')->required();
            $form->editor('description')->required();
            $form->editor('detail')->required();
            $form->switch('on_sale','是否上架')->default(1);
            $form->disableViewButton();
            $form->saving(function (Form $form){
                if($form->attributes) {
                    $arr = [];
                    foreach ($form->attributes as $k => $item) {
                        if($item['title'] || $item['value']) {
                            $arr[] = $item;
                        }
                    }
                    $form->attributes = $arr;
                }
                if(Admin::user()->isRole('curator')) {
                    $form->admin_id = Admin::user()->id;
                }
            });
        });
    }
}
