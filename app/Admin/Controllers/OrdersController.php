<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class OrdersController extends AdminController
{
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

    public function show($id, Content $content)
    {
        return $content->header('订单详情')
            ->body(view('admin.orders.show',['order'=>Order::find($id)]));
    }
}
