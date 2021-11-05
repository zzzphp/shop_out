<?php

return [
    // HTTP 请求的超时时间（秒）
    'timeout' => 5.0,

    // 默认发送配置
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

        // 默认可用的发送网关
        'gateways' => [
             'aliyun',
        ],
    ],
    // 可用的网关配置
    'gateways' => [
        'errorlog' => [
            'file' => '/tmp/easy-sms.log',
        ],
        'yunpian' => [
            'api_key' => '824f0ff2f71cab52936axxxxxxxxxx',
        ],
        'aliyun' => [
            'access_key_id' => 'LTAIPZzRo3FXwo14',
            'access_key_secret' => 'o8lDAknEbtOKMW523Vn3isnUlohzLh',
            'sign_name' => '高歌云',
            'template' => [
                    'register' => 'SMS_197880135',
                    'recharge_notice' => 'SMS_203671020',
                ],
        ],
        'ucloud' => [
            'private_key'  => '2xUwYTrw0j34L8PcXfD6Ye6IyF4roHI5w5YguEVvezrs2eJyYqPTmX68ighkc5IUky',    //私钥
            'public_key'   => 'LHy6KT4bHLf5vzijXjGaMk5kuqIlgnRjSpbMZiYL',    //公钥
            'sig_content'  => '瓯越世纪',    // 短信签名,
            'project_id'   => 'org-wj0o0p',    //项目ID,子账号才需要该参数
            'template'     => [
                'codes'   => 'UTA211105E3J6HV',
                'notice' => 'UTN2111056DGWNX',
            ],
        ],
        //...
    ],
];
