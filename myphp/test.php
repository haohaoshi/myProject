<?php
/**
 * Created by PhpStorm.
 * User: Lujz
 * Date: 2018\10\12 0012
 * Time: 14:16
 */
require_once 'function.php';
/**
 * @param $url
 * @param int $type  file_get_content  1 get,2 post   curl 3 get,4post
 * @param string $param  参数
 * @param int $time  超时时间
 */
function get_html($url,$type=1,$param='',$special='',$time=5){

    if($type <= 2){
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
    }else{
        $ch = curl_init();
        if($type == 3 & $param){
            $url .= (strpos($url, '?') === false? '&': '?') .  http_build_query($param);
        }elseif($type == 4){
            curl_setopt($ch, CURLOPT_POST, 1);   // 开启post
            if($param)curl_setopt($ch, CURLOPT_POSTFIELDS, $param); // 设置post数据
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $time); //设置超时时间
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //不验证证书
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); //是否抓取跳转后的页面
        $data = curl_exec($ch);
    }
    return $data?$data:array();

}
$url = 'http://www.dyhjw.com/cjrl/cindex.html';
$res = file_get_contents($url);
var_dump($res);die;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);   // 开启post
curl_setopt($ch, CURLOPT_POSTFIELDS, array('date'=>'2019-04-29')); // 设置post数据
curl_setopt($ch, CURLOPT_TIMEOUT, 10); //设置超时时间
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //不验证证书
//curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); //是否抓取跳转后的页面
$data = curl_exec($ch);
curl_close($curl);

var_dump($data);