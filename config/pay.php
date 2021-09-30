<?php

declare(strict_types=1);

use Yansongda\Pay\Pay;

return [
    'alipay' => [
        'default' => [
            // 支付宝分配的 app_id
            'app_id' => '2021000117601830',
            // 应用私钥
            'app_secret_cert' => 'MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQDJhxDzDjqu4WAawSjMjcdpIioK1p6zKLNRRmNJLhq1Jc3EnR1CXP9kMrxC9ie+Xgg1EtgoSePl2llfKDUQ1uIZSROzssnoWqgwnqkHVs9tJ2Yl1lC1uI5ikDTGuf5LeI+xmSBLpFd2ZX/FXAvntc9BvJXAsynqN6M9X2I+q4QUI4I9c3D2udUpGl5lIBiSU6obg4fyCgNF8nQTZ6n8OtrXX0x/EyKb8sAFmH5mKYu/wYAX8HZrE3Z/D2oDPOXiQPkjHYpRMSRSY0mz33iX29+V3H6elKsE6Qv9taUJEGbu/KRSQwM1gsSjS/xjrUYH5rwTeT4vHLw6nkuJCDk7wHNrAgMBAAECggEAUgnY3YkiXITE8b9GU5c34VWWFdluu3JLJT/pNSY+mxWroWlwOs7O7MQ2nW/FmBqBbtGgCy6hRrXPggxFJfjEDBUSnymeRid5pmlAWAt/32iVjbukGYXq+LbJtUiL+781h8/VNNXPARSqofYppob9uz4BHHQTERTbMCW/QdHir6tXwuhQZn1crOAll1mAgbWlccEyRXxabgyk5N3rYeqCDKYqlS8jGIgfwguYnk8O1aWcWidGdsySCDF+yXKrwD0cqCSKXc9DGnxDmsN/oqskUgpGLv9WR4jj3qhTCNcdH1+qQUcVwWb0lGTTOOV9PB+p5LAX5Mfo/iac+/5Hm2xe+QKBgQDtVcqpa4WU/zmZXgZu19qW92NQa+qfRhYHKr3kU0BCcwNtFo4WaxkCLCr8xLy0TTZt9r/Yq8AaZwYQ7/4Va7E2ZYspn0Bc7NTICaVYNP4wOrNSYR2LyL4Rsgf9zZzHwKWgbKzxRylvTqOpOKn8dDF5t2zDUCGw78GkodOyqFzLNwKBgQDZYF7o7blZXmzNg9nryrUJNLNpnaUbB+usXnXH7RvCBB0CizrEBCSJRgvOvc1mfcZ/A0PSEj2UVfOdO6Xb8LbiABsDfXJgnIkkR9o0l8S3qgLurpUYjFPcS21O8R98/zfXwf412icv5SJOrhJhRasWd1HIeytjg3DuTrg1nHn7bQKBgE6Tsu94u9di0O0oJjUYnjSRX35G3H0zNSPWUNyBe6sEbUP2zcA6YSNJAEqD0H5ZegXaRhY0dvvG1ElTS+pHp3p9ECANq7+YYbKBDw8vLGFHbgt+P8wCAHvXV7H+G0Q/UhbVJEUV7G//t0vViOIejirgQdBAfYcZOiGJuo9SErbtAoGABf8ynxpv0pdYSRMqH+cnt2lMyc0fkO9XARpaBXn1GhUi977/kAjNOTxFdx6lW/58S2S7qj/2kvEMF3pdyQOLCBEYra/4R9IJtoaE7o6BTs/R5OPMGTFF3v31tgfQ5pHj6H/hk3rBOgEIQUNsHmLdpXEFQJKlT8mAhBKH4nK+qsECgYBx5BfOospWPl7+LGmZ7xJ2q6Dv+UEWjbrOjGRy5tuXEAPI7GrgcyvNh8FDJg7aYuIvrDidlt3fBTQo5QYFsGEHlztxQBG4soiA/r5KXyfTL1TTJAELlbMwpfXodURqAGUG5LJpcX2prdkQ+aXJvmjT1lphSiw+bDm+OYF5Xawelw==',
            // 应用公钥证书 路径
            'app_public_cert_path' => '/www/wwwroot/shop.local/storage/app/pay/alipay/appCertPublicKey_2021000117601830.crt',
            // 支付宝公钥证书 路径
            'alipay_public_cert_path' => '/www/wwwroot/shop.local/storage/app/pay/alipay/alipayCertPublicKey_RSA2.crt',
            // 支付宝根证书 路径
            'alipay_root_cert_path' => '/www/wwwroot/shop.local/storage/app/pay/alipay/alipayRootCert.crt',
            'return_url' => 'http://wwww.baidu.com',
//            'notify_url' => 'http://wwww.baidu.com',
            'mode' => Pay::MODE_SANDBOX,
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
