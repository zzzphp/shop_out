<?php


namespace App\Admin\Actions\Grid\Shops;


use App\Models\LoanDetailed;
use App\Models\Shop;
use App\Models\ShopsAchievement;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid;

use Dcat\Admin\Grid\LazyRenderable;
use Dcat\Admin\Widgets\Table;
use Illuminate\Support\Facades\DB;

class AchievementTable extends LazyRenderable
{
    public function grid(): Grid
    {
        $shop = Shop::find($this->key);
        return Grid::make(new ShopsAchievement(), function(Grid $grid) use ($shop){
            $grid->model()->where('admin_id', $shop->admin_id);
            $grid->column('id');
            $grid->column('dated', '日期');
            $grid->column('total_amount', '当日业绩');
            $grid->paginate(10);
            $grid->disableActions();
            $grid->filter(function (Grid\Filter $filter){
                $filter->expand();
                $filter->date('dated', '日期')->date()->width(6);
            });
        });
    }
}
