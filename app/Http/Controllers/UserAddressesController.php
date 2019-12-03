<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddressRequest;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressesController extends Controller
{
    //
    public function index(Request $request){
        return view('user_addresses.index',[
            'addresses'=>$request->user()->addresses
        ]);
    }

    //新增收货地址信息
    public function create()
    {
        return view('user_addresses.create_and_edit', ['address' => new UserAddress()]);
    }

    public function store(UserAddressRequest $request){
        $request->user()->addresses()->create($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));
        return redirect()->route('user_addresses.index');
    }

    //修改页面控制器
    public function edit(UserAddress $user_address){
        $this->authorize('own', $user_address);
        return view('user_addresses.create_and_edit',['address'=>$user_address]);
    }

    //更新字段
    public function update(UserAddress $user_address, UserAddressRequest $request)
    {$this->authorize('own', $user_address);
        $user_address->update($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));

        return redirect()->route('user_addresses.index');
    }

    //删除
    public function destroy(UserAddress $user_address)
    {
        $this->authorize('own', $user_address);
        $user_address->delete();
        //把redirect改成[]
        return [];
    }
}
