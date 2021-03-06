<?php
/**
 * Created by PhpStorm.
 * User: Lujz
 * Date: 2018\10\16 0016
 * Time: 13:25
 */
//设置超时时间
set_time_limit(0);

//设置内存大小
ini_set("memory_limit","32kb");

//开启报错提示
ini_set("display_errors","on");
error_reporting(E_ALL | E_STRICT);

//设置编码
header("Content-Type:text/html;charset=utf-8");

//跨域问题（允许所有域名）
header('Access-Control-Allow-Origin:*');

//跨域问题（指定域名）
$origin = isset($_SERVER['HTTP_ORIGIN'])? $_SERVER['HTTP_ORIGIN'] : '';
$allow_origin = array(
    'http://cms.cloud.cnfol.com',
    'http://cloud.3g.cnfol.com'
);
if(in_array($origin, $allow_origin)){
    header('Access-Control-Allow-Origin:'.$origin);
}

$result = '';
/**
 * 格式化输出
 * @param $data
 */
function dump(){
    echo "<pre>";
    var_dump($GLOBALS['result']);
    //die;
}

/**
 * 返回16位md5值
 **/
function md5To16($str){
    return substr(md5($str), 8, 16);
}

/**
 * //清空特殊空格为正常空格
 * @param $str
 * @return null|string|string[]
 */
function strim($str){
    $str = preg_replace('/(\s|\&nbsp\;|　|\xc2\xa0)/',' ',$str);
    return $str;
}

/**
 * 返回json结构,并支持ajax跨域
 *
 * @param array  $data 数据
 * @param string $call 匿名函数
 * @return json
 */
function returnJson($data = array(), $call = '')
{
    if(empty($call)){
        exit(json_encode($data, JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE));
    } else {
        exit($call.'('.json_encode($data, JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE).')');
    }

}

//日志输出
function log_test($data,$file_name='log_test')
{
    if(is_array($data))$data = var_export($data,true);
    $file_name .= date('Ymd');
    $file=dirname(__FILE__)."/{$file_name}.log";
    $res=debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
    $log = "";
    $log .= "执行日期：".strftime("%Y-%m-%d %H:%M:%S",time())."\n ";
    $log .= "文件所在位置：".$res[0]['file'].",位于第".$res[0]['line']."行\n";
    $log .= $data."\n\n";
    file_put_contents($file,$log,FILE_APPEND|LOCK_EX);
}
//日志
function datalog($data='',$errtype='1',$filename='errlog',$filepath='datalog'){
    $filepath=RUNTIME_PATH.$filepath;
    if(!is_dir($filepath)){
        mkdir($filepath,0777,true);
    }
    $myfile=fopen($filepath.'/'.$filename.date('Y-m-d').'.log', 'a');
    $string="";
    $string.='[TIME]：'.date('Y-m-d H:i:s')."\r\n";
    if(is_array($data))$string.='[DATA]：'.var_export($data,true)."\r\n";
    if(is_string($data))$string.='[DATA]：'.$data."\r\n";
    if($errtype)$string.='-------------------------------------'."\r\n";
    fwrite($myfile,$string);
    fclose($myfile);
}

/**
 * curl  get
 * @param $url
 * @param int $time  超时时间
 * @return mixed
 */
function curl_get($url,$time=15){
    $ip = array('220.138.60.40','183.60.15.173','120.43.72.20','112.110.20.11','140.50.112.58','128.110.90.23','140.28.100.40','120.58.60.74','200.57.20.114','89.110.11.2','10.57.112.2','10.58.112.3','113.10.21.5');
    $rand = $ip[rand(0,count($ip)-1)];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, $time); //设置超时时间
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//获取内容后，true保存变量形式，false直接输出
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//是否验证证书
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); //是否抓取跳转后的页面
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.47 Safari/536.11");//模拟浏览器
    curl_setopt($ch, CURLOPT_HTTPHEADER , array("CLIENT-IP:{$rand}","X-FORWARDED-FOR:{$rand}"));//模拟ip
    curl_setopt($ch, CURLOPT_ENCODING, "");//忽略页面格式  如gzip
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

/**
 * curl  post
 * @param string $url  请求地址
 * @param array $param 参数
 * @param int $time  超时时间
 * @return mixed
 */
