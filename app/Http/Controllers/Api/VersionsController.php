<?php

namespace App\Http\Controllers\Api;

use App\Models\Version;
use Illuminate\Http\Request;

class VersionsController extends Controller
{
    //
    public function version(Request $request)
    {
        $request->validate(['current_version' => 'required', 'terminal' => 'required']);
        $current_version = str_replace('.', '', $request->current_version);
        $version = Version::query()
            ->where(['terminal' => $request->terminal])
            ->orderBy('id', 'DESC')
            ->first();
        $new_version = str_replace('.', '', $version->new_version);
        $min_version = str_replace('.', '', $version->min_version);
        $result = [];
        if ($current_version == $new_version) {
            // 不需要更新
            $result['is_update'] = false;
            return response()->json(['data' => $result]);
        }
        if ($current_version < $new_version) {
            // 有新版本更新
            $result['is_update'] = true;
            $result['version'] = $version;
        }
        if ($current_version < $min_version) {
            // 需要强制更新
            $result['is_update'] = true;
            $result['force_update'] = true;
            $result['version'] = $version;
        } else {
            $result['force_update'] = false;
        }
        return response()->json(['data' => $result]);
    }

    public function cat(Request $request)
    {
        $request->validate(['current_version' => 'required', 'terminal' => 'required']);
        $version = Version::query()->where([
            'new_version' => $request->current_version,
            'terminal'    => $request->terminal
        ])->first();
        if (!$version) {
            return $this->errorResponse(400, '未知版本');
        }
        return response()->json(['data' => $version]);
    }

    public function best(Request $request)
    {
        $version = Version::query()->where([
            'terminal'    => $request->input('terminal', 'android')
        ])->orderBy('id','DESC')->first();

        return response()->json(['data' => $version]);
    }
}
