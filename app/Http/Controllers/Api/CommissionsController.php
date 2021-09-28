<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Commission;
use App\Models\User;
class CommissionsController extends Controller
{
    //
    public function index(Request $request)
    {
        $request->validate(['currency_id' => 'required']);
        $commissions = Commission::where('user_id', $request->user()->id)
        ->where('currency_id', $request->currency_id)
        ->with(['order', 'order.product', 'order.user'])
        ->get();
        return response()->json(['data' => $commissions]);
    }

    public function index_not(Request $request)
    {
        $users = User::where('invite_id', $request->user()->id)->get(['id','name', 'created_at']);
        return response()->json(['data' => $users]);
    }
}
