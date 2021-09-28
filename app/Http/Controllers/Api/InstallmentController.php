<?php

namespace App\Http\Controllers\Api;

use App\Models\Installment;
use App\Models\InstallmentItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    //
    public function show(Request $request)
    {
        $installment = Installment::query()->where('order_id', $request->id)->with(['items', 'order.product'])->first();
        return response()->json(['data' => $installment]);
    }

    public function pay_prove(Request $request)
    {
        $request->validate(['image_prove' => 'required|url', 'id' => 'required|integer']);

        $item = InstallmentItem::find($request->input('id'));
        if ($item->status !== InstallmentItem::STATUS_PENDING) {
            $this->errorResponse(400, '分期订单状态异常');
        }
        $item->pay_prove = $request->input('image_prove');
        $item->paid_at = Carbon::now()->toDateTimeString();
        $item->status = InstallmentItem::STATUS_PROCESSING;
        $item->save();

        return response()->json(['data' => $item]);
    }

}
