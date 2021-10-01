<?php

namespace App\Admin\Actions\Tables;

use App\Models\Collection;
use App\Models\UserAddress;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;
use Dcat\Admin\Models\Administrator;

class UserCollectionTable extends LazyRenderable
{
    public function grid(): Grid
    {
        $user_id = $this->key;
        return Grid::make(new Collection(), function (Grid $grid) use($user_id) {
            $grid->model()->where('user_id', $user_id);
            $grid->column('id');
            $grid->column('type', '类型')->display(function ($type){
                return Collection::$typeMap[$type];
            });
            $grid->column('data', '收款信息')->display(function ($data){
                $info = '';
                foreach ($data as $datum) {
                    $info .= $datum . '-';
                }
                return $info;
            });
            $grid->disableActions();
        });
    }
}
