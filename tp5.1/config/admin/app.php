<?php
//配置文件
define('ADMIN_ROLEID',1);//超级管理员id
return [
    'admin_forbid_ip' => '192.168.1.1',//禁止访问的ip，禁用网段192.*
    //控制台配置
    'version'    => [
        'name'      => '管理平台',
        'number'   => 'v1.0',
    ],
];