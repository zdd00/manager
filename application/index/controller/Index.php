<?php
namespace app\index\controller;

use app\index\model\Admin;
use app\index\model\Order;
use app\index\model\OrderDetails;
use app\index\model\Product;
use app\index\model\Provider;
use think\Controller;
use think\Paginator;

class Index extends Controller
{
    public function index($where = null, $pageSize = 10)
    {
        $order = new Order();
//        $where['order_date'] = '2016-09-28';
        $list = $order->getList($where, $pageSize);
        $this->assign('list', $list);
        return $this->fetch('index');
    }

    /**
     * 获取订单列表
     * @param string $orderId 订单id
     * @param int $pageSize 页数
     * @param null $userId
     * @return mixed
     * @internal param null $user_id 用户id
     */
    public function orderDetails($orderId = '', $pageSize = 5, $userId = null,$provider='')
    {
        $order = new Order();
        $list = $order->orderList($orderId, $userId,$provider)->paginate($pageSize, false, ['query' => request()->param()]);
        $this->assign('list', $list);

        $admin = Admin::all();
        $this->assign('admin', $admin);

        $provider = Provider::all();
        $this->assign('provider', $provider);
        return $this->fetch('orderDetails');
    }

    public function todayOrder()
    {
        return $this->fetch('todayOrder');
    }
}
