<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NoticeSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $data = $this->data;
        $sms = new \Overtrue\EasySms\EasySms(config('easysms'));
        $phones = config('site.admin_notice');
        foreach ($phones as $phone) {
            $sms->send($phone, [
                'template' => config('easysms.gateways.aliyun.template.recharge_notice'),
                'data' => $data,
            ]);
        }
    }
}
