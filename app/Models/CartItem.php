<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable=['amount'];
    public $timestamps=false;

    //关联user模型
    public function user(){
        return $this->belongsTo(User::class);
    }

    //关联商品SKU
    public function productSku(){
        return $this->belongsTo(ProductSku::class);
    }
}
