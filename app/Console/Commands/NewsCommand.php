<?php

namespace App\Console\Commands;

use App\Models\News;
use Illuminate\Console\Command;

class NewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customize:news-grab';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '获取新闻快讯';

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
        $list = file_get_contents("https://api.jinse.com/noah/v2/lives?limit=20&reading=false&source=web&flag=up&id=267344&category=0");
        $list = json_decode($list, true);
        if (isset($list['list'][0]['lives'])) {
            $list = $list['list'][0]['lives'];
            // 获取已经抓取的最后时间
            $last_time = News::query()
                ->where('type', News::TYPE_KUAIXUN)
                ->orderBy('created_at', 'DESC')
                ->value('created_at');
            $last_time = strtotime($last_time);
            foreach ($list as $item) {
                if ($item['created_at'] <= $last_time) break;
                // 是新数据
                News::query()->create([
                    'title' => $item['content_prefix'],
                    'content' => $item['content'],
                    'type' => News::TYPE_KUAIXUN,
                    'stars' => $item['grade'] ?: '0',
                    'look_up' => $item['up_counts'],
                    'down_counts' => $item['down_counts'],
                    'created_at' => date('Y-m-d H:i:s', $item['created_at']),
                ]);
            }
        }
    }
}
