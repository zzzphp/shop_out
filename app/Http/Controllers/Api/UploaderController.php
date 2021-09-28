<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UploaderController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'mime' => [
                'required',
                Rule::in(['images', 'files'])
            ],
            'file' => 'required|file|mimes:jpeg,bmp,png'
        ]);
        $path = $request->file('file')->store($request->mime);
        return response()->json(['data' => Storage::url($path)]);
    }

    public function multipleStore(Request $request)
    {
        $request->validate([
            'mime' => [
                'required',
                Rule::in(['images', 'files'])
            ],
            'file' => 'required|file|mimes:jpeg,bmp,png'
        ]);
        $paths = [];
        foreach ($request->file('files') as $file) {
            $path = $file->store($request->mime);
            $paths[] = Storage::url($path);
        }

        return $paths;
    }
}
