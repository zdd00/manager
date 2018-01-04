<?php
namespace app\index\model;


use think\Model;

class Product extends Model
{
    function getList()
    {
        $list = parent::select();
        var_dump($list->toArray());
    }
}