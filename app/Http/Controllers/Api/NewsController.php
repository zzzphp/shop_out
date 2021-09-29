<?php

namespace App\Http\Controllers\Api;

use App\Models\NewsInformation;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
	//
	public function index(Request $request)
	{
        switch ($request->type) {
            case 'zixun':
                $news = NewsInformation::orderBy('created_at','DESC')
                        ->select(['id', 'title', 'created_at', 'summary', 'thumbnail']);
                break;
            default:
                $news = News::orderBy('created_at','DESC')
                    ->where('type', $request->input('type', News::TYPE_ACTIVE));
                break;
        }
        return response()->json(['data' => $news->paginate(10)]);
	}

	public function notice_index(Request $request)
	{
	    $notice = News::where('type', $request->input('type', News::TYPE_NOTICE))
	    ->orderBy('id','DESC')
		->get();

		return response()->json(['data' => $notice]);
	}

	public function show(News $new)
	{
	    $new->increment('looks');
	    return response()->json(['data' => $new]);
	}

	public function information(NewsInformation $information)
    {
        return response()->json(['data' => $information]);
    }



}
