<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;
use App\Models\User;
use App\Models\CouponCode;

$factory->define(Order::class, function (Faker $faker) {
    //随机取一个用户
    $user=User::query()->inRandomOrder()->first();
    //随机取一个该用户的地址
    $address=$user->addresses()->inRandomOrder()->first();
    //百分之10的概率把订单标记为退款
    $refund=random_int(0,10)<1;
    //随机生成发货状态
    $ship=$faker->randomElement(array_keys(Order::$shipStatusMap));
    //优惠券
    $coupon=null;
    //30%的订单使用了优惠券
    if(random_int(0,10)<3){
        //只选择没有最低金额的优惠券
        $coupon = CouponCode::query()->where('min_amount', 0)->inRandomOrder()->first();
        //增加优惠券的使用量
        $coupon->changeUsed();
    }
    return [
        'address'=>[
            'address'=>$address->full_address,
            'zip'=>$address->zip,
            'contact_phone'=>$address->contact_phone,
            'contact_name'=>$address->contact_name,
        ],
        'total_amount'=>0,
        'remark'=>$faker->sentence,
        'paid_at'=>$faker->dateTimeBetween('-30days'),
        'payment_method'=>$faker->randomElement(['alipay','wechat']),
        'payment_no'=>$faker->uuid,
        'refund_status'=>$refund?Order::REFUND_STATUS_SUCCESS:Order::REFUND_STATUS_PENDING,
        'refund_no'=>$refund?Order::getAvailableRefundNo():null,
        'closed'=>false,
        'reviewed'=>random_int(0,10)>2,
        'ship_status'=>$ship,
        'ship_data'=>$ship===Order::SHIP_STATUS_PENDING?null:[
            'express_company'=>$faker->company,
            'express_no'=>$faker->uuid,
        ],
        'extra'=>$refund ? ['refund_reason' => $faker->sentence] : [],
        'user_id'=>$user->id,
        'coupon_code_id'=>$coupon ? $coupon->id : null,
    ];
});
