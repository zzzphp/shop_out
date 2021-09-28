<?php

namespace App\Admin\Metrics\Home;

use App\Models\Currency;
use App\Models\Recharge;
use Carbon\Carbon;
use Dcat\Admin\Widgets\Metrics\Card;
use Illuminate\Http\Request;
use App\Models\User;
use Dcat\Admin\Admin;
use Illuminate\Support\Facades\Cache;

class NewRecharge extends Card
{

    protected $currency;
    /**
     * 初始化卡片内容
     *
     * @return void
     */
    protected function init()
    {
        parent::init();

        $this->title('充值');
        $this->height = 120;
        $this->dropdown([
            '0' => '今日',
            '1' => '昨日',
            '2' => '总充值',
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
        $currency_id = Cache::get('admin_currency_id');
        $currency = Currency::find($currency_id);
        $this->currency = $currency->name;

        $query = Recharge::query();
        switch ($request->get('option')) {
            case '1':
                // 卡片内容
                $content = $query
                    ->whereDate('created_at', Carbon::yesterday()->toDateString())
                    ->where('currency_id', $currency_id)
                    ->sum('amount');
                break;
            case '2':
                // 卡片内容
                $content = $query
                    ->where('currency_id', $currency_id)
                    ->sum('amount');
                break;
            default:
                // 卡片内容
                $content = $query
                    ->where('currency_id', $currency_id)
                    ->whereDate('created_at', Carbon::today()->toDateString())
                    ->sum('amount');
        }
        $this->withContent(floatval($content));
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
    <span class="mb-0 mr-1 text-80">{$this->currency}</span>
</div>
HTML
        );
    }
}
