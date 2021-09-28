<?php

function hashKey($user_id, $currency_id, $other = '')
{
    return substr(md5($user_id.$currency_id.$other), 8, 16);
}
// 加
function add($left, $right, int $scale = 8)
{
    return bcadd($left, $right, $scale);
}
// 减
function sub($left, $right, int $scale = 8)
{
    return bcsub($left, $right, $scale);
}
//乘
function mul($left, $right, int $scale = 8)
{
    return bcmul($left, $right, $scale);
}
// 除
function div($left, $right, int $scale = 8)
{
    return bcdiv($left, $right, $scale);
}
// 两个数相等时返回 0； num1 比 num2 大时返回 1； 其他则返回 -1。
function comp($left, $rigth, int $scale = 8) {
    return bccomp($left, $rigth, $scale) === 1 ? true : false;
}

function usdtAmount()
{
    return config('site.usdt');
}

function currency_last($symbol)
{
    return \Illuminate\Support\Facades\DB::table('currency_market_biki')->where('symbol', $symbol)->value('last');
}

function check_url($value, $disk = 'admin')
{
    if (\Illuminate\Support\Str::startsWith($value, ['http://', 'https://'])) {
        return $value;
    }
    return \Illuminate\Support\Facades\Storage::disk($disk)->url($value);
}

// 钱包排序
function walletHelper($wallets)
{
    $arr = [];
    foreach ($wallets as $wallet) {
        if (isset($arr[$wallet->currency->sort])) {
            $arr[] = $wallet;
        } else {
            $wallet->currency->icon = check_url($wallet->currency->icon);
            $arr[$wallet->currency->sort] = $wallet;
        }
    }
    return $arr;
}

//判断是否是移动端访问
function isMobile()
{
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])) {
        return TRUE;
    }
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA'])) {
        return stristr($_SERVER['HTTP_VIA'], "wap") ? TRUE : FALSE;// 找不到为flase,否则为TRUE
    }
    // 判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array(
            'mobile',
            'nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap'
        );
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return TRUE;

        }
    }
    if (isset ($_SERVER['HTTP_ACCEPT'])) { // 协议法，因为有可能不准确，放到最后判断
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== FALSE) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === FALSE || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return TRUE;
        }
    }
    return FALSE;
}

function numberFormat($number)
{
    if ($number >= 100000000) {
         return round($number/100000000, 2) . ' 亿';
    }
    if ($number >= 10000) {
        return round($number/10000, 2) . ' 万';
    }

    return $number;
}

function convert_scientific_number_to_normal($number)
{
    if(stripos($number, 'e') === false) {
        //判断是否为科学计数法
        return $number;
    }
    if(!preg_match(
        "/^([\\d.]+)[eE]([\\d\\-\\+]+)$/",
        str_replace(array(" ", ","), "", trim($number)), $matches)
    ) {
        //提取科学计数法中有效的数据，无法处理则直接返回
        return $number;
    }
    //对数字前后的0和点进行处理，防止数据干扰，实际上正确的科学计数法没有这个问题
    $data = preg_replace(array("/^[0]+/"), "", rtrim($matches[1], "0."));
    $length = (int)$matches[2];
    if($data[0] == ".") {
        //由于最前面的0可能被替换掉了，这里是小数要将0补齐
        $data = "0{$data}";
    }
    //这里有一种特殊可能，无需处理
    if($length == 0) {
        return $data;
    }
    //记住当前小数点的位置，用于判断左右移动
    $dot_position = strpos($data, ".");
    if($dot_position === false) {
        $dot_position = strlen($data);
    }
    //正式数据处理中，是不需要点号的，最后输出时会添加上去
    $data = str_replace(".", "", $data);
    if($length > 0) {
        //如果科学计数长度大于0
        //获取要添加0的个数，并在数据后面补充
        $repeat_length = $length - (strlen($data) - $dot_position);
        if($repeat_length > 0) {
            $data .= str_repeat('0', $repeat_length);
        }
        //小数点向后移n位
        $dot_position += $length;
        $data = ltrim(substr($data, 0, $dot_position), "0").".".substr($data, $dot_position);
    } elseif($length < 0) {
        //当前是一个负数
        //获取要重复的0的个数
        $repeat_length = abs($length) - $dot_position;
        if($repeat_length > 0)
            //这里的值可能是小于0的数，由于小数点过长
            $data = str_repeat('0', $repeat_length).$data;
        }
        $dot_position += $length;//此处length为负数，直接操作
        if($dot_position < 1) {
            //补充数据处理，如果当前位置小于0则表示无需处理，直接补小数点即可
            $data = ".{$data}";
        } else {
            $data = substr($data, 0, $dot_position).".".substr($data, $dot_position);
        }

        if($data[0] == ".") {
            //数据补0
            $data = "0{$data}";
        }
        return trim($data, ".");
}

function noticeHelper($data)
{
    // $data = ['scene' => '充值', 'name' => '测试', 'phone' => 15952194381]
    if (!app()->environment('production')) {
        // 测试环境
    } else {
        \App\Jobs\NoticeSmsJob::dispatch($data);
    }
}





