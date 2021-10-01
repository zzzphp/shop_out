<?php

namespace App\Admin\Actions\Tables;

use App\Models\UserAddress;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;
use Dcat\Admin\Models\Administrator;

class UserAddressTable extends LazyRenderable
{
    public function grid(): Grid
    {
        $user_id = $this->key;
        return Grid::make(new UserAddress(), function (Grid $grid) use($user_id) {
            $grid->model()->where('user_id', $user_id);
            $grid->column('id');
            $grid->column('contact_name', '联系人');
            $grid->column('contact_phone', '手机号');
            $grid->column('full_address', '地址');
            $grid->disableActions();
        });
    }
}
