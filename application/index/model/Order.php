<?php

namespace app\index\model;


use think\exception\DbException;
use think\Model;

class Order extends Model
{
    public function getList($where, $pageSize)
    {
        return $this->where($where)->paginate($pageSize);
    }

    /**
     * 获取订单菜品列表
     * @param string $orderId
     * @param null $userId
     * @return false|\PDOStatement|string|\think\Collection
     */

    public function orderList($orderId = '', $userId = '', $provider = '')
    {
        $where = [];
        if ($orderId != '') $where['a.order_id'] = $orderId;
        if ($userId != '') $where['b.user_id'] = $userId;
        if ($provider != '') $where['c.provider_id'] = $provider;
        return $this->alias('a')->where($where)->join('xzg_order_details b', 'a.order_id=b.order_id')->join('xzg_product c', 'b.product_id=c.id')->field('b.order_id,b.order_number,c.product_name,c.provider_id');

    }

}