function curl_post($url,$param,$time=15){
    $ip = array('220.138.60.40','183.60.15.173','120.43.72.20','112.110.20.11','140.50.112.58','128.110.90.23','140.28.100.40','120.58.60.74','200.57.20.114','89.110.11.2','10.57.112.2','10.58.112.3','113.10.21.5');
    $rand = $ip[rand(0,count($ip)-1)];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, $time); //设置超时时间
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//获取内容后，true保存变量形式，false直接输出
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//是否验证证书
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); //是否抓取跳转后的页面
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.47 Safari/536.11");//模拟浏览器
    curl_setopt($ch, CURLOPT_HTTPHEADER , array("CLIENT-IP:{$rand}","X-FORWARDED-FOR:{$rand}"));//模拟ip
    curl_setopt($ch, CURLOPT_ENCODING, "");//忽略页面格式  如gzip
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

/**
 * 表格信息 转换数组
 * @param $table
 * @return mixed
 */
function TabToArr($table){
    $table = preg_replace("'<tr[^>]*?>'si","",$table);
    $table = preg_replace("'<td[^>]*?>'si","",$table);
    $table = preg_replace("'<th[^>]*?>'si","",$table);
    $table = str_replace("</tr>","{tr}",$table);
    $table = str_replace("</td>","{td}",$table);
    $table = str_replace("</th>","",$table);
    $table = preg_replace("'<[/!]*?[^<>]*?>'si","",$table);
    $table = preg_replace("'([rn])[s]+'","",$table);
    $table = str_replace(" ","",$table);
    $table = preg_replace("'[\s]'si","",$table);
    $table = explode('{tr}', $table);
    array_pop($table);//删除最后一个
    array_shift($table);//删除第一个
    $td_array = array();
    foreach ($table as $key=>$tr) {
        $tr =trim($tr);
        $tr = str_replace(chr(10),'',$tr); //去掉换行
        $td = explode('{td}', $tr);
        array_pop($td);
        $td_array[] = $td;
    }
    return $td_array;
}

/**
 * curl POST
 * @param   string  url
 * @param   array   数据
 * @param   int     请求超时时间
 * @param   bool    HTTPS时是否进行严格认证
 * @return  string
 */
function curlPost($url, $data = array(), $timeout = 30, $CA = true){
    $cacert = getcwd() . '/cacert.pem'; //CA根证书
    $SSL = substr($url, 0, 8) == "https://" ? true : false;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout-2);
    if ($SSL && $CA) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);   // 只信任CA颁布的证书
        curl_setopt($ch, CURLOPT_CAINFO, $cacert); // CA根证书（用来验证的网站证书是否是CA颁布）
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // 检查证书中是否设置域名，并且是否与提供的主机名匹配
    } else if ($SSL && !$CA) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1); // 检查证书中是否设置域名
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:')); //避免data数据过长问题
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); //data with URLEncode
    $ret = curl_exec($ch);
    //var_dump(curl_error($ch));  //查看报错信息
    curl_close($ch);
    return $ret;
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

/**
 * 获取客户端IP地址
 *
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @return mixed
 */
function ip_address($type = 0)
{
    $type = $type ? 1 : 0;
    static $ip =  NULL;

    if($ip !== NULL) return $ip[$type];

    if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos = array_search('unknown', $arr);

        if(FALSE !== $pos) unset($arr[$pos]);
        $ip = trim($arr[0]);
    }
    else if(isset($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    else if(isset($_SERVER['REMOTE_ADDR']))
    {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    /* IP地址合法验证 */
    $long = sprintf("%u", ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);

    return $ip[$type];
}

/**
 * 执行curl
 *
 * @param string $url       请求地址
 * @param array $param      请求参数
 * @param string $type      请求类型
 * @param string $dataType  请求的数据类型
 * @param int $timeout      超时时间
 *
 * @return mixed 返回请求响应内容
 *
 */
function _curl($url, $param = array(), $type = 'post', $dataType = '', $timeout = 5) {

    $curl = curl_init();                                            // 初始化
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  // 设置返回值
    if(is_numeric($timeout) && $timeout >= 0) curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);    // 设置超时时间
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);  // 检测服务器的域名与证书上的是否一致，关闭
    $type = strtolower($type);
    if($type == 'get' && $param) { // get请求
        $url .= (strpos($url, '?') === false? '&': '?') .  http_build_query($param);
    }
    else if($type == 'post') { // post请求
        curl_setopt($curl, CURLOPT_POST, 1);   // 开启post
        curl_setopt($curl, CURLOPT_POSTFIELDS, $param); // 设置post数据
    }
    curl_setopt($curl, CURLOPT_URL, $url); // 设置url
    $result = curl_exec($curl);   // 执行
    curl_close($curl);   // 关闭
    // 如果请求的数据类型是json 自动转义
    return (strtolower($dataType) == 'json')? json_decode($result, true) : $result;
}

