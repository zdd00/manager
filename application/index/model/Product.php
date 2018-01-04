<?php
namespace app\index\model;


use think\Model;

class Product extends Model
{
    function getList()
    {
        $list = parent::select();
        return array_group_by($list,'type_name');;
    }
}