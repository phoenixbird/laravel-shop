<?php

namespace App\Admin\Controllers;

use App\Exceptions\InvalidRequestException;
use App\Http\Requests\Admin\HandleRefundRequest;
use App\Models\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class OrdersController extends AdminController
{
    use ValidatesRequests;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '订单列表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order);

        //显示已支付订单，并且按照支付时间倒序排序
        $grid->model()->whereNotNull('paid_at')->orderBy('paid_at','desc');

        $grid->no('订单流水号');
        //展现关联关系时候使用column方法
        $grid->column('user.name','买家');
        $grid->total_amount('总金额')->sortable();
        $grid->paid_at('支付时间')->sortable();
        $grid->ship_status('物流')->display(function ($value){
            return Order::$shipStatusMap[$value];
        });
        //禁用创建按钮，后台不需要创建，这个根据需求来
        $grid->disableCreateButton();
        $grid->actions(function ($actions){
            //禁用删除和编辑按钮
            $actions->disableDelete();
            $actions->disableEdit();
        });
        $grid->tools(function ($tools){
            //禁用批量删除按钮
            $tools->batch(function ($batch){
                $batch->disableDelete();
            });
        });
        return $grid;
    }

    //显示订单详情
    public function show($id, Content $content)
    {
        return $content->header('订单详情')
            ->body(view('admin.orders.show',['order'=>Order::find($id)]));
    }

    //订单物流
    public function ship(Order $order,Request $request){
        //判断当前订单是否已经支付
        if(!$order->paid_at){
            throw new InvalidRequestException('该订单未支付');
        }
        //判断订单状态是否已发货
        if($order->ship_status!==Order::SHIP_STATUS_PENDING){
            throw new InvalidRequestException('该订单已发货');
        }
        $data=$this->validate($request,[
            'express_company'=>['required'],
            'express_no'=>['required'],
        ],[],[
            'express_company'=>'物流公司',
            'express_no'=>'物流单号',
        ]);
        //将订单发货状态更新为已发货，并传入物流信息
        $order->update([
            'ship_status'=>Order::SHIP_STATUS_DELIVERED,
            'ship_data'=>$data,
        ]);
        //返回上一页
        return redirect()->back();
    }

    //处理退款问题
    public function handleRefund(Order $order,HandleRefundRequest $request){
        // 判断订单状态是否正确
        if ($order->refund_status !== Order::REFUND_STATUS_APPLIED) {
            throw new InvalidRequestException('订单状态不正确');
        }
        //是否同意退款
        if($request->input('agree')){
            //todo
        }else{
            // 将拒绝退款理由放到订单的 extra 字段中
            $extra = $order->extra ?: [];
            $extra['refund_disagree_reason'] = $request->input('reason');
            // 将订单的退款状态改为未退款
            $order->update([
                'refund_status' => Order::REFUND_STATUS_PENDING,
                'extra'         => $extra,
            ]);
        }
        return $order;
    }
}