/**
 * 使用file_get_contents  post请求
 * @param $url
 * @param $post_data
 * @return bool|string
 */
function send_post($url,$post_data) {
    $postdata = http_build_query($post_data);
    $options = array(
        'http' => array(
            'method' => 'POST',//注意要大写
            'header' => 'Content-type:application/x-www-form-urlencoded',
            'content' => $postdata
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return $result;
}


/**
 * @param string $url 跳转地址
 * @param string $msg 提示信息
 * @param int $sleep 等待毫秒数
 */
function _exit($url = '', $msg = '', $sleep = 0) {

    header("Content-Type:text/html;charset=utf-8");

    $url = addslashes($url);
    $msg = addslashes($msg);

    exit("<html>
页面跳转中...
<script>
    if('{$msg}') alert('{$msg}');
    setTimeout(function() {

        const url = '{$url}';
        if(url) {
            
            window.location.href = url;
        }
        else {
            
            history.go(-1);
        }
    }, {$sleep});
</script>        
</html>");
}

/**
 * 检查参数
 *
 * @param $param
 * @param $require
 * @return bool
 *
 */
function _checkParam($param, $require) {

    foreach ($require as $item) {

        if(!isset($param[$item])) {

            $res = "[{$item}]必填";
            var_dump($res);
            return false;
        }
    }

    return true;
}

/**
 * 过滤不需要的参数
 *
 * @param array $param 进行过滤的参数数组
 * @param array $filter 指定需要的参数名
 * @return array
 */
function _param_filter($param, $filter) {

    $filter = array_fill_keys($filter, '');
    return array_intersect_key($param, $filter);
}

/**
 * 返回多久以前
 * @param $the_time  传入的时间  Ymd
 * @return string
 */
function timeStr($the_time) {
    $now_time = date("Y-m-d H:i:s", time());
    //echo $now_time;
    $now_time = strtotime($now_time);
    $show_time = strtotime($the_time);
    $dur = $now_time - $show_time;
    if ($dur < 0) {
        return $the_time;
    } else {
        if ($dur < 60) {
            return $dur . '秒前';
        } else {
            if ($dur < 3600) {
                return floor($dur / 60) . '分钟前';
            } else {
                if ($dur < 86400) {
                    return floor($dur / 3600) . '小时前';
                } else {
                    if ($dur < 259200) {//3天内
                        return floor($dur / 86400) . '天前';
                    } else {
                        return $the_time;
                    }
                }
            }
        }
    }
}

//加密函数
function lock_url($txt='',$key='md5')
{
    if(!$txt)return $txt;
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+";
    $nh = rand(0,64);
    $ch = $chars[$nh];
    $mdKey = md5($key.$ch);
    $mdKey = substr($mdKey,$nh%8, $nh%8+7);
    $txt = base64_encode($txt);
    $tmp = '';
    $i=0;$j=0;$k = 0;
    for ($i=0; $i<strlen($txt); $i++) {
        $k = $k == strlen($mdKey) ? 0 : $k;
        $j = ($nh+strpos($chars,$txt[$i])+ord($mdKey[$k++]))%64;
        $tmp .= $chars[$j];
    }
    return urlencode($ch.$tmp);
}
//解密函数
function unlock_url($txt='',$key='md5')
{
    if(!$txt)return $txt;
    $txt = urldecode($txt);
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+";
    $ch = $txt[0];
    $nh = strpos($chars,$ch);
    $mdKey = md5($key.$ch);
    $mdKey = substr($mdKey,$nh%8, $nh%8+7);
    $txt = substr($txt,1);
    $tmp = '';
    $i=0;$j=0; $k = 0;
    for ($i=0; $i<strlen($txt); $i++) {
        $k = $k == strlen($mdKey) ? 0 : $k;
        $j = strpos($chars,$txt[$i])-$nh - ord($mdKey[$k++]);
        while ($j<0) $j+=64;
        $tmp .= $chars[$j];
    }
    return base64_decode($tmp);
}


/*
$array:需要排序的数组
$keys:需要根据某个key排序
$sort:倒叙还是顺序
*/
function arraySort($array,$keys,$sort='asc') {
    $newArr = $valArr = array();
    foreach ($array as $key=>$value) {
        $valArr[$key] = $value[$keys];
    }
    ($sort == 'asc') ?  asort($valArr) : arsort($valArr);//先利用keys对数组排序，目的是把目标数组的key排好序
    reset($valArr); //指针指向数组第一个值
    foreach($valArr as $key=>$value) {
        $newArr[$key] = $array[$key];
    }
    return $newArr;
}

/**
2019-12-18 模拟get 获取URl 设置超时时间 默认5秒
$url 要访问的地址
$type 访问类型 0 curl, 1 get , 2 curl压缩格式
$time 超时时间 默认 5秒
 */
function curl_get_contents($url,$type=0,$time=15) {
    if($type == 1){
        $ctx = stream_context_create(array(
                'http' => array(
                    'timeout' => $time //设置一个超时时间，单位为秒
                ),
                "ssl"=>array(
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                )
            )
        );
        $data = file_get_contents($url, 0, $ctx);
        return $data;
    }

    $ip = array('220.138.60.40','183.60.15.173','120.43.72.20','112.110.20.11','140.50.112.58','128.110.90.23','140.28.100.40','120.58.60.74','200.57.20.114','89.110.11.2','10.57.112.2','10.58.112.3','113.10.21.5');
    $rand = $ip[rand(0,count($ip)-1)];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, $time); //设置超时时间
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//如果请求成功返回结果，否则返回false
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//取消证书验证
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); //是否抓取跳转后的页面
    if($type == 2){//处理页面压缩
        curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
    }else{
        if($url)if(in_array('Content-Encoding: gzip',get_headers($url)))curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
    }
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.47 Safari/536.11");//模拟浏览器
    curl_setopt($ch, CURLOPT_HTTPHEADER , array("CLIENT-IP:{$rand}","X-FORWARDED-FOR:{$rand}"));//模拟ip
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

/**
 * 获取当前请求的完整url
 * @return string
 */
function get_url() {
    $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
    $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
    $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
    $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
    return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
}

/**
 *
 * 安全过滤函数,主要用于防范sql注入
 *
 * @param  mixed   $string 字符串/数组
 * @param  integer $force  强制进行过滤
 * @param  boolean $strip  是否需要去除反转义符号
 * @return mixed
 */
function cnfol_addslashes($string, $force = 1, $strip = FALSE)
{
    /* 如果是表单则需要判断MAGIC_QUOTES_GPC状态 */
    !defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
    if(@!MAGIC_QUOTES_GPC || $force)
    {
        if(is_array($string))
        {
            foreach($string as $key => $val)
            {
                $string[$key] = cnfol_addslashes($val, $force, $strip);
            }
        }
        else
        {
            $string = addslashes($strip ? stripslashes($string) : $string);
        }
    }
    $string = filter_sql($string);
    $string = filter_str($string);
    $string = filter_html($string);

    return $string;
}

/**
 * 安全过滤函数2,过滤html、进制代码
 *
 * @param  mixed $string 需要过滤的数据
 * @param  mixed $flags  是否使用PHP自带函数
 * @return mixed
 */
function filter_html($string, $flags = NULL)
{
    if(is_array($string))
    {
        foreach($string as $key => $val)
            $string[$key] = filter_html($val, $flags);
    }
    else
    {
        if($flags === NULL)
        {
            $string = str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string);
            if(strpos($string, '&amp;#') !== FALSE)
                $string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4}));)/', '&\\1', $string);
        }
        else
        {
            if(PHP_VERSION < '5.4.0')
                $string = htmlspecialchars($string, $flags);
            else
                $string = htmlspecialchars($string, $flags, 'UTF-8');
        }
    }
    return $string;
}

