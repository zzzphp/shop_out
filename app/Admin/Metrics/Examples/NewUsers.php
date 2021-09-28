<?php

namespace App\Admin\Metrics\Examples;

use Dcat\Admin\Widgets\Metrics\Line;
use Illuminate\Http\Request;
use App\Models\User;
use Dcat\Admin\Admin;

class NewUsers extends Line
{
    /**
     * 初始化卡片内容
     *
     * @return void
     */
    protected function init()
    {
        parent::init();

        $this->title('今日新曾用户');
        $this->dropdown([
            '0' => '今日新增',
            '30' => '当月新增',
            '365' => '一年新增',
        ]);
    }

    /**
     * 处理请求
     *
     * @param Request $request
     *
     * @return mixed|void
     */
    public function handle(Request $request)
    {
        $generator = function ($len, $min = 10, $max = 300) {
            for ($i = 0; $i <= $len; $i++) {
                yield mt_rand($min, $max);
            }
        };
        $query = User::query();
        if(Admin::user()->isRole('agent')) {
            $query->where('admin_id', Admin::user()->id);
        }
        switch ($request->get('option')) {
            case '365':
                // 卡片内容
                $this->withContent($query->whereYear('created_at',date('Y', time()))->count());
                // 图表数据
                $this->withChart(collect($generator(30))->toArray());
                break;
            case '30':
                // 卡片内容
                $this->withContent($query
                    ->whereYear('created_at',date('Y', time()))
                    ->whereMonth('created_at',date('m', time()))
                    ->count());
                // 图表数据
                $this->withChart(collect($generator(30))->toArray());
                break;
            default:
                // 卡片内容
                $this->withContent($query->whereDate('created_at',date('Y-m-d', time()))
                    ->count());
                // 图表数据
                $this->withChart([28, 40, 36, 52, 38, 60, 55,]);
        }
    }

    /**
     * 设置图表数据.
     *
     * @param array $data
     *
     * @return $this
     */
    public function withChart(array $data)
    {
        return $this->chart([
            'series' => [
                [
                    'name' => $this->title,
                    'data' => $data,
                ],
            ],
        ]);
    }

    /**
     * 设置卡片内容.
     *
     * @param string $content
     *
     * @return $this
     */
    public function withContent($content)
    {
        return $this->content(
            <<<HTML
<div class="d-flex justify-content-between align-items-center mt-1" style="margin-bottom: 2px">
    <h2 class="ml-1 font-lg-1">{$content}</h2>
    <span class="mb-0 mr-1 text-80">{$this->title}</span>
</div>
HTML
        );
    }
}
