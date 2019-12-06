<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Jobs\CloseOrder;
use App\Models\Order;
use App\Models\ProductSku;
use App\Models\UserAddress;
use App\Services\CartService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\OrderService;


class OrdersController extends Controller
{
    public function store(OrderRequest $request,OrderService $orderService){
        $user    = $request->user();
        $address = UserAddress::find($request->input('address_id'));

        return $orderService->store($user, $address, $request->input('remark'), $request->input('items'));
    }

    //订单列表
    public function index(Request $request){
        $orders= Order::query()
            //使用预加载方法避免N+1问题
            ->with(['items.product','items.productSku'])
            ->where('user_id',$request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate();
        return view('orders.index', ['orders' => $orders]);
    }

    //显示订单详情页
    public function show(Order $order,Request $request){
        //校验用户查看自己的订单
        $this->authorize('own', $order);
        return view('orders.show',['order'=>$order->load(['items.productSku', 'items.product'])]);
    }
}
