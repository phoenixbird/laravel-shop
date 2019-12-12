<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class HandleRefundRequest extends Request
{
    public function rules()
    {
        return [
            'agree'=>['required','boolean'],
            'reason'=>['required_if:agree,false'],//拒绝时候需要输入拒绝理由
        ];
    }
}
