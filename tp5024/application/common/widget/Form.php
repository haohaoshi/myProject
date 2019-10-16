<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019\9\4 0004
 * Time: 10:58
 */

namespace app\common\widget;


use think\Request;
use think\Url;

class Form extends Base
{
    /**
     * 表单生成
     * @param array $list
     */
    public function form($list = []){
        $html = '<form class="form-inline">';
        /*行模版*/
        $column = '<div class="row">%html%</div>';
        /*临时内容*/
        $temp = '';
        /*列计数*/
        $col = 0;
        foreach ($list as $row){
            /*没有列标识就跳过*/
            if(!isset($row['col'])) continue;
            /*一行超过12列就换行*/
            if($col + $row['col'] > 12){
                $html .= str_replace('%html%',$temp,$column);
                $temp = '';
                $col = 0;
            }
            $col += $row['col'];
            $temp .= $row['html'];
        }
        /*剩余列 + 提交按钮布局*/
        switch(1){
            case $col == 0:
                $temp = $this->empty_col(10) . $this->submit();
                $html .= str_replace('%html%',$temp,$column);
                break;
            case $col <=10:
                $temp .= $this->empty_col(10 - $col) . $this->submit();
                $html .= str_replace('%html%',$temp,$column);
                break;
            default:
                $html .= str_replace('%html%',$temp,$column);
                $temp = $this->empty_col(10) . $this->submit();
                $html .= str_replace('%html%',$temp,$column);
        }
        $html .= '</form>';
        return $html;
    }

    /**
     * 空列
     * @return string
     */
    public function empty_col($col = 1){
        $html = '<div class="col-xs-' . $col . ' col-sm-' . $col . '"></div>';
        return $html;
    }

    /**
     * 提交按钮
     * @return string
     */
    private function submit(){
        $html = '';
        $html .= '<div class="col-xs-1 col-sm-1 text-r">';
        $html .= '<button class="btn btn-success" type="submit"><i class="Hui-iconfont Hui-iconfont-search2"></i>搜索</button>';
        $html .= '</div>';
        $html .= '<div class="col-xs-1 col-sm-1 text-c">';
        $html .= '<a href="' . Url::build('/'.Request::instance()->path()) . '" class="btn btn-default">重置</a>';
        $html .= '</div>';
        return $html;
    }

    /**
     * input框生成
     * @param string $title  列名
     * @param string $field   标签name
     * @param string $current   默认传入的值
     */
    public function input($title = '', $field = '', $current = ''){
        $current = $current ? $current : $this->request->param($field);
        $html = '';
        $html .= '<div class="form-group col-xs-2">';
        $html .= '<label>' . $title . '：</label>';
        $html .= '<input type="text" class="form-control" name="' . $field . '" value="' . $current . '" placeholder="' . $title . '">';
        $html .= '</div>';
        return ['col'=>2,'html'=>$html];
    }



}