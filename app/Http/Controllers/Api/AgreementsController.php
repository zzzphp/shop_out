<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use Illuminate\Http\Request;

class AgreementsController extends Controller
{
    //
    public function register(Request $request)
    {
        $titles = ['《高歌云用户协议》', '《高歌云隐私协议》'];
        $agreements = Agreement::query()->whereIn('title', $titles)->get();
        return response()->json(['data' => $agreements]);
    }

    public function index(Request $request)
    {
        $agreements = Agreement::query()->get(['id', 'title']);

        return response()->json(['data' => $agreements]);
    }

    public function show(Agreement $agreement)
    {
        return response()->json(['data' => $agreement]);
    }
}
