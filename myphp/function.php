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

//获取客户端ip
function get_client_ip() {
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
        $ip = getenv("HTTP_CLIENT_IP");
    else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
        $ip = getenv("REMOTE_ADDR");
    else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
        $ip = $_SERVER['REMOTE_ADDR'];
    else
        $ip = "unknown";
    return($ip);
}

// 建立递归目录
function Directory( $dir ){
    return  is_dir ( $dir ) or Directory(dirname( $dir )) and  mkdir ( $dir , 0777);
}

//中文日期转换时间戳
function utfTime($str){
    $arr = date_parse_from_format('Y年m月d日',$str);
    $time = mktime(0,0,0,$arr['month'],$arr['day'],$arr['year']);
    return $time;
}

//获取https内容
function curl_gets($url,$referer = '',$ishttp=1)
{
    $ip = array('220.138.60.40','183.60.15.173','120.43.72.20','112.110.20.11','140.50.112.58','128.110.90.23','140.28.100.40','120.58.60.74','200.57.20.114','89.110.11.2','10.57.112.2','10.58.112.3','113.10.21.5');

    $rand = $ip[rand(0,count($ip)-1)];
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    //$cookie = 'JSESSIONID=1ABA8CECECD54692F54FB6C1E6CE8344';
    //curl_setopt ($curl, CURLOPT_COOKIE , $cookie);
    if($ishttp == 1)
    {
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); //不验证证书
        curl_setopt($curl, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
    }
    curl_setopt($curl, CURLOPT_HTTPHEADER , array(
        "CLIENT-IP:{$rand}",
        "X-FORWARDED-FOR:{$rand}"));
    curl_setopt($curl,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36");
    //$referer ? curl_setopt($curl, CURLOPT_REFERER, $referer) : '';
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    $result['data'] = curl_exec($curl);
    if(curl_errno($curl))
    {
        echo 'Curl error: ' . curl_error($curl);
    }
    $result['code'] = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    return $result;
}

//返回时间 当天至月末
function dmTime($nowTime){
    $timeAry = array();
    $endThismonth=(int)date('Ymd',mktime(23,59,59,date('m'),date('t'),date('Y')));
    $nowTime = intval($nowTime);
    for($i=$nowTime;$i<=$endThismonth;$i++){
        if($nowTime<=$endThismonth){
            $timeAry[] = $nowTime++;
        }
    }
    return $timeAry;
}

//返回时间 当天后的30天内的数据
function dmyTime($nowTime){
    $timeAry = array();
    for($i=1;$i<30;$i++){
        $timeAry[] = date('Ymd',strtotime('+'.$i.' day',strtotime($nowTime)));
    }
    return $timeAry;
}

//数组编码转换
function array_iconv($in_charset,$out_charset,$arr){
    return eval('return '.iconv($in_charset,$out_charset,var_export($arr,true).';'));
}











