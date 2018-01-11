<?php
namespace app\index\model;


use think\Model;

class Provider extends Model
{
    /**
     * 总数
     * @param string $field
     * @return int|string
     */
    public function count($field = '*')
    {
        return parent::count($field);
    }

    /**
     * 获取订单总数
     * @param null $where
     * @return int
     */
    public function getCount($where = null)
    {
        return count($this->where($where)->group('order_date')->order('order_date desc')->select());
    }

    /**
     * 获取订单列表
     * @param null $where
     * @param int $page
     * @param int $pageSize
     * @return false|\PDOStatement|string|\think\Collection
     */

    public function getList($where = null, $pageSize = 10)
    {
        if (!is_numeric($pageSize)) {
            $pageSize = 10;
        }
        return $this->where($where)->group('order_date')->order('order_date desc')->paginate($pageSize);
    }

    /**
     * 获取订单详情
     * @return array
     */
    public function getOrder($orderId = 0)
    {
        return $this->where('order_id', $orderId)->select();
    }
}