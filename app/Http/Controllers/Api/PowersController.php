<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Powers;

class PowersController extends Controller
{
    //

    public function index(Request $request)
    {
        $powers = Powers::where('user_id', $request->user()->id)->with(['currency']);
        if($currency_id = $request->currency_id) {
            $powers->where('currency_id', $currency_id);
        }
        return response()->json(['data' => $powers->get()]);
    }
}
