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
];
