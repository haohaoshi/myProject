<?php
/**
 * Created by PhpStorm.
 * User: Lujz
 * Date: 2020\1\21 0021
 * Time: 16:25
 */

namespace app\admin\model;


use app\common\model\Adminbase;
use app\admin\service\User;

class Menu extends Adminbase
{
    /**
     * 获取菜单
     * @return type
     */
    final public function getMenuList()
    {
        $data = $this->getTree(0);
        return $data;
    }

    /**
     * 取得树形结构的菜单
     * @param type $myid
     * @param type $parent
     * @param type $Level
     * @return type
     */
    final public function getTree($myid, $parent = "", $Level = 1)
    {
        $data = $this->adminMenu($myid);
        $Level++;
        if (is_array($data)) {
            $ret = null;
            foreach ($data as $a) {
                $id = $a['id'];
                $name = $a['app'];
                $controller = $a['controller'];
                $action = $a['action'];
                //附带参数
                $fu = "";
                if ($a['parameter']) {
                    $fu = "?" . $a['parameter'];
                }
                $array = array(
                    "menuid" => $id,
                    "id" => $id . $name,
                    "title" => $a['title'],
                    "icon" => $a['icon'],
                    "parent" => $parent,
                    "url" => url("{$name}/{$controller}/{$action}{$fu}", array("menuid" => $id)),
                );
                $ret[$id . $name] = $array;
                $child = $this->getTree($a['id'], $id, $Level);
                //由于后台管理界面只支持三层，超出的不层级的不显示
                if ($child && $Level <= 3) {
                    $ret[$id . $name]['items'] = $child;
                }
            }
        }
        return $ret;
    }

    /**
     * 按父ID查找菜单子项
     * @param integer $parentid   父菜单ID
     * @param integer $with_self  是否包括他自己
     */
    final public function adminMenu($parentid, $with_self = false)
    {
        $parentid = (int) $parentid;
        $result = $this->where(array('parentid' => $parentid, 'status' => 1))->order('listorder ASC,id ASC')->cache(60)->select()->toArray();
        if (empty($result)) {
            $result = array();
        }
        if ($with_self) {
            $parentInfo = $this->where(array('id' => $parentid))->find();
            $result2[] = $parentInfo ? $parentInfo : array();
            $result = array_merge($result2, $result);
        }
        //是否超级管理员
        if (User::instance()->isAdministrator()) {
            return $result;
        }
        $array = array();
        foreach ($result as $v) {
            $rule = $v['app'] . '/' . $v['controller'] . '/' . $v['action'];
            if ($this->checkRule($rule, [1, 2], null)) {
                $array[] = $v;
            }
        }
        return $array;
    }
}