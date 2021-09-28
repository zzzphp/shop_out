<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\PowerDistribute;
use Carbon\Carbon;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\PowerDistribute as PowerDistributeModel;
use PhpParser\Node\Expr\FuncCall;

class PowerDistributeController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(PowerDistribute::with(['currency','stage']), function (Grid $grid) {
            $grid->model()->orderBy('dated', 'DESC');
            $grid->column('id')->sortable();
            // $grid->column('hash_key');
            $grid->column('type','经济模型')->display(function($value){
                // return $value;
                return PowerDistributeModel::$typeMap[$value];
            });
            $grid->column('currency.name','币种');
            $grid->column('stage.name','期数');
            $grid->column('dated');
            $grid->column('available_assets');
            $grid->column('num');
            $grid->column('last_dated');
            $grid->column('status')->display(function($status){
                return PowerDistributeModel::$statusMap[$status];
            });
            $grid->column('created_at');
            // $grid->column('updated_at')->sortable();

            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->append(new \App\Admin\Actions\Grid\Distributes\OnekeyPowerDistribute());
                // 获取当行数据是否 超时未发币
                $rowArray = $actions->row->toArray();
                if($rowArray['status'] === PowerDistributeModel::STATUS_PENDING) {
                    // 状态为发放中，判断是否超时
                    if(time() - strtotime($rowArray['updated_at']) >= 600) {
                        $actions->append(new \App\Admin\Actions\Grid\Distributes\TimeOutPowerDistribute());
                    }
                }
            });
            // 获取当行数据是否 超时未发币
            // $rowArray = $actions->row->toArray();
            // if($rowArray['status'] === PowerDistributeModel::STATUS_PENDING) {
            //     // 状态为发放中，判断是否超时
            //     if(time() - strtotime($rowArray['updated_at']) > 600) {
            //         $grid->actions(new \App\Admin\Actions\Grid\Distributes\OnekeyPowerDistribute());
            //     }
            // }
            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                // 展开过滤器
                $filter->expand();
                $filter->equal('currency.id', '币种')->select(function (){
                    $currencies = \App\Models\Currency::all();
                    $values = [];
                    foreach ($currencies as $curreny) {
                        $values[$curreny->id] = $curreny->name;
                    }
                    return $values;
                })->width(6);
                $filter->equal('stage.id', '期数')->select(function (){
                    return  \App\Models\Stage::query()->pluck('name', 'id');
                })->width(4);
                $filter->date('dated', '收益日期')->width(3);
                $filter->date('last_dated', '释放日期')->width(3);
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
        return Show::make($id, new PowerDistribute(), function (Show $show) {
            $show->field('id');
            $show->field('hash_key');
            $show->field('currency_id');
            $show->field('stage_id');
            $show->field('dated');
            $show->field('available_assets');
//            $show->field('mortgage_advance');
//            $show->field('mortgage_user');
            $show->field('num');
            $show->field('last_dated');
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
        return Form::make(new PowerDistribute(), function (Form $form) {
            $form->display('id');
            $form->select('type','经济模型')
                ->options(PowerDistributeModel::$typeMap)->when(PowerDistributeModel::TYPE_LINE, function(Form $form){
                    $form->number('first')->rules(['min:0|max:100']);
                    $form->number('line_day')->rules('numeric');
            })->rules('required')->default(PowerDistributeModel::TYPE_DIRECT);
            // $form->text('hash_key');
            $form->select('currency_id')->options(function($value){
                // $currency = \App\Models\Currency::find($value);
                // return [$value=>$currency->name];
                $currencies = \App\Models\Currency::all();
                $values = [];
                foreach ($currencies as $curreny) {
                    $values[$curreny->id] = $curreny->name;
                }
                return $values;
            })->rules('required');
            $form->select('stage_id')->options(function($value){
                // $currency = \App\Models\Currency::find($value);
                // return [$value=>$currency->name];
                $stages = \App\Models\Stage::all();
                $values = [];
                foreach ($stages as $stage) {
                    $values[$stage->id] = $stage->name;
                }
                return $values;
            })->rules('required');
            $form->date('dated')->default(Carbon::yesterday()->toDateString());
            $form->decimal('available_assets');
            $form->select('status')->options(PowerDistributeModel::$statusMap)->default(PowerDistributeModel::STATUS_NONE);

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
