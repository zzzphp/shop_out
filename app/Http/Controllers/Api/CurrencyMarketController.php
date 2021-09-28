<?php

namespace App\Http\Controllers\Api;

use App\Models\CurrencyMarketBiki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrencyMarketController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = CurrencyMarketBiki::query()
            ->selectRaw('image,symbol,vol,last,round(last*6.5,2) as cny,round(rose*100,2) as rose');
        if($sy = $request->input('sy', '')) {
            $sy = explode(",", trim($sy, ","));
            // 指定交易币集合
            $query->whereIn('symbol', $sy);
        }
        if($symbol = $request->input('symbol', '')) {
            $query->where('symbol', 'like', "%$symbol%");
        }

        //dd($query->get()->toArray());
        return response()->json(['data' => $query->get()]);
    }

    public function index_center(Request $request)
    {
        $usdtAmount = usdtAmount();
        $query = CurrencyMarketBiki::query()
            ->selectRaw("image,symbol,vol,last,round(last*{$usdtAmount},2) as cny,round(rose*100,2) as rose");
        if($sy = $request->input('sy', '')) {
            $sy = config('site.coin_market');
            // 指定交易币集合
            $query->whereIn('symbol', $sy)->orderByRaw("find_in_set(symbol,'" . implode(",", $sy) . "')");
        }
        if($symbol = $request->input('symbol', '')) {
            $query->where('symbol', 'like', "%$symbol%");
        }

        return response()->json(['data' => $query->get()]);
    }

}
