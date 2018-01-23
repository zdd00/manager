<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/10 0010
 * Time: 上午 9:42
 */

namespace app\index\model;

use think\Model;
use think\response\Json;

class OrderDetails extends Model
{
    public function getTodayOrder($order_id = '', $userId = '', $provider = '')
    {
        $where = [];
        if ($order_id != '') $where['a.order_id'] = $order_id;
        if ($userId != '') $where['a.user_id'] = $userId;
        if ($provider != '') $where['c.id'] = $provider;
        return $this->alias('a')->where($where)->join('xzg_product b', 'a.product_id=b.id')->join('xzg_provider c', 'b.provider_id=c.id')->field('a.id,a.order_id,a.order_number,b.product_name,c.provider,a.product_id,a.user_id,SUM(a.order_number) sum')->group('a.product_id');
    }

    public function setOrder($param = [], $order_id = '')
    {
        if ($param != []) {
            $data = [];
            foreach ($param as $key => $value) {
                foreach ($value as $i => $item) {
                    if (!($key == 'id' && $item == '')) {
                        $data[$i]['order_id'] = $order_id;
                        $data[$i][$key] = $item;
                    }
                }
            }
            return $this->saveAll($data);
        }
    }

    public function dropOrder($order_id = '', $product_id = '',$user_id='')
    {
        if ($order_id != '' && $product_id != '') {
            return $this->where(['order_id' => $order_id, 'product_id' => $product_id,'user_id'=>$user_id]);
        }else{
            return false;
        }
    }
}