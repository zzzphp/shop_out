<?php

namespace App\Admin\Metrics\Home;

use App\Models\Currency;
use App\Models\Order;
use App\Models\PowerDistribute;
use App\Models\PowerDistributeLog;
use App\Models\Recharge;
use Carbon\Carbon;
use Dcat\Admin\Widgets\Metrics\Card;
use Illuminate\Http\Request;
use App\Models\User;
use Dcat\Admin\Admin;
use Illuminate\Support\Facades\Cache;

class TotalDistribute extends Card
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

        $this->title('累计发放');
        $this->height = 120;
        $this->dropdown([
           '0' => '释放',
           '1' => '锁仓',
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

        switch ($request['option']) {
            case '1':
                $content = $query = PowerDistributeLog::query()
                    ->where('currency_id', $currency_id)
                    ->sum('lock');
                break;
            default :
                $content = $query = PowerDistributeLog::query()
                    ->where('currency_id', $currency_id)
                    ->sum('unlock');
                break;
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
