<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019\9\4 0004
 * Time: 10:58
 */

namespace app\common\widget;

class Select extends Base
{
    /**
     * 表单生成
     * @param array $list  列
     * @param int $offExcel  添加导出Excel按钮，1是，0否
     * @return string
     */
    public function form($list = [],$offExcel=0){
        $html = '<form class="layui-form" action="" onsubmit="return false">';
        /*行模版*/
        $column = '<div class="layui-form-item">%html%</div>';
        /*行内模版*/
        $inline = '<div class="layui-inline">%html%</div>';
        /*临时内容*/
        $temp = '';
        foreach ($list as $row){
            $temp .= str_replace('%html%',$row,$inline);
        }
        $temp .= $this->submit();
        if($offExcel)$temp .= $this->inputExcel();
        $html .= str_replace('%html%',$temp,$column);
        $html .= '</form>';
        return $html;
    }

    /**
     * 提交按钮
     * @return string
     */
    private function submit(){
        $html = '';
        $html .= '<button class="layui-btn" data-type="reload">搜索</button>';
        $html .= '<button type="reset" class="layui-btn layui-btn-primary">重置</button>';
        return $html;
    }

    /**
     * 生成按钮
     * $param	$title	按钮名
     * $param	$field	标签属性id、name、data-type
     * @return string
     */
    public function button($title = '按钮', $field){
        $html = '';
        $html .= '<button class="layui-btn" id="'.$field.'" name="'.$field.'" data-type="'.$field.'">'.$title.'</button>';
        return $html;
    }

    /**
     * 链接按钮
     * $param	$title	按钮名
     * $param	$field	标签属性id、name、data-type
     * @return string
     */
    public function a($title = '按钮', $field){
        $html = '';
        $html .= '<a class="layui-btn" id="'.$field.'" name="'.$field.'" data-type="'.$field.'">'.$title.'</a>';
        return $html;
    }

    /**
     * 导出Excel按钮
     * @return string
     */
    private function inputExcel($title = '导出Excel'){
        $html = '';
        $html .= '<button type="button" class="layui-btn layui-btn-warm" lay-filter="uploadImg" id="dowExcel"><i class="layui-icon"></i>'.$title.'</button>';
        return $html;
    }

    /**
     * input生成框
     * @param string $title  列名
     * @param string $field  标签name，id
     * @param string $current  默认传入的值
     * @return string
     */
    public function input($title = '', $field = '', $current = ''){
        $current = $current ? $current : $this->request->param($field);
        $html = '';
        $html .= '<label class="layui-form-label">'.$title.':</label>';
        $html .= '<div class="layui-input-inline">';
        $html .= '<input type="text" class="layui-input" name="'.$field.'" id="'.$field.'" value="'.$current.'" autocomplete="off">';
        $html .= '</div>';
        return $html;
    }

    /**
     * input范围标签
     * @param string $title  列名
     * @param string $field  标签name，id
     * @param string $currentMin  默认传入的最小值
     * @param string $currentMax  默认传入的最大值
     * @return string
     */
    public function inputRange($title = '', $field = '', $currentMin = '', $currentMax = ''){
        $currentMin = $currentMin ? $currentMin : $this->request->param($field.'Min');
        $currentMax = $currentMax ? $currentMax : $this->request->param($field.'Max');
        $html = '';
        $html .= '<label class="layui-form-label">'.$title.':</label>';
        $html .= '<div class="layui-input-inline" style="width: 100px;">';
        $html .= '<input type="number" name="'.$field.'Min" id="'.$field.'Min" value="'.$currentMin.'" placeholder="" autocomplete="off" class="layui-input">';
        $html .= '</div>';
        $html .= '<div class="layui-form-mid">至</div>';
        $html .= '<div class="layui-input-inline" style="width: 100px;">';
        $html .= '<input type="number" name="'.$field.'Max" id="'.$field.'Max" value="'.$currentMax.'" placeholder="" autocomplete="off" class="layui-input">';
        $html .= '</div>';
        return $html;
    }

    /**
     * input时间范围
     * @param string $title  列名
     * @param string $field  标签name，id
     * @return string
     */
    public function timeRange($title = '', $field = ''){
        $html = '';
        $html .= '<label class="layui-form-label">'.$title.':</label>';
        $html .= '<div class="layui-input-inline">';
        $html .= '<input type="text" class="layui-input" name="'.$field.'" id="'.$field.'" placeholder=" - ">';
        $html .= '</div>';
        return $html;
    }

    /**
     * input时间范围
     * @param string $title  列名
     * @param string $field  标签name，id
     * @return string
     */
    public function timeRange1($title = '', $field = ''){
        $html = '';
        $html .= '<label class="layui-form-label">'.$title.':</label>';
        $html .= '<div class="layui-input-inline" style="width: 100px;">';
        $html .= '<input type="text" class="layui-input" name="'.$field.'Min" id="'.$field.'Min" >';
        //$html .= '<input type="text" name="'.$field.'Min" id="'.$field.'Min" value=""  autocomplete="off" class="layui-input">';
        $html .= '</div>';
        $html .= '<div class="layui-form-mid">至</div>';
        $html .= '<div class="layui-input-inline" style="width: 100px;">';
        //$html .= '<input type="text" name="'.$field.'Max" id="'.$field.'Max" value=""  autocomplete="off" class="layui-input">';
        $html .= '<input type="text" class="layui-input" name="'.$field.'Max" id="'.$field.'Max" >';
        $html .= '</div>';
        return $html;
    }

    /**
     * 生成选择框
     * @param string $title  列名
     * @param string $field  标签name，id
     * @param array $list  内容
     * @param int $type  是否默认生成0 option
     * @param string $current  默认传入的值
     * @return string
     */
    public function select($title = '', $field = '',$list = [] , $type = 1, $current = ''){
        $current = $current ? $current : $this->request->param($field);
        $option = $this->option($list,$current,$type);
        $html = '';
        $html .= '<label class="layui-form-label">'.$title.':</label>';
        $html .= '<div class="layui-input-inline">';
        $html .= '<select name="'.$field.'" id="'.$field.'" lay-verify="required">';
        $html .= $option;
        $html .= '</select>';
        $html .= '</div>';
        return $html;
    }

    /**
     * 生成选择框内容
     * @param array $list
     * @param int $type  是否初始0  1是，0否
     * @return string
     */
    public function option($list = [],$current,$type=1){
        $html = '';
        if($list){
            if($type) $html .= '<option value="0"></option>';
            foreach ($list as $k => $v){
                $select = ($current == $k)?' selected="selected" ':'';
                $html .= '<option value="'.$k.'" '.$select.'>'.$v.'</option>';
            }
        }
        return $html;
    }

}