<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrowdfundingProduct extends Model
{
    // 定义众筹的 3 种状态
    const STATUS_FUNDING = 'funding';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAIL = 'fail';

    public static $statusMap = [
        self::STATUS_FUNDING => '众筹中',
        self::STATUS_SUCCESS => '众筹成功',
        self::STATUS_FAIL    => '众筹失败',
    ];

    protected $fillable=[
        'total_amount',
        'target_amount',
        'user_count',
        'status',
        'end_at',
    ];
    protected $dates=['end_at'];

    //在数据库文件重不需要created_at和updated_at字段
    public $timestamps=false;

    public function product(){
        return $this->belongsTo(Product::class);
    }

    //定义一个访问器返回当前众筹的进度
    public function getPercentAttribute(){
        $value=$this->attributes['total_amount']/$this->attributes['target_amount'];

        return floatval(number_format($value*100,2,'.',''));
    }
}
