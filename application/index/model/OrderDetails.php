<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/10 0010
 * Time: 上午 9:42
 */

namespace app\index\model;

use think\Model;

class OrderDetails extends Model
{
    public function getTodayOrder($order_id = '')
    {
        if ($order_id != '') {
            return $this->alias('a')->where('a.order_id', $order_id)->join('xzg_product b', 'a.product_id=b.id')->join('xzg_provider c','b.provider_id=c.id')->field('a.order_id,a.order_number,b.product_name,c.provider');
        }
        return null;
    }
}