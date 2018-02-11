<?php
/***********************************************************
 * copyright(C): Jeffry<w@jeffry.cn>
 * description:  用户控制器
 * version:      v1.0.0
 * function:     包含方法列表
 *
 * @author:      Pante
 * @datetime:    2018/1/31 16:21
 * @others:      Use the PhpStorm
 *
 * history:      修改记录
 ***********************************************************/
namespace Manage\Controller;

/**
 * description: 用户操作类
 *+-----------------------------------------------
 * @author:     Pante  2018/2/4 10:48
 *+-----------------------------------------------
 * @Class:       MemberController
 * @package Manage\Controller
 */
class MemberController extends ComController{
	
	/**
	 * description: 用户组管理
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/4 10:46
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
    public function index(){
        $p = isset($_GET['p']) ? intval($_GET['p']) : '1';
        $field = isset($_GET['field']) ? $_GET['field'] : '';
        $keyword = isset($_GET['keyword']) ? htmlentities($_GET['keyword']) : '';
        $order = isset($_GET['order']) ? $_GET['order'] : 'DESC';
        $get_group = isset($_GET['get_group']) ? $_GET['get_group'] : '';
        $where = '';

        $prefix = C('DB_PREFIX');
        if($get_group <> ''){
            $where = "{$prefix}auth_group.id=".$get_group;
        }

        if ($order == 'asc') {
            $order = "{$prefix}member.t asc";
        } elseif (($order == 'desc')) {
            $order = "{$prefix}member.t desc";
        } else {
            $order = "{$prefix}member.uid asc";
        }
        if ($keyword <> '') {
            if ($field == 'user') {
                $where = "{$prefix}member.user LIKE '%$keyword%'";
            }
            if ($field == 'phone') {
                $where = "{$prefix}member.phone LIKE '%$keyword%'";
            }
        }

        $user = M('member');
        $pagesize = 10;#每页数量
        $offset = $pagesize * ($p - 1);//计算记录偏移量
        $count = $user->field("{$prefix}member.*,{$prefix}auth_group.id as gid,{$prefix}auth_group.title")
            ->order($order)
            ->join("{$prefix}auth_group_access ON {$prefix}member.uid = {$prefix}auth_group_access.uid")
            ->join("{$prefix}auth_group ON {$prefix}auth_group.id = {$prefix}auth_group_access.group_id")
            ->where($where)
            ->count();

        $list = $user->field("{$prefix}member.*,{$prefix}auth_group.id as gid,{$prefix}auth_group.title")
            ->order($order)
            ->join("{$prefix}auth_group_access ON {$prefix}member.uid = {$prefix}auth_group_access.uid")
            ->join("{$prefix}auth_group ON {$prefix}auth_group.id = {$prefix}auth_group_access.group_id")
            ->where($where)
            ->limit($offset . ',' . $pagesize)
            ->select();
        //$user->getLastSql();
        $page = new \Think\Page($count, $pagesize);
        $page = $page->show();

        $this->assign('list', $list);
        $this->assign('page', $page);
        $group = M('auth_group')->field('id,title')->select();
        $this->assign('group', $group);
        $this->display();
    }
	
	/**
	 * description: 删除用户组
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/4 10:46
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
    public function del(){

        $uids = isset($_REQUEST['uids']) ? $_REQUEST['uids'] : false;
        //uid为1的禁止删除
        if ($uids == 1 or !$uids) {
            $this->error('参数错误！');
        }
        if (is_array($uids)) {
            foreach ($uids as $k => $v) {
                if ($v == 1) {//uid为1的禁止删除
                    unset($uids[$k]);
                }
                $uids[$k] = intval($v);
            }
            if (!$uids) {
                $this->error('参数错误！');
                $uids = implode(',', $uids);
            }
        }

        $map['uid'] = array('in', $uids);
        if (M('member')->where($map)->delete()) {
            M('auth_group_access')->where($map)->delete();
            addlog('删除会员UID：' . $uids);
            $this->success('恭喜，用户删除成功！');
        } else {
            $this->error('参数错误！');
        }
    }
	
	/**
	 * description: 编辑用户组
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/4 10:46
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
    public function edit(){
        $uid = isset($_GET['uid']) ? intval($_GET['uid']) : false;
        if ($uid) {
            //$member = M('member')->where("uid='$uid'")->find();
            $prefix = C('DB_PREFIX');
            $user = M('member');
            $member = $user->field("{$prefix}member.*,{$prefix}auth_group_access.group_id")->join("{$prefix}auth_group_access ON {$prefix}member.uid = {$prefix}auth_group_access.uid")->where("{$prefix}member.uid=$uid")->find();

        } else {
            $this->error('参数错误！');
        }

        $usergroup = M('auth_group')->field('id,title')->select();
        $this->assign('usergroup', $usergroup);

        $this->assign('member', $member);
        $this->display('form');
    }
	
	/**
	 * description: 保存用户组
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/4 10:45
	 * @access:     public
	 *+-----------------------------------------------
	 * @param string $ajax
	 * @history:    更改记录
	 */
    public function update($ajax = ''){
        if ($ajax == 'yes') {
            $uid = I('get.uid', 0, 'intval');
            $gid = I('get.gid', 0, 'intval');
            M('auth_group_access')->data(array('group_id' => $gid))->where("uid='$uid'")->save();
            die('1');
        }

        $uid        = isset($_POST['uid']) ? intval($_POST['uid']) : false;
        $user       = isset($_POST['user']) ? htmlspecialchars($_POST['user'], ENT_QUOTES) : '';
        $group_id   = isset($_POST['group_id']) ? intval($_POST['group_id']) : 0;
        $password   = isset($_POST['password']) ? trim($_POST['password']) : false;

        $data['username']   = isset($_POST['username']) ? htmlspecialchars($_POST['username'], ENT_QUOTES) : '';
        if ($password) {
            $data['password']   = password($password);
        }
        $head = I('post.head', '', 'strip_tags');
        $data['head']       = $head ? $head : '';
        $data['sex']        = isset($_POST['sex']) ? intval($_POST['sex']) : 0;
        $data['birthday']   = isset($_POST['birthday']) ? strtotime($_POST['birthday']) : 0;
        //验证生日
        if($data['birthday'] > 0){
	        $age = get_age($_POST['birthday']);
        	$data['age']    = $age ? $age : 0;
        	$data['animal'] = get_animal(date('Y', $data['birthday']));
        	$month = date('m', $data['birthday']);
        	$day   = date('d', $data['birthday']);
        	$data['constellation'] = get_constellation($month, $day);
        }
        $data['phone']      = isset($_POST['phone']) ? trim($_POST['phone']) : '';
        $data['qq']         = isset($_POST['qq']) ? trim($_POST['qq']) : '';
        $data['email']      = isset($_POST['email']) ? trim($_POST['email']) : '';
        $data['attestation']= isset($_POST['attestation']) ? intval($_POST['attestation']) : 0;
        $data['prov']       = isset($_POST['prov']) ? trim($_POST['prov']) : '北京';
        $data['city']       = isset($_POST['city']) ? trim($_POST['city']) : '东城区';
        $data['contribution']= isset($_POST['contribution']) ? intval($_POST['contribution']) : 0;
        $data['static']     = isset($_POST['static']) ? intval($_POST['static']) : 0;
        $data['lt']         = time();

        //新建
        if (!$uid) {
            if ($user == '') {
                $this->error('用户名称不能为空！');
            }
            if (!$password) {
                $this->error('用户密码不能为空！');
            }
            if (M('member')->where("user='$user'")->count()) {
                $this->error('用户名已被占用！');
            }
            if ($data['username'] == ''){
                $data['username'] = $user;
            }
            $data['user'] = $user;
            $data['t'] = time();
            //用户表
            $uid = M('member')->data($data)->add();

            M('auth_group_access')->data(array('group_id' => $group_id, 'uid' => $uid))->add();
            addlog('新增会员，会员UID：' . $uid);
        } else {
            M('auth_group_access')->data(array('group_id' => $group_id))->where("uid=$uid")->save();
            addlog('编辑会员信息，会员UID：' . $uid);
            M('member')->data($data)->where("uid=$uid")->save();

        }
        $this->success('操作成功！');
    }
	
	
	/**
	 * description: 新增用户组
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/4 10:45
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
    public function add(){
        $usergroup = M('AuthGroup')->field('id,title')->select();
        $this->assign('usergroup', $usergroup);

        $this->display('form');
    }
	
	

}
