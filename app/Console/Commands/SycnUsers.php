<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SycnUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:sync-old-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '同步老平台用户';

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
        $orders = DB::connection('old_mysql')->table('hz_productorder')->where('status', 1)->get();
        foreach ($orders as $order) {
            $old = DB::connection('old_mysql')->table('hz_user')->where('phone', $order->user_phone)->first();
            if (!$old) {
                echo $order->user_name . "未发现该用户\n";
                continue;
            }
            if (User::query()->where('phone', $order->user_phone)->doesntExist()) {
                $pwd = Hash::make(substr($old->phone, 3, 8));
                $user = User::create([
                    'phone' => $old->phone,
                    'password' => $pwd,
                    'safe_password' => $pwd,
                    'name' => $old->name,
                    'avatar' => '/static/images/defaulavatar.jpg',
                    'idcard_data' => ['name' => $old->name, 'idcard' => $old->idcard, 'front_photo' => $old->idcard_front_image, 'back_photo' => $old->idcard_back_image],
                    'invite_id' => 0,
                    'admin_id' => 0,
                    'status' => User::STATUS_AUDITING,
                ]);
                echo $user->name . "-注册完成\n";
            } else {
                $user = User::query()->where('phone', $old->phone)->first();
                if ($user->name === $user->phone) {
                    User::query()->where('phone', $old->phone)->update([
                        'idcard_data' => ['name' => $old->name, 'idcard' => $old->idcard, 'front_photo' => $old->idcard_front_image, 'back_photo' => $old->idcard_back_image],
                        'status' => User::STATUS_AUDITING,
                        'name' => $old->name,
                    ]);
                    echo $user->name . "-实名完成\n";
                } else {
                    echo $user->name . "-无需实名\n";
                }
            }
            sleep(1);
        }
    }
}
