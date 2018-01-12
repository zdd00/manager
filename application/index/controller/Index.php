<?php

namespace app\index\controller;

use app\index\model\Admin;
use app\index\model\Order;
use app\index\model\OrderDetails;
use app\index\model\Product;
use app\index\model\Provider;
use app\index\model\Type;
use think\Controller;
use think\exception\DbException;
use think\Paginator;
use think\response\Json;

class Index extends Controller
{
    /**
     * 订单列表
     * @param null $where
     * @param int $pageSize
     * @return mixed
     */
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
     * @param string $provider
     * @return mixed
     * @throws \think\exception\DbException
     * @internal param null $user_id 用户id
     */
    public function orderDetails($orderId = '', $pageSize = 5, $userId = '', $provider = '')
    {
        $order = new Order();
        $list = $order->orderList($orderId, $userId, $provider)->paginate($pageSize, false, ['query' => request()->param()]);
        $this->assign('list', $list);

        $admin = Admin::all();
        $this->assign('admin', $admin);

        $provider = Provider::all();
        $this->assign('provider', $provider);
        return $this->fetch('orderDetails');
    }

    public function order()
    {
        return $this->fetch('order');
    }

    public function todayOrder()
    {
        return $this->fetch('todayOrder');
    }

    /**
     * 菜品管理
     * @param string $type
     * @param string $provider
     * @param string $pageSize
     * @return mixed
     */
    public function product($type = '', $provider = '', $pageSize = '20')
    {
        $product = new Product();
        $list = $product->productList($type, $provider)->paginate($pageSize, false, ['query' => request()->param()]);
        $this->assign('list', $list);
        $admin = Type::all();
        $this->assign('type', $admin);

        $provider = Provider::all();
        $this->assign('provider', $provider);
        return $this->fetch('product');
    }

    public function productEdit($data)
    {
        $product = new Product();
        return $product->edit($data);
    }

    public function productDel($data)
    {
        $product = new Product();
        return $product->del($data);
    }

    /**
     * 供应人管理
     * @param string $pageSize
     * @return mixed
     */
    public function provider($pageSize = '20')
    {
        $product = new Provider();
        $list = $product->providerList()->paginate($pageSize, false, ['query' => request()->param()]);
        $this->assign('list', $list);
        return $this->fetch('provider');
    }

    public function providerEdit($data)
    {
        $product = new Provider();
        return $product->edit($data);
    }

    public function providerDel($data)
    {
        $product = new Provider();
        return $product->del($data);
    }
}
