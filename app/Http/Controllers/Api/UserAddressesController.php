<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserAddressRequest;
use Illuminate\Http\Request;
use App\Models\UserAddress;

class UserAddressesController extends Controller
{
    //
    public function index(Request $request)
    {
        return response()->json(['data' => $request->user()->addresses]);
    }

    public function store(Request $request)
    {
        $request->validate([
            //
            'province'      => 'required',
            'city'          => 'required',
            'district'      => 'required',
            'address'       => 'required',
            'zip'           => 'required',
            'contact_name'  => 'required',
            'contact_phone' => 'required',
            'is_default' => 'required',
        ]);
        if ($request->is_default) {
            $request->user()->addresses()->update(['is_default' => false]);
        }
        $address = $request->user()->addresses()->create($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
            'is_default',
        ]));
        return response()->json(['data' => $address]);
    }

    public function show(UserAddress $userAddress)
    {
        $this->authorize('own', $userAddress);

        return response()->json(['data' => $userAddress]);
    }


    public function update(UserAddress $user_address, Request $request)
    {
        $this->authorize('own', $user_address);
        if ($request->is_default) {
            $request->user()->addresses()->update(['is_default' => false]);
        }
        $user_address->update($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
            'is_default',
            ]));
        return response()->json(['data' => $user_address]);
    }

    public function destroy(UserAddress $user_address)
    {
        $this->authorize('own', $user_address);
        return response()->json(['data' => $user_address->delete()]);
    }
}
