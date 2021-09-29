<?php

declare(strict_types=1);

use Yansongda\Pay\Pay;

return [
    'alipay' => [
        'default' => [
            // 支付宝分配的 app_id
            'app_id' => '2021000117601830',
            // 应用私钥
            'app_secret_cert' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA5x0b2zwssOVGRJfJia1qAiKoHSGT0A8J0rMMyg+AU55EIsNIbHztZLgnh/bsb7rKag1yYbNxMvMOgOYCmEZgF9RkLIBUfAp6VsrkNFp8Ugc9CRlL0yhn5LnBnXIuqmhPWjADahJiJ3Cgg64i//cOFOMZ4Q9WbUMAi+WNt/hxju4vhqsz7I8r+7SfoF3COUc5Y3AnrPlzGlVQJawP5inGSHDkTYq6lUKjGO8UY9NrOc3MO0NVumO4gZiY+YT6HEURd76LW5DB9OOV9pjXf8Ouh35QUPhcC6m7Zzrs5GbtdM0I7Y+KqKRNccyMyMvJcTnaXrGVNRYYGezXPiI9XQ4HqwIDAQAB',
            // 应用公钥证书 路径
            'app_public_cert_path' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAsLO+v/I4a8/OkDZfu7Qa5TaKkKjMA/vC3SYLFqqeYX5tLic2iB0qzo6iOSNeCe6EhmGG2lhT1r4ef6jQE5l8O09JVRSuHnU2Y6aeo2S5qRVzP8KwNCDYXv2iRGCczjoMx6OPrskwtuDE3OZC7gvQF6mjDbqjFDc77o/zExkIoxNpz/sFds7niXtMiLnhuQtrPDqdI26qhNjiuOJWHV1BH8Qw2guZmogaHyBrNgnyjxk4zRVfP1z3gqjaTejW9U7OdekZeqdcqc2gdMnoD0v8GaiR9kj4bB59YHvEW0Ic2erzos/S/RdRvFzlhvGNfM3mGg3iqkT3mvNbxc01ISz21wIDAQAB',
            // 支付宝公钥证书 路径
            'alipay_public_cert_path' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAud8PeMjJYVpDKSMUFalQgv422Sxo+LOA8d28mPnVPtG+kRmGik/Rpi5BatYXc2M5faNc9GOWKnysAlWAijBuX4fGIelWmGH3R8pyVGDpwqIVMp9psxevRgk8Sp69AJS5gZpdCJv52VRvCuKinknXKVbqBS7JUZ2pEduHfoyZRdFdFCmuKXms7WsZD8+Gc6oYpLk/ukGcPcfXWc/tyA4RyHeOfq5IXrfatyWtpzqRXppSAA0077gGiEMThx49Xs7j2TsOGvWrwf4ZyR84ZR4F0FOHkToxgqG9QwbBJjYKy8qABoVOtr8T1uDKMlaGaJuLcd0tfhOU/OPm/bb2riheTwIDAQAB',
            // 支付宝根证书 路径
            'alipay_root_cert_path' => '',
            'return_url' => '',
            'notify_url' => '',
            'mode' => Pay::MODE_NORMAL,
        ],
    ],
    'wechat' => [
        'default' => [
            // 公众号 的 app_id
            'mp_app_id' => '',
            // 小程序 的 app_id
            'mini_app_id' => '',
            // app 的 app_id
            'app_id' => '',
            // 商户号
            'mch_id' => '',
            // 合单 app_id
            'combine_app_id' => '',
            // 合单商户号
            'combine_mch_id' => '',
            // 商户秘钥
            'mch_secret_key' => '',
            // 商户私钥
            'mch_secret_cert' => '',
            // 商户公钥证书路径
            'mch_public_cert_path' => '',
            // 微信公钥证书路径
            'wechat_public_cert_path' => [
                '' => '',
            ],
            'notify_url' => '',
            'mode' => Pay::MODE_NORMAL,
        ],
    ],
    'http' => [ // optional
        'timeout' => 5.0,
        'connect_timeout' => 5.0,
        // 更多配置项请参考 [Guzzle](https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html)
    ],
    // optional，默认 warning；日志路径为：sys_get_temp_dir().'/logs/yansongda.pay.log'
    'logger' => [
        'enable' => false,
        'file' => null,
        'level' => 'debug',
        'type' => 'single', // optional, 可选 daily.
        'max_file' => 30,
    ],
];
