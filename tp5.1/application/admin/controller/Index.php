<?php
namespace app\admin\controller;

use app\common\controller\Adminbase;
use app\admin\model\AdminUser;
use app\admin\service\User;

class Index extends Adminbase
{
    protected $noNeedLogin = [
        'admin/index/login',
        'admin/index/logout',
    ];
    protected $noNeedRight = [
        'admin/index/index',
        'admin/index/cache',
    ];

    public function index()
    {
        $this->assign('userInfo', $this->_userinfo);
        $this->assign("SUBMENU_CONFIG", (string)json_encode(model("admin/Menu")->getMenuList()));
        return view();
    }

    /**
     * 登录
     */
    public function login(){
        if (User::instance()->isLogin()) {
            $this->redirect('admin/index/index');
        }
        if($this->request->isPost()){
            $data = $this->request->post();
            //验证码
//            if (!captcha_check($data['verify'])) {
//                $this->error('验证码输入错误！');
//                return false;
//            }

            // 验证数据
            $rule = [
                'verify|验证码'=>'require|captcha',
                'username|用户名' => 'require|alphaDash|length:5,20',
                'password|密码' => 'require|length:5,20',
            ];
            $result = $this->validate($data, $rule);
            if (true !== $result) {
                $this->error($result);
            }

            $AdminUser = new AdminUser;
            if ($AdminUser->login($data['username'], $data['password'])) {
                $this->success('恭喜您，登陆成功', url('admin/Index/index'));
            } else {
                $this->error("用户名或者密码错误，登陆失败！", url('admin/index/login'));
            }
        }else{
            return view();
        }
    }

    //手动退出登录
    public function logout()
    {
        if (User::instance()->logout()) {
            $this->success('注销成功！', url("admin/index/login"));
        }
    }
}
