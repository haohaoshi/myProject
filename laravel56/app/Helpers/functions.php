<?php
/**
 * Created by PhpStorm.
 * User: Lujz
 * Date: 2018\11\26 0026
 * Time: 16:50
 */

/**
 * 公用的方法  返回json数据，进行信息的提示
 * @param $status 状态
 * @param string $message 提示信息
 * @param array $data 返回数据
 */
function showMsg($status,$message = '',$data = array()){
    $result = array(
        'status' => $status,
        'message' =>$message,
        'data' =>$data
    );
    exit(json_encode($result));
}

/**
 * 日志输出
 * @param $data
 * @param string $file_name 文件名
 */
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


