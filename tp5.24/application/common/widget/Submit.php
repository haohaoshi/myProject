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
     * @return string
     */
    public function form($list = [],$action=''){
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
        $html .= str_replace('%html%',$temp,$column);
        $html .= '</form>';
        return $html;
    }

    /**
     * input生成框
     * @param string $title  列名
     * @param string $field  标签name，id
     * @param bool $verify  验证
     * @return string
     */
    public function input($title = '', $field = '', $verify = 'required'){
        $html = '';
        $html .= '<label for="'.$field.'">'.$title.':</label>';
        $html .= '<input type="text" class="layui-input" name="'.$field.'" id="'.$field.'" placeholder="'.$title.'" lay-verify="'.$verify.'" autocomplete="off">';
        return $html;
    }
}