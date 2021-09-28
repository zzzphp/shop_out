<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    //
    public function show(Request $request)
    {
        $request->validate(['name' => 'required']);
        return response()->json(['data' => config("site.{$request->name}")]);
    }
}
