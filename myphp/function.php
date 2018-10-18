<?php
/**
 * Created by PhpStorm.
 * User: Lujz
 * Date: 2018\10\16 0016
 * Time: 13:25
 */

$result = '';
/**
 * 格式化输出
 * @param $data
 */
function dump(){
    echo "<pre>";
    var_dump($GLOBALS['result']);
    die;
}

/**
 * 数组键的大小写转换（只对一级有效）
 * @param array $data
 * @param int $type 默认小写，1大写，0小写
 * @return array
 */
function ary_dx($data,$type=0){
    if(is_array($data)){
        $res = array_change_key_case($data,$type? CASE_UPPER :CASE_LOWER);
        return $res;
    }else{
        return $data;
    }
}










