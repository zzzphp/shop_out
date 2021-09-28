<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class currencyMarketSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minercloud:sync-currency-market';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '同步biki行情';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $host = "https://openapi.biki.cc";
        $path = "/open/api/get_allticker";
        $method = "GET";
        $time = time();
        $param = "?api_key=e92d15ba1c6c9ddac54a82ac10e035b3&time=$time";
        $url = $host . $path . $param;
        $data = file_get_contents($url);
        $data = json_decode($data, true);
        $i = 0;
        if ($data['code'] == 0) {

            $ticker = $data['data']['ticker'];
            foreach ($ticker as $k => $v) {
                //$s = strripos($v['symbol'], 'usdt');
                //if ($s) {
//                echo round($v['vol'] , 2) .'-'. round($v['last'], 2) . "\n";
                    $v['symbol'] = str_replace('usdt', '', $v['symbol']);
                    $vol = convert_scientific_number_to_normal($v['vol']);
                    $last = convert_scientific_number_to_normal($v['last']);
                    $v['vol'] = numberFormat(mul($vol, $last) * 6.5);
                    $is = DB::table('currency_market_biki')
                        ->where(['symbol'=> trim($v['symbol'])])
                        ->first();
                    if ($is) {
                        $time = date('Y-m-d H:i:s', time());
                        $v['updated_at'] = $time;
                        // 更新
                        $res = DB::table('currency_market_biki')->where(['symbol'=> trim($v['symbol'])])->update($v);
                    } else {
                        $time = date('Y-m-d H:i:s', time());
                        $v['updated_at'] = $time;
                        $v['created_at'] = $time;
                        //插入
                        $res = DB::table('currency_market_biki')->where(['symbol'=> trim($v['symbol'])])->insert($v);
                    }
                //}
                $res ? $i++ :'';
            }
            echo $i . "\n";
        }
    }
}
