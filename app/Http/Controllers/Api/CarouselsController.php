<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Carousel;

class CarouselsController extends Controller
{
    //
    public function index(Request $request)
    {
        return response()->json(['data' => Carousel::orderBy('sort')->get()]);
    }
}
