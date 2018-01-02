<?php
namespace app\index\controller;

use app\index\model\Order;
use think\Controller;

class Index extends Controller
{
    public function index($where = null,$pageSize=10)
    {
        $order = new Order();
//        $where['order_date'] = '2016-09-28';
        $list = $order->getList($where,$pageSize);
        $this->assign('list', $list);
        return $this->fetch('index');
    }

    public function orderDetails($orderId='0')
    {
        $order = new Order();
        $list = $order->getOrder($orderId);
        $this->assign('list', $list);
        return $this->fetch('orderDetails');
    }
}
