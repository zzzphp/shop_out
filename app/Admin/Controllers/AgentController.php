<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Agent;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\Agent as AgentModel;
use App\Models\AdminUser;
use Illuminate\Support\Facades\DB;
use Dcat\Admin\Admin;

class AgentController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Agent::with(['admin']), function (Grid $grid) {
            if(Admin::user()->isRole('agent')) {
                   $agent = AgentModel::where('admin_id', Admin::user()->id)->first();
                   // 是否具有开通代理功能
                   if(!$agent->ability) {
                       // 隐藏所有操作按钮
                       $grid->toolsWithOutline(false);
                       // 禁用
                        $grid->disableCreateButton();
                   }
                   $grid->model()->where('admin_parent_id', Admin::user()->id);
            } else {
                $grid->title->tree(); // 开启树状表格功能
            }

            if(isMobile()) {

                $grid->column('full_data', '数据')->display(function(){
                    $html = "<p><span class='badge' style='background:#6d8be6'>商户类型：".AgentModel::$typeMap[$this->type]."</span></p>";
                    $html .= "<p>姓名：{$this->name}</p>";
                    $html .= "<p style='font-size:12px;'>电话：{$this->phone}</p>";
                    $html .= "<p><span class='badge' style='background:#ea5455'>代理返佣:".$this->sales_ratio."%</span></p>";
                    $html .= "<p>代理账号：{$this->admin->username}</p>";
                    return $html;
                });
            } else {
                $grid->column('id')->sortable();
                $grid->column('type')->display(function($value){
                    return AgentModel::$typeMap[$value];
                })->badge();
                $grid->column('name');
                $grid->column('address')->limit(28, '...');
                $grid->column('phone')->copyable();
                // $grid->column('legal_person');
                $grid->column('admin.username', '代理账号')->copyable();
                // $grid->column('image');
                $grid->column('sales_ratio', '返佣比率')->display(function($value){
                    return $value ? $value : 0 . '%';
                })->badge('danger');
                $grid->column('ability')->bool();
                $grid->column('created_at');
            }


            $grid->filter(function (Grid\Filter $filter) {
                // 更改为 panel 布局
                $filter->panel();
                 // 展开过滤器
                $filter->expand();
                $filter->equal('name', '姓名（公司名）')->width(4);
                $filter->equal('admin.username', '代理账号')->width(4);
            });
            // 如果没有权限则隐藏所有
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
        return Show::make($id, new Agent(), function (Show $show) {
            $show->field('id');
            $show->field('type');
            $show->field('name');
            $show->field('address');
            $show->field('phone');
            $show->field('legal_person');
            $show->field('idcard');
            $show->field('image');
            $show->field('ability');
            $show->field('admin_id');
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
        return Form::make(Agent::with(['admin']), function (Form $form) {
            $form->display('id');
            $form->radio('type')->options(AgentModel::$typeMap)->when(AgentModel::TYPE_COMPANY, function (Form $form) {
                $form->text('legal_person');
            })->rules('required');
            $form->text('name', '公司(个人)姓名')->rules('required');
            $form->text('address')->rules('required');
            $form->text('phone')->rules('required');
            $form->text('idcard')->rules('required');
            $form->image('image')->rules('required');
            $form->number('sales_ratio', '返佣比率(%)')->default(0)->rules('required|min:0');
            $form->hidden('admin_id');
            $form->hidden('admin_parent_id');
            $form->hidden('parent_id');
            $form->switch('ability')->default(true);
            $form->display('created_at');
            $form->display('updated_at');

            // 代理账号信息
            $form->text('admin.username', '账号')->rules('required');
            $form->text('admin.name', '姓名')->rules('required');
            $form->hidden('admin.password')->default('$2y$10$GQR4N7KVSd78pjA1NN1z7ONzO9Lf5eJ4q0wU5yKyMxOgnQKf3j17K');

            $form->saving(function (Form $form) {
                // 判断是否是新增操作
                if ($form->isCreating()) {
                    DB::transaction(function () use ($form) {
                        // 新增操作增加管理员
                        $admin_id = AdminUser::insertGetId([
                            'username' => $form->admin['username'],
                            'name'     => $form->admin['name'],
                            'password' => $form->admin['password']
                            ]);
                        // 添加关联用户表
                        Db::table('admin_role_users')->insert(['role_id' => 2, 'user_id' => $admin_id]);
                        if(!$admin_id) {
                            // 中断后续逻辑
                            return $form->response()->error('新增管理员失败，请重试');
                        }
                        // 赋值给当前表单，绑定管理员账号
                        $form->admin_id = $admin_id;
                        $form->admin_parent_id = Admin::user()->id;
                        // 绑定当前层级关系
                        if(Admin::user()->isRole('agent')) {
                            // 如果当前用户为代理
                            $form->parent_id = AgentModel::where('admin_id', Admin::user()->id)->value('id');
                        } else {
                            $form->parent_id = 0;
                        }
                    });
                    if(!$form->parent_id) {
                       $form->parent_id = 0;
                    }

                }
            });
            // 删除事件
            $form->deleting(function (Form $form) {
                DB::transaction(function () use ($form) {
                    $data = current($form->model()->toArray());
                    // 删除管理员关联关系
                    Db::table('admin_role_users')->where(['user_id' => $data['admin_id']])->delete();
                    // 删除管理员
                    AdminUser::destroy($data['admin_id']);
                    // 清除所有用户代理标识
                    User::where('admin_id', $data['admin_id'])->update(['admin_id' => 0]);
                });
            });

        });
    }
}
