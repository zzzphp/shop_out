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
        $data = $this->data['data'];
        $sms = new \Overtrue\EasySms\EasySms(config('easysms'));
        $phones = $this->data['phone'];
        try {
            foreach ($phones as $phone) {
                $sms->send($phone, [
                    'template' => config('easysms.gateways.ucloud.template.notice'),
                    'data' => ['code' => $data],
                ]);
            }
        } catch (NoGatewayAvailableException $exception) {
            $message = $exception->getException('ucloud')->getMessage();
            dd($message ?: '短信发送异常');
        }
    }
}
