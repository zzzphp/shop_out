<?php

namespace App\Admin\Metrics\Home;

use App\Models\Currency;
use App\Models\Order;
use Carbon\Carbon;
use Dcat\Admin\Widgets\Metrics\Line;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Dcat\Admin\Admin;
use Illuminate\Support\Facades\Cache;

class TotalOrder extends Line
{
    /**
     * 卡片底部内容.
     *
     * @var string|Renderable|\Closure
     */
    protected $footer;

    protected $defaultCoin = 1;
    /**
     * 初始化卡片.
     */
    protected function init()
    {
        parent::init();
        $this->title('平台订单销售总额');
        $options = Currency::query()
            ->orderBy('sort')
            ->pluck('name', 'id')
            ->toArray();
        $this->defaultCoin = current(array_keys($options));
        if ($currency_id = Cache::get('admin_currency_id')) {
            if (isset($options[$currency_id])) {
                $item[$currency_id] = $options[$currency_id];
                unset($options[$currency_id]);
                $options = $item + $options;
            }
        } else {
            Cache::put('admin_currency_id', $this->defaultCoin);
        }
        $this->dropdown($options);
    }

    /**
     * 处理请求.
     *
     * @param Request $request
     *
     * @return void
     */
    public function handle(Request $request)
    {
        if ($request->get('option')) {
            Cache::put('admin_currency_id', $request->get('option'));
        }
        $currency_id = Cache::get('admin_currency_id', $this->defaultCoin);
        $query = \App\Models\Order::query()->with(['user'])
            ->where('status', '!=', Order::STATUS_PENDING);
        $total_amount = $query->sum('total_amount') . ' CNY';
        $this->withContent($total_amount);
        // 图表数据
        $chartArray = [];
        $categroies = [];
        $carbon = Carbon::today()->subDays(30);
        for ($i = 0; $i < 30; $i++) {
            $date = $carbon->toDateString();
            $chartArray[] = Order::query()
                ->whereDate('created_at', $date)
                ->sum('total_amount');
            $categroies[] = $date;
            $carbon = $carbon->addDay();
        }
        $this->withChart($chartArray, $categroies);
    }


    /**
     * 设置图表数据.
     *
     * @param array $data
     *
     * @return $this
     */
    public function withChart(array $data, array $categories)
    {
        return $this->chart([
            'series' => [
                [
                    'name' => '销售额',
                    'data' => $data,
                ],
            ],
            'xaxis' => [
                'type' => 'date',
                'categories' => $categories,
            ],
            'tooltip' => [
                'x' => [
                    'format' => ''
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
