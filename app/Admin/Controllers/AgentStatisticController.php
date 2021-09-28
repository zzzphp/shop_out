<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\AgentStatistic;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Admin;

class AgentStatisticController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(AgentStatistic::with(['agent.admin']), function (Grid $grid) {
            if(Admin::user()->isRole('agent')) {
                $grid->model()->whereHas('agent', function($builder){
                    $builder->where('admin_id', Admin::user()->id);
                });
            }
            $grid->export();
            
            
            if(isMobile()) {
                $grid->column('full_data', '数据')->display(function(){
                    // $html = "<p><span class='badge' style='background:#6d8be6'>统计日期：".$this->dated."</span></p>";
                    $html  = "<p>日期：{$this->dated}</p>";
                    $html .= "<p>代理账号：<span style='color:blue'>{$this->agent->admin->username}</span></p>";
                    $html .= "<p>新用户：{$this->users_count}</p>";
                    $html .= "<p>订单数：{$this->orders_count}</p>";
                    $html .= "<p><span class='label' style='background:#21b978'>销售业绩：".$this->amount."</span></p>";
                    return $html;
                });
            } else {
                $grid->column('id')->sortable();
                $grid->column('dated');
                $grid->column('agent.admin.username', '代理账号')->display(function($value){
                    return "<span style='color:blue'>$value</span>";
                });
                $grid->column('agent.name', '代理名');
                $grid->column('users_count');
                $grid->column('orders_count');
                $grid->column('amount')->label('success');
                // $grid->column('payment_type');
                $grid->column('created_at');
                // $grid->column('updated_at')->sortable();
            }
            $grid->disableActions();
            $grid->disableCreateButton();
            // 禁用批量删除按钮
            $grid->disableBatchDelete();
            $grid->filter(function (Grid\Filter $filter) {
                // 更改为 panel 布局
                $filter->panel();
                 // 展开过滤器
                $filter->expand();
                $filter->equal('agent.admin.username', '代理账号')->width(3);
                $filter->equal('agent.name', '代理名')->width(3);
                $filter->between('dated')->date()->width(8);
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
        return Show::make($id, new AgentStatistic(), function (Show $show) {
            $show->field('id');
            $show->field('admin_id');
            $show->field('agent_id');
            $show->field('currency_id');
            $show->field('users_count');
            $show->field('orders_count');
            $show->field('amount');
            $show->field('payment_type');
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
        return Form::make(new AgentStatistic(), function (Form $form) {
            $form->display('id');
            $form->text('admin_id');
            $form->text('agent_id');
            $form->text('currency_id');
            $form->text('users_count');
            $form->text('orders_count');
            $form->text('amount');
            $form->text('payment_type');
            $form->text('dated');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
