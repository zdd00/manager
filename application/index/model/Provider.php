<?php
namespace app\index\model;


use think\Model;
use think\response\Json;

class Provider extends Model
{
    public function providerList(){
        return $this->order('create_time desc');
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