/**
 * 安全过滤函数3,数据加下划线防止SQL注入
 *
 * @param  string $value 需要过滤的值
 * @return string
 */
function filter_sql($value)
{
    /*可能会被转移selectsselecteselectlselecteselectcselecttselect这个字符串照样可以输出select*/
    $sql = array("select", 'insert', "update", "delete", "\'", "\/\*",
        "\.\.\/", "\.\/", "union", "into", "load_file", "outfile");
    $sql_re = array("","","","","","","","","","","","");

    return str_replace($sql, $sql_re, $value);
}

/**
 * 安全过滤函数4,过滤特殊有危害字符
 *
 * @param string $value 需要过滤的数据
 * @return string
 */
function filter_str($value)
{
    $value = str_replace(array("\0","%00","\r"), '', $value);
    $value = preg_replace(array('/[\\x00-\\x08\\x0B\\x0C\\x0E-\\x1F]/','/&(?!(#[0-9]+|[a-z]+);)/is'), array('', '&amp;'), $value);
    $value = str_replace(array("%3C",'<'), '&lt;', $value);
    $value = str_replace(array("%3E",'>'), '&gt;', $value);
    $value = str_replace(array('"',"'","\t",'  '), array('&quot;','&#39;','    ','&nbsp;&nbsp;'), $value);

    return $value;
}





