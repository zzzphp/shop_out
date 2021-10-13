<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Users;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\User;
use App\Admin\Actions\UserWallets;
use Dcat\Admin\Admin;
use Dcat\Admin\Widgets\Card;
use Dcat\Admin\Widgets\Modal;

class UsersController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Users::with(['admin']), function (Grid $grid) {
            if(Admin::user()->isRole('curator')) {
               $grid->model()->where('admin_id', Admin::user()->id);
            }
            $grid->tools(new \App\Admin\Actions\AgentLink());
            $grid->model()->orderBy('id','DESC');

            if(isMobile()) {
                $grid->column('phone')->copyable();
                $grid->column('name', '实名信息')
                ->display('信息') // 设置按钮名称
                ->modal(function ($modal) {
                    // 设置弹窗标题
                    $modal->title('实名信息 '.$this->name);
                    // 自定义图标
                    $modal->icon('feather icon-x');
                    $data = $this->idcard_data;
                    if($data) {
                        return "<div style='padding:10px 10px 0'>真实姓名：{$data['name']}</br></br>身份证号码：{$data['idcard']}</br></br>
                        <image src='{$data['front_photo']}' width='400px'>
                        </br></br>
                        <image src='{$data['back_photo']}' width='300px'>
                        </div>";
                    } else {
                        return "<div style='padding:10px 10px 0'>该账户未提交实名信息</div>";
                    }

                });
                // $grid->column('status','认证状态')->select(\App\Models\User::$statusMap);
                // $grid->post->display('查看钱包')->modal('', UserWallets::make());
                // 可以在闭包内返回异步加载类的实例
                // $grid->post->modal(function ($modal) {
                //     $modal->title('查看钱包');
                //     // 允许在闭包内返回异步加载类的实例
                //     return UserWallets::make(['title' => $this->title]);
                // });
            } else {
//                $grid->column('grade', '等级')->display(function($value){
//                   return $value ? User::$gradeMap[$value] : 'Lv0';
//                });
                $grid->column('id')->sortable();
                $grid->column('name');
                $grid->column('avatar')->image('', 30,30);
                $grid->column('admin.username','所属')->display(function($value){
                    return $value ? $value.'[会馆]' : '总平台';
                });
                $grid->column('phone')->copyable();
                $grid->column('names', '查看认证信息')
                ->display('信息') // 设置按钮名称
                ->modal(function ($modal) {
                    // 设置弹窗标题
                    $modal->title('实名信息 '.$this->name);
                    // 自定义图标
                    $modal->icon('feather icon-x');
                    $data = $this->idcard_data;
                    if($data) {
                        return "<div style='padding:10px 10px 0'>真实姓名：{$data['name']}</br></br>身份证号码：{$data['idcard']}</br></br>
                        <image src='{$data['front_photo']}' width='400px'>
                        </br></br>
                        <image src='{$data['back_photo']}' width='300px'>
                        </div>";
                    } else {
                        return "<div style='padding:10px 10px 0'>该账户未提交实名信息</div>";
                    }

                });
                $grid->column('status','认证状态')->display(function ($value){
                    return User::$statusMap[$value];
                });
                // $grid->post->display('查看钱包')->modal('', UserWallets::make());
                // 可以在闭包内返回异步加载类的实例
                $grid->post->modal(function (Grid\Displayers\Modal $modal) {
                    $modal->title('查看钱包');
                    $modal->xl();
                    // 允许在闭包内返回异步加载类的实例
                    return UserWallets::make(['title' => $this->title]);
                });
                $grid->column('updated_at')->sortable();

            }
            $grid->disableActions();
            $grid->disableEditButton();
            // 禁用删除按钮
            $grid->disableDeleteButton();
            // $grid->disableActions();
            $grid->disableBatchDelete();
            $grid->disableCreateButton();
            $grid->filter(function (Grid\Filter $filter) {
                // 更改为 panel 布局
                $filter->panel();
                 // 展开过滤器
                $filter->expand();
                $filter->like('name')->width(4);
                $filter->equal('phone', '用户账号')->width(4);
                $filter->where('idcard_data', function ($builder){
                    $value = trim(json_encode($this->input), '"');
                    $builder->where('idcard_data', 'like', "%{$value}%");
                })->width(4);
                $filter->newline();
                $filter->equal('status', '认证状态')->select(User::$statusMap)->width(4);

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
        return Show::make($id, new Users(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->avatar()->image();
            $show->field('phone');
            $show->field('idcard_data.name', '认证姓名');
            $show->field('idcard_data.idcard', '身份证号码');
            $show->field('idcard_data.front_photo', '身份证背面')->image();
            $show->field('idcard_data.back_photo', '身份证反面')->image();

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
        return Form::make(new Users(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->text('phone');
            $form->image('avatar');
            $form->embeds('idcard_data', function($form){
                $form->text('name');
                $form->text('idcard', '身份证号码');// ->url('upload/files')->saveFullUrl();
                $form->file('front_photo', '正面照')->url('upload/files')->saveFullUrl();
                $form->file('back_photo', '背面照')->url('upload/files')->saveFullUrl();
            });
            $form->select('status', '身份状态')->options(\App\Models\User::$statusMap);
        });
    }
}
