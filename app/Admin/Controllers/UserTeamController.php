<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\UserTeam;
use App\Models\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Admin\Actions\UserAchievement;

class UserTeamController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new UserTeam(), function (Grid $grid) {
//            $grid->column('id')->sortable();
            $grid->title->tree(true); // 开启树状表格功能
            $grid->column('grade')->display(function ($value){
                return User::$gradeMap[$value];
            });
            $grid->column('phone');

            $grid->column('name')->display(function ($value){
                return $value?: '未实名';
            });
            $grid->column('info', '信息');
            $grid->post('查看业绩')->modal(function (Grid\Displayers\Modal $modal) {
                $modal->title('查看业绩');
                // 允许在闭包内返回异步加载类的实例
                return UserAchievement::make(['title' => $this->title]);
            });
            $grid->column('is_effective', '是否有效')->bool();
            $grid->disableBatchActions();
            $grid->disableActions();
            $grid->disableCreateButton();
            $grid->paginate(10);
            $grid->filter(function (Grid\Filter $filter) {
                // 更改为 panel 布局
                $filter->panel();
                // 展开过滤器
                $filter->expand();
                $filter->equal('phone', '账号')->width(4);
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
        return Show::make($id, new UserTeam(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('phone');
            $show->field('grade');
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
        return Form::make(new UserTeam(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->text('phone');
            $form->text('grade');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
