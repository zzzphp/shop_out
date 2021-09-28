<?php

namespace App\Console\Commands;

use App\Models\NewsInformation;
use Illuminate\Console\Command;

class NewsInformationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customize:news-grab-information';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '获取新闻资讯';

    protected $access_key = 'd813d00be71f5ce5d168d703a136ea9a';
    protected $secret_key = 'eb26300773ba5ff8';

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
        $date = time();
        $last_id = NewsInformation::query()
                        ->orderBy('resource_id', 'DESC')
                        ->whereNotNull('resource_id')
                        ->value('resource_id');
        $httpParams = ['access_key' => $this->access_key, 'date' => $date];
        if ($last_id) $httpParams['last_id'] = $last_id;
        $signParams = array_merge($httpParams, ['secret_key' => $this->secret_key]);
        ksort($signParams);
        $signString = http_build_query($signParams);
        $httpParams['sign'] = strtolower(md5($signString));
        $url = 'http://api.coindog.com/topic/list?' . http_build_query($httpParams);
        $list = array_reverse(json_decode(file_get_contents($url), true));
        foreach ($list as $item) {
            NewsInformation::query()->create([
                'author' => $item['author'],
                'content' => $item['content'],
                'created_at' => $item['published_time'],
                'resource' => $item['resource'],
                'resource_url' => $item['resource_url'] ?: $item['url'],
                'summary' => $item['summary'],
                'thumbnail' => $item['thumbnail'],
                'title' => $item['title'],
                'resource_id' => $item['id'],
            ]);
        }
    }
}
