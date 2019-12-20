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

//方法注入
function getUserInfo($request,$userid){
    //dump($userid);
    return '方法注入：'.$userid;
}

function myFilter($request,$param){
    dump($param);
    //$param = safety_filter($param);
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
function safety_filter($string, $force = 1, $strip = FALSE)
{
    /* 如果是表单则需要判断MAGIC_QUOTES_GPC状态 */
    !defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
    if(@!MAGIC_QUOTES_GPC || $force)
    {
        if(is_array($string))
        {
            foreach($string as $key => $val)
            {
                $string[$key] = safety_filter($val, $force, $strip);
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
