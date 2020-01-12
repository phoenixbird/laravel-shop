<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    //
    protected $fillable = [
        'province',
        'city',
        'district',
        'address',
        'zip',
        'contact_name',
        'contact_phone',
        'last_used_at'
    ];

    protected $dates = ['last_used_at'];

    protected $appends = ['full_address'];

    //与User模型关联 一对多 一个User可以有多个UserAddress
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //创建一个访问器，后面的代码就不需要拼接了，直接用$address->full_address调用
    public function getFullAddressAttribute()
    {
        return "{$this->province}{$this->city}{$this->district}{$this->address}";
    }
}
