<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019\12\19 0019
 * Time: 16:44
 */

namespace app\common\widget;


class Submit extends Base
{
    /**
     * 表单生成
     * @param array $list  列
     * @param string $action  请求地址
     * @param int $type  按钮类型 1登录按钮
     * @return string
     */
    public function form($list = [],$action='',$type=1){
        $action = $action?$action:url();
        $html = '<form class="layui-form" action="'.$action.'">';
        /*行模版*/
        $column = '<div class="layui-form-item">%html%</div>';
        /*行内模版*/
        $inline = '<div class="layui-input-inline input-item">%html%</div>';
        /*临时内容*/
        $temp = '';
        foreach ($list as $row){
            $temp .= str_replace('%html%',$row,$inline);
        }
        if($type == 1)$temp .= $this->submit_button();
        $html .= str_replace('%html%',$temp,$column);
        $html .= '</form>';
        return $html;
    }

    /**
     * input生成框
     * @param string $title  列名
     * @param string $field  标签name，id
     * @return string
     */
    public function input($title = '', $field = ''){
        $html = '';
        $html .= '<label for="'.$field.'">'.$title.':</label>';
        $html .= '<input type="text" class="layui-input" name="'.$field.'" id="'.$field.'" placeholder="'.$title.'" lay-verify="'.$field.'" autocomplete="off">';
        return $html;
    }

    /**
     * 验证码
     * @param string $title  列名
     * @param string $field  标签name，id
     * @return string
     */
    public function captcha($title = '验证码', $field = 'verify'){
        $html = '<div class="layui-input-inline input-item verify-box">';
        $html .= '<label for="'.$field.'">'.$title.':</label>';
        $html .= '<input type="text" name="'.$field.'" id="'.$field.'" lay-verify="required" placeholder="'.$title.'" autocomplete="off" class="layui-input">';
        $html .= '<img id="'.$field.'_img" src="'.url('\\think\\captcha\\CaptchaController@index','font_size=18&imageW=130&imageH=38').'" alt="'.$title.'" class="captcha">';
        $html .= '</div>';
        return $html;
    }

    /**
     * 表单提交按钮
     * @param string $title  列名
     * @param string $field  标签name，id
     * @return string
     */
    public function submit_button($title = '登录', $field = 'login_but'){
        $html = '<div class="layui-input-inline login-btn">';
        $html .= '<button class="layui-btn" lay-filter="login" lay-submit="" name="'.$field.'" id="'.$field.'" >'.$title.'</button>';
        $html .= '</div>';
        return $html;
    }

}












