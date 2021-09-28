<?php

namespace App\Admin\Metrics\Examples;

use Dcat\Admin\Widgets\Metrics\Round;
use Illuminate\Http\Request;
use App\Models\Order;
use Dcat\Admin\Admin;

class ProductOrders extends Round
{
    /**
     * 初始化卡片内容
     */
    protected function init()
    {
        parent::init();

        $this->title('产品订单');
        $this->chartLabels(['已成交', '待审核', '未支付']);
        // $this->dropdown([
        //     '7' => 'Last 7 Days',
        //     '28' => 'Last 28 Days',
        //     '30' => 'Last Month',
        //     '365' => 'Last Year',
        // ]);
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
        
        $query = \App\Models\Order::query()->with(['user']);
        if(Admin::user()->isRole('agent')) {
            $query->whereHas('user',function($builder){
                $builder->where('admin_id', Admin::user()->id);
            });
        }
        $total = Order::count();
        $pending = Order::where('status', Order::STATUS_PENDING)->count();
        $success = Order::where('status', Order::STATUS_SUCCESS)->whereNotNull('paid_at')->where('closed', false)->count();
        $failed  = Order::where('closed', false)->whereNull('paid_at')->count();
        switch ($request->get('option')) {
            case '365':
            case '30':
            case '28':
            case '7':
            default:
                // 卡片内容
                $this->withContent($success, $pending, $failed);

                // 图表数据
                $this->withChart([$success, $pending, $failed]);

                // 总数
                $this->chartTotal('总订单', $total);
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
            'series' => $data,
        ]);
    }

    /**
     * 卡片内容.
     *
     * @param int $finished
     * @param int $pending
     * @param int $rejected
     *
     * @return $this
     */
    public function withContent($finished, $pending, $rejected)
    {
        return $this->content(
            <<<HTML
<div class="col-12 d-flex flex-column flex-wrap text-center" style="max-width: 220px">
    <div class="chart-info d-flex justify-content-between mb-1 mt-2" >
          <div class="series-info d-flex align-items-center">
              <i class="fa fa-circle-o text-bold-700 text-primary"></i>
              <span class="text-bold-600 ml-50">已成交</span>
          </div>
          <div class="product-result">
              <span>{$finished}</span>
          </div>
    </div>

    <div class="chart-info d-flex justify-content-between mb-1">
          <div class="series-info d-flex align-items-center">
              <i class="fa fa-circle-o text-bold-700 text-warning"></i>
              <span class="text-bold-600 ml-50">待审核</span>
          </div>
          <div class="product-result">
              <span>{$pending}</span>
          </div>
    </div>

     <div class="chart-info d-flex justify-content-between mb-1">
          <div class="series-info d-flex align-items-center">
              <i class="fa fa-circle-o text-bold-700 text-danger"></i>
              <span class="text-bold-600 ml-50">未支付</span>
          </div>
          <div class="product-result">
              <span>{$rejected}</span>
          </div>
    </div>
</div>
HTML
        );
    }
}
