<?php

namespace App\Listeners;

use App\Events\OrderPaid;
use App\Models\OrderItem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateProductSoldCount implements ShouldQueue
{
    //laravel会默认执行监听器的handle方法，触发事件作为handle方法的参数
    /**
     * Handle the event.
     *
     * @param  OrderPaid  $event
     * @return void
     */
    public function handle(OrderPaid $event)
    {
        //从事件对象中取出相应的订单
        $order=$event->getOrder();
        //预加载商品数据
        $order->load('items.product');
        //循环遍历订单的商品
        foreach($order->items as $item){
            $product=$item->product;
            //计算对应的商品销量
            $soldCount=OrderItem::query()->where('product_id',$product->id)
                ->whereHas('order',function($query){
                    $query->whereNotNull('paid_at');
                })->sum('amount');
            //更新商品的销量
            $product->update([
                'sold_count'=>$soldCount,
            ]);
        }
    }
}
