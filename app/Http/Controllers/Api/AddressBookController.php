<?php

namespace App\Http\Controllers\Api;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Models\AddressBook;
use Illuminate\Validation\Rule;

class AddressBookController extends Controller
{
    //
    public function index(Request $request)
    {
        $request->validate([
           'currency_id' => 'required',
           'chain'       => 'required',
        ]);
        $books = AddressBook::query()
            ->where('user_id', $request->user()->id)
            ->where('currency_id', $request->currency_id)
            ->where('chain', strtoupper($request->chain))
            ->get();

        return response()->json(['data' => $books]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'chain' => 'required',
            'address' => 'required',
            'remark' => 'required',
            'currency_id' => 'required',
        ]);
        $currency = Currency::find($request->currency_id);
        if (!$currency->chainConf($request->chain)) {
            $this->errorResponse(400, '链名不存在');
        }
        $addressBook = new AddressBook([
            'chain' => strtoupper($request->chain),
            'address' => $request->address,
            'remark' => $request->remark,
        ]);
        $addressBook->user()->associate($request->user());
        $addressBook->currency()->associate($currency);

        return response()->json(['data' => $addressBook->save()]);
    }

    public function show(Request $request, AddressBook $addressBook)
    {
        return response()->json(['data' => $addressBook]);
    }

    public function destroy(Request $request, AddressBook $addressBook)
    {
        return response()->json(['data' => $addressBook->delete()]);
    }

}
