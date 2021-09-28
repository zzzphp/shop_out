<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    //

    public function index(Request $request)
    {
        $builder = Category::query()
            ->with(['children'])
            ->where('parent_id', 0)
            ->where('is_show', true)
            ->orderBy('sort', 'ASC');
        if($category_id = $request->category_id) {
            $builder->where('parent_id', $category_id);
        }

        return response()->json(['data' => $builder->get()]);
    }

}
