<?php
/**
 * Created by PhpStorm.
 * User: Lujz
 * Date: 2019\8\28 0028
 * Time: 9:35
 */

namespace app\admin\model;
use think\Db;
use think\Model;

class IndexModel extends Model
{

    public function getList(){
        $res = Db::name('coll_article')->find(1);
        return $res;
    }
}