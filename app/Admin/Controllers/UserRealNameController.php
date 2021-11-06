<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Tables\UserAddressTable;
use App\Admin\Actions\Tables\UserCollectionTable;
use App\Models\User;
use App\Models\UserAddress;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class UserRealNameController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new User(), function (Grid $grid) {
            if(Admin::user()->isRole('curator')) {
                $grid->model()->where('admin_id', Admin::user()->id);
            }
            if(Admin::user()->isRole('service_provider')) {
                $grid->model()->whereIn('admin_id', parent::getShopAdminId());
            }
            $grid->model()->orderBy('id','DESC');
            if (!$grid->filter()->input('status')) {
                $grid->model()->where('status', User::STATUS_AUDITING);
            }
            $grid->column('id')->sortable();
            $grid->column('name')->title()->title();
            $grid->column('phone');
            $grid->column('names', '查看认证信息')
                ->display('信息') // 设置按钮名称
                ->modal(function ($modal) {
                    // 设置弹窗标题
                    $modal->title('实名信息 '.$this->name);
                    // 自定义图标
                    $modal->icon('feather icon-x');
                    $data = $this->idcard_data;
                    if($data) {
                        if (!isset($data['video'])) {
                            $data['video'] = '';
                        }
                        return
<<<EOT
<div style='padding:10px 10px 0'>真实姓名：{$data['name']}</br></br>身份证号码：{$data['idcard']}</br></br>
                        <image src='{$data['front_photo']}' width='400px'>
                        </br></br>
                        <image src='{$data['back_photo']}' width='300px'>
                        </div>
<div style='padding:10px 10px 0'>
<video width="320" height="240" controls>
  <source src="{$data['video']}" type="video/mp4">
您的浏览器不支持Video标签。
</video>
</div>
EOT;
                    } else {
                        return "<div style='padding:10px 10px 0'>该账户未提交实名信息</div>";
                    }
                });
            $grid->column('addresses', '收货地址')
                ->display('查看')
                ->modal('收货地址',function ($modal){
                    return UserAddressTable::make();
            });
            $grid->column('collections', '收款信息')
                ->display('查看')
                ->modal('收款信息',function ($modal){
                    return UserCollectionTable::make();
                });
            $grid->column('status','认证状态')->select(User::$statusMap);
            $grid->disableActions();
            $grid->disableCreateButton();
            $grid->disableDeleteButton();
            $grid->disableBatchActions();
            $grid->disableEditButton();
            $grid->disableViewButton();
            $grid->column('updated_at')->sortable();
            $grid->paginate(10);
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
                $filter->equal('status', '认证状态')
                    ->default(User::STATUS_AUDITING)
                    ->select(User::$statusMap)->width(4);
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
        return Show::make($id, new User(), function (Show $show) {
            $show->field('id');
            $show->field('idcard_data');
            $show->field('name');
            $show->field('phone');
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
        return Form::make(new User(), function (Form $form) {
            $form->display('id');
            $form->text('idcard_data');
            $form->text('name');
            $form->text('phone');
            $form->text('status');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
