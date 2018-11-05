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

/**
 * 可选择式传参
 */
function uncertainParam() {
    $numargs = func_num_args();    //获得传入的所有参数的个数
    echo "参数个数: $numargs\n";
    $args = func_get_args();       //获得传入的所有参数的数组
    var_dump($args);
    foreach($args as $key=>$value){
        //echo '<BR><BR>'.func_get_arg($key);   //获取单个参数的值
        echo '<BR>'.$value;        //单个参数的值
    }
    //var_export($args);
}

//日志输出
function log_ljz($data,$file_name='log_ljz')
{
    if(is_array($data))$data = var_export($data,true);
    $file=dirname(__FILE__)."/{$file_name}.log";
    $res=debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
    $log = "";
    $log .= "执行日期：".strftime("%Y-%m-%d %H:%M:%S",time())."\n ";
    $log .= "文件所在位置：".$res[0]['file'].",位于第".$res[0]['line']."行\n";
    $log .= $data."\n\n";
    file_put_contents($file,$log,FILE_APPEND|LOCK_EX);
}










