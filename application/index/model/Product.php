<?php

namespace app\index\model;

use think\Model;

class Product extends Model
{

    public function productList($type = '', $provider = '')
    {
        $where = [];
        if ($type != '') $where['a.type_id'] = $type;
        if ($provider != '') $where['a.provider_id'] = $provider;
        return $this->alias('a')->where($where)->join('xzg_type b', 'a.type_id=b.id')->join('xzg_provider c', 'a.provider_id=c.id');
    }
}