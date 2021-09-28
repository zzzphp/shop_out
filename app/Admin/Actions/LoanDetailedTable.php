<?php

namespace App\Admin\Actions;

use App\Models\LoanDetailed;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;
use Dcat\Admin\Widgets\Table;

class LoanDetailedTable extends LazyRenderable
{
    /**
     * @return string
     */
	public function grid(): Grid
    {
        $loan_id = $this->key;

        return Grid::make(new LoanDetailed(), function(Grid $grid) use ($loan_id){
            $grid->model()->where('loan_id', $loan_id);
            $grid->column('id');
            $grid->column('total_amount', '今日总收益');
            $grid->column('to_be_returned', '待还款');
            $grid->column('amount', '本次还款');
            $grid->column('profit_rate', '还款比率')->display(function ($value){
                return floatval($value) . " %";
            });;
            $grid->column('interest', '利息');
            $grid->column('interest_rate', '日利率')->display(function ($value){
                return floatval($value) . " %";
            });
            $grid->paginate(10);
            $grid->disableActions();

            $grid->filter(function (Grid\Filter $filter){
                $filter->expand();
                $filter->between('dated', '还款日')->date()->width(6);
            });
        });
    }


}
