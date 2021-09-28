<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Ally;

class AlliesController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'ability' => 'required',
            ]);
        if($ally = Ally::where('user_id', $request->user()->id)->first()) {
            return response()->json(['data' => $ally]);
        }
        $ally = Ally::create([
                'user_id' => $request->user()->id,
                'name'    => $request->name,
                'phone'   => $request->phone,
                'address' => $request->address,
                'ability' => $request->ability,
                'status'  => Ally::STATUS_PEDING,
            ]);

        return response()->json(['data' => $ally]);
    }
}
