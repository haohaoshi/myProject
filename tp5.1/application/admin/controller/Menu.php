<?php
/**
 * Created by PhpStorm.
 * User: Lujz
 * Date: 2020\1\23 0023
 * Time: 11:18
 */

namespace app\admin\controller;


use app\common\controller\Adminbase;
use app\admin\model\Menu as Menu_Model;
//use util\Tree;

class Menu extends Adminbase
{
    //后台菜单首页
    public function index()
    {
        if ($this->request->isAjax()) {
            $tree = new \util\Tree();
            $tree->icon = array('', '', '');
            $tree->nbsp = '';
            $result = Menu_Model::order(array('listorder', 'id' => 'DESC'))->select()->toArray();

            $tree->init($result);
            $_list = $tree->getTreeList($tree->getTreeArray(0), 'title');
            $total = count($_list);
            $result = array("code" => 0, "count" => $total, "data" => $_list);
            return json($result);
        }
        return $this->fetch();

    }
}