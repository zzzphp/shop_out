<?php

namespace App\Admin\Metrics\Examples;

use Dcat\Admin\Widgets\Metrics\Card;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Dcat\Admin\Admin;

class TotalUsers extends Card
{
    /**
     * 卡片底部内容.
     *
     * @var string|Renderable|\Closure
     */
    protected $footer;

    /**
     * 初始化卡片.
     */
    protected function init()
    {
        parent::init();

        $this->title('平台订单销售总额');
        $this->dropdown([
            '0' => '总业绩',
            '30' => '一个月',
            '365' => '一年',
        ]);
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
        $query = \App\Models\Order::query()->with(['user'])->where('status', \App\Models\Order::STATUS_SUCCESS);
        if(Admin::user()->isRole('agent')) {
            $query->whereHas('user',function($builder){
                $builder->where('admin_id', Admin::user()->id);
            });
        }
        switch ($request->get('option')) {
            case '365':
                $this->content($total_amount = $query->whereYear('created_at', date('Y',time()))->sum('total_amount') . ' USDT');
                $this->down(mt_rand(1, 30));
                break;
            case '30':
                $this->content($total_amount = $query
                        ->whereYear('created_at', date('Y',time()))
                        ->whereMonth('created_at', date('m',time()))
                        ->sum('total_amount') . ' USDT');
                $this->up(mt_rand(12, 50));
                break;
            default:
                $this->content($total_amount = $query->sum('total_amount') . ' USDT');
                $this->up(15);
        }
    }

    /**
     * @param int $percent
     *
     * @return $this
     */
    public function up($percent)
    {
        return $this->footer(
            "<i class=\"feather icon-trending-up text-success\"></i> {$percent}% Increase"
        );
    }

    /**
     * @param int $percent
     *
     * @return $this
     */
    public function down($percent)
    {
        return $this->footer(
            "<i class=\"feather icon-trending-down text-danger\"></i> {$percent}% Decrease"
        );
    }

    /**
     * 设置卡片底部内容.
     *
     * @param string|Renderable|\Closure $footer
     *
     * @return $this
     */
    public function footer($footer)
    {
        $this->footer = $footer;

        return $this;
    }

    /**
     * 渲染卡片内容.
     *
     * @return string
     */
    public function renderContent()
    {
        $content = parent::renderContent();

        return <<<HTML
<div class="d-flex justify-content-between align-items-center mt-1" style="margin-bottom: 2px">
    <h2 class="ml-1 font-lg-1">{$content}</h2>
</div>
<div class="ml-1 mt-1 font-weight-bold text-80">
    {$this->renderFooter()}
</div>
HTML;
    }

    /**
     * 渲染卡片底部内容.
     *
     * @return string
     */
    public function renderFooter()
    {
        return $this->toString($this->footer);
    }
}
