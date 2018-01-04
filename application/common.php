<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function array_group_by($arr, $key)
{
    $grouped = [];
    foreach ($arr as $value) {
        $grouped[$value[$key]][] = $value;
    }
    if (func_num_args() > 2) {
        $args = func_get_args();
        foreach ($grouped as $key => $value) {
            $parms = array_merge([$value], array_slice($args, 2, func_num_args()));
            $grouped[$key] = call_user_func_array('array_group_by', $parms);
        }
    }
    return $grouped;
}

