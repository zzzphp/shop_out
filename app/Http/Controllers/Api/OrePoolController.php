<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class OrePoolController extends Controller
{
    //
    public function index(Request $request)
    {
        $currencies = ['fil'];
        $list = [];
        foreach ($currencies as $currency) {
            $data = [];
            $data['data'] = Redis::get($currency);
            if ($data['data']) {
                $data['currency'] = strtoupper($currency);
                $data['data'] = json_decode($data['data'], true);
                $list[] = $data;
            }
        }
        return response()->json(['data' => $list]);
    }

    public function store(Request $request)
    {
       return Redis::set($request->currency, $request->data);
    }

}
