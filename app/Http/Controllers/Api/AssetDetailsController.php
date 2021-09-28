<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AssetDetails;
use Illuminate\Http\Request;

class AssetDetailsController extends Controller
{
    //
    public function index(Request $request)
    {
        $details = AssetDetails::with(['currency'])
            ->where('user_id', $request->user()->id)
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return response()->json(['data' => $details]);
    }
}
