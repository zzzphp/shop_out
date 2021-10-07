<?php

return [
    'usdt' => 6.42, // 人民币与USDT汇率
    'admin_notice' => [13292922558,15952194381], // 通知号码
    'about' => ['http://oss.gaogecloud.com/images/about1.jpg',
                'http://oss.gaogecloud.com/images/about2.jpg',
                'http://oss.gaogecloud.com/images/about3.jpg',
        ],
    'contact' => [
            'http://oss.gaogecloud.com/images/contact_wx.jpg',
        ], // 联系客服二维码
    'coin_market' => explode(",", env('COIN_MARKET', 'btc,eth,fil,icp,doge,xrp,bch,ltc')),

    'vip_grade' => [
        'zero' => ['condition' => 0, 'minute' => 1, 'order' => 1],
        'one' => ['condition' => 0, 'minute' => 0, 'order' => 0],
        'two' => ['condition' => 200, 'minute' => 3, 'order' => 1],
        'three' => ['condition' => 400, 'minute' => 6, 'order' => 2],
        'four' => ['condition' => 600, 'minute' => 9, 'order' => 3],
        'five' => ['condition' => 800, 'minute' => 12, 'order' => 4],
        'six' => ['condition' => 1000, 'minute' => 15, 'order' => 5],
    ],
    'bond' => 200,
    'service_charge' => 0.015, // 1.5% 手续费
    'premium' => 0.015, // 1.5%  // 溢价

];
