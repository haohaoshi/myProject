<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020\1\9 0009
 * Time: 10:03
 */

namespace app\admin\model;

use app\common\model\Adminbase;
use think\facade\Session;


class AdminUser extends Adminbase
{
    protected $name = 'admin';
    protected $insert = ['status' => 1];

    /**
     * 用户登录
     * @param string $username 用户名
     * @param string $password 密码
     * @return bool|mixed
     */
    public function login($username = '', $password = '')
    {
        $username = trim($username);
        $password = trim($password);
        $userInfo = $this->getUserInfo($username, $password);
        if (false == $userInfo) {
            return false;
        }
        $this->autoLogin($userInfo);
        return true;
    }

    /**
     * 获取用户信息
     * @param type $identifier 用户名或者用户ID
     * @return boolean|array
     */
    public function getUserInfo($identifier, $password = null)
    {
        if (empty($identifier)) {
            return false;
        }
        $map = array();
        //判断是uid还是用户名
        if (is_int($identifier)) {
            $map['id'] = $identifier;
        } else {
            $map['username'] = $identifier;
        }
        $userInfo = $this->where($map)->find();
        if (empty($userInfo)) {
            return false;
        }
        //密码验证
        if (!empty($password) && encrypt_password($password, $userInfo['encrypt']) != $userInfo['password']) {
            return false;
        }
        return $userInfo;
    }

    /**
     * 自动登录用户
     */
    public function autoLogin($userInfo)
    {
        /* 更新登录信息 */
        $this->loginStatus((int) $userInfo['id']);
        /* 记录登录SESSION和COOKIES */
        $auth = [
            'uid' => $userInfo['id'],
            'username' => $userInfo['username'],
            'last_login_time' => $userInfo['last_login_time'],
        ];
        Session::set('admin_user_auth', $auth);
        Session::set('admin_user_auth_sign', data_auth_sign($auth));
    }

    /**
     * 更新登录状态信息
     * @param type $id
     * @return type
     */
    public function loginStatus($id)
    {
        $data = ['last_login_time' => time(), 'last_login_ip' => request()->ip()];
        return $this->save($data, ['id' => $id]);
    }
}