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
    public function product()
    {
        return $this->morphOne('Product','nameable');
    }
}