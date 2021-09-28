<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Currency;

class CurrenciesController extends Controller
{
    //
    public function index(Request $request)
    {
        $builder = Currency::query()->where('is_show', true)->orderBy('sort', 'ASC');
        if($type = $request->input('type', '')) {
            $builder->where('type', $type);
        }
        $currencires = $builder->get();
        foreach ($currencires as $currency) {
            $currency->icon = check_url($currency->icon);
        }
        return response()->json(['data' => $currencires]);
    }
}
