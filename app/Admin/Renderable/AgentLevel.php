<?php

namespace App\Admin\Renderable;

use App\Models\Agent as AgentModel;
use Dcat\Admin\Support\LazyRenderable;
use Dcat\Admin\Widgets\Table;

class AgentLevel extends LazyRenderable
{
    public function render()
    {
        // 获取ID
        $id = $this->key;

        // 获取其他自定义参数
        $type = $this->post_type;

        $data = AgentModel::where('parent_id', $id)
            ->get(['type', 'name', 'address', 'phone', 'phone'])
            ->toArray();

        $titles = [
            'User ID',
            'Title',
            'Body',
            'Created At',
        ];

        return Table::make($titles, $data);
    }
}