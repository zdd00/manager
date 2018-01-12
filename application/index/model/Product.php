<?php

namespace app\index\model;

use think\Model;
use think\response\Json;

class Product extends Model
{

    public function productList($type = '', $provider = '')
    {
        $where = [];
        if ($type != '') $where['a.type_id'] = $type;
        if ($provider != '') $where['a.provider_id'] = $provider;
        return $this->alias('a')->where($where)->join('xzg_type b', 'a.type_id=b.id')->join('xzg_provider c', 'a.provider_id=c.id')->field('a.product_name,b.type_name,c.provider,a.id,a.type_id,a.provider_id')->order('a.create_time desc');
    }

    public function edit($data = ['id' => ''])
    {
        $id = $data['id'];
        unset($data['id']);
        if ($id != '') {//更新
            if ($this->save($data, ['id' => $id])) {
                return Json::create(['status' => 1]);
            } else {
                return Json::create(['status' => 2]);
            }
        } else {//新增
            $this->data($data);
            if ($this->save()) {
                return Json::create(['status' => 3]);
            } else {
                return Json::create(['status' => 4]);
            }
        }
    }
    public function del($data=''){;
        if($data!=''){
            if($this->destroy($data)){
                return Json::create(['status' => 1]);
            }else{
                return Json::create(['status' => 2]);
            }
        }else{
            return Json::create(['status' => 2]);
        }
    }
}