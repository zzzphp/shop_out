<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Category;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Category(), function (Grid $grid) {
            $grid->title->tree(false, false);
            $grid->column('id')->sortable();
            $grid->column('sort');
            $grid->column('name');
            $grid->column('describe');
            $grid->column('icon')->image('', 50, 50);
            $grid->column('is_show')->switch('success');
//            $grid->column('created_at');
//            $grid->column('updated_at')->sortable();

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
        return Show::make($id, new Category(), function (Show $show) {
            $show->field('id');
            $show->field('sort');
            $show->field('name');
            $show->field('describe');
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
        return Form::make(new Category(), function (Form $form) {
            if(Admin::user()->isRole('curator')) {
                $grid->model()->where('admin_id', Admin::user()->id);
            }
            $form->display('id');
            $form->number('sort');
            $form->select('parent_id')->options(function (){
               $categories = \App\Models\Category::query()
                   ->where('parent_id', 0)
                   ->pluck('name', 'id');
                if(!Admin::user()->isRole('curator')) {
                    $categories[0] = '顶级分类';
                }
                return $categories;
            });
            $form->text('name');
            $form->text('describe');
            $form->image('icon')->uniqueName();
            $form->switch('is_show')->default(true);
            $form->embeds('open_time', '开放时间',function ($form){
               $form->time('begin', '开始');
               $form->time('end', '结束');
            });
            $form->display('created_at');
            $form->display('updated_at');
        });
    }

    public function children(Request $request)
    {
        $category_id = $request->get('q');

        return \App\Models\Category::query()
                        ->where('parent_id', $category_id)
                        ->get(['id', DB::raw('name as text')]);
    }
}
