<?php

namespace App\Http\Controllers\Api;

use App\Models\Shop;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    //

    public function index(Request $request)
    {
        $builder = Category::query()
            ->with('children', function ($builder) use ($request){
                if ($request->user()->admin_id) {
                    $builder->where('admin_id', $request->user()->admin_id);
                } else {
                    $builder->whereNull('admin_id');
                }
            })
            ->where('parent_id', 0)
            ->where('is_show', true)
            ->orderBy('sort', 'ASC');
        if($category_id = $request->category_id) {
            $builder->where('parent_id', $category_id);
        }
        $list = $builder->get()->toArray();
        foreach ($list as $k => $value) {
            if ($value['parent_id'] === 0 && $request->user()->admin_id) {
                $url = Shop::query()
                    ->where('admin_id', $request->user()->admin_id)
                    ->value('logo');
                $list[$k]['icon_url'] = full_url($url);
            }
        }
        return response()->json(['data' => $list]);
    }

}
