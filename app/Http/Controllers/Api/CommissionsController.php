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
        $commissions = Commission::where('user_id', $request->user()->id)
        ->orderBy('id', 'DESC')
        ->get();
        $data['total'] = Commission::where('user_id', $request->user()->id)->sum('amount');
        $data['one'] = Commission::where('user_id', $request->user()->id)
            ->where('level', Commission::LEVEL_ONE)
            ->sum('amount');
        $data['two'] = Commission::where('user_id', $request->user()->id)
            ->where('level', Commission::LEVEL_TWO)
            ->sum('amount');
        $data['commissions'] = $commissions;
        return response()->json(['data' => $data]);
    }

    public function index_not(Request $request)
    {
        $users = User::where('invite_id', $request->user()->id)->get(['id','name', 'created_at']);
        return response()->json(['data' => $users]);
    }

    public function rate(Request $request)
    {
        $request->validate(['one' => 'required', 'two' => 'required']);
        $rate['one'] = $request->one;
        $rate['two'] = $request->two;
        if (($rate['one'] + $rate['two']) > 20) {
            return $this->errorResponse(400, '');
        }
        $request->user()->update(['share_rate' => $rate]);

        return response()->json(['data' => true]);
    }
}
