<?php
/***********************************************************
 * copyright(C): Jeffry<w@jeffry.cn>
 * description:  主播控制器
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
 * description: 主播管理类
 *+-----------------------------------------------
 * @author:     Pante  2018/2/4 12:13
 *+-----------------------------------------------
 * @Class:       AnchorController
 * @package Manage\Controller
 */
class AnchorController extends ComController{
	
	/**
	 * description: 主播管理
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/4 12:14
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
	public function index(){
        
        $p = isset($_GET['p']) ? intval($_GET['p']) : '1';
        $field = isset($_GET['field']) ? $_GET['field'] : '';
        $keyword = isset($_GET['keyword']) ? htmlentities($_GET['keyword']) : '';
        $order = isset($_GET['order']) ? $_GET['order'] : 'DESC';
        $where = '';
		
        $prefix = C('DB_PREFIX');
		
        if ($order == 'asc') {
            $order = "{$prefix}anchor.t desc";
        } elseif (($order == 'desc')) {
            $order = "{$prefix}anchor.t asc";
        } else {
            $order = "{$prefix}anchor.uid desc";
        }
        if ($keyword <> '') {
            if ($field == 'user') {
                $where = "{$prefix}member.user LIKE '%$keyword%'";
            }
            if ($field == 'phone') {
                $where = "{$prefix}member.phone LIKE '%$keyword%'";
            }
        }
        $anchor = M('anchor');
        $pagesize = 10;//每页数量
	    $offset = $pagesize * ($p - 1);//计算记录偏移量
	    $count = $anchor->field("{$prefix}anchor.*,{$prefix}member.uid,{$prefix}member.user,{$prefix}member.username,{$prefix}member.sex,{$prefix}member.phone,{$prefix}auth_group.id as gid,{$prefix}auth_group.title")
		    ->order($order)
		    ->join("{$prefix}member ON {$prefix}anchor.uid = {$prefix}member.uid")
		    ->join("{$prefix}auth_group_access ON {$prefix}member.uid = {$prefix}auth_group_access.uid")
		    ->join("{$prefix}auth_group ON {$prefix}auth_group.id = {$prefix}auth_group_access.group_id")
		    ->where($where)
		    ->count();
	    $list = $anchor->field("{$prefix}anchor.*,{$prefix}member.*,{$prefix}auth_group.id as gid,{$prefix}auth_group.title")
		    ->order($order)
		    ->join("{$prefix}member ON {$prefix}anchor.uid = {$prefix}member.uid")
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
        $this->display();
    }

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

    public function edit(){
        $anchor_id = isset($_GET['anchor_id']) ? intval($_GET['anchor_id']) : false;
        if ($anchor_id) {
            //$member = M('member')->where("uid='$uid'")->find();
            $prefix = C('DB_PREFIX');
            $anchor = M('anchor');
	        $anchor = $anchor->field("{$prefix}anchor.*,{$prefix}member.user,{$prefix}member.username,{$prefix}member.phone")
	            ->join("{$prefix}member ON {$prefix}anchor.uid = {$prefix}member.uid")
	            ->where("{$prefix}anchor.anchor_id=$anchor_id")
	            ->find();
	        $this->assign('anchor', $anchor);
	        
	        //处理开始结束时间
	        $this->assign('order_start_end', explode('-', $anchor['order_time']));
	        
	        $map = array('anchor_id' => $anchor_id);
	        $anchor_type = M('anchorType')->where($map)->select();
	        $anchor_type_array = array();
	        if($anchor_type){
	            $anchor_type_array = array_column($anchor_type, 'serve_id');
	        }
	        $this->assign('anchor_type', $anchor_type);
	        $this->assign('anchor_category', $anchor_type_array);
	        
        } else {
            $this->error('参数错误！');
        }
	    
        $charm = C('ANCHOR_CHARM');
	    if($charm){
		    $anchor_type_array = array_column($charm, 'serve_id');
	    }
        $this->assign('charm', $charm);
        //职业
	    $profession = C('ANCHOR_PROFESSION');
        $this->assign('profession', $profession);
	    
        //接单时间
	    $order_time = C('ANCHOR_BUSINESS_HOURS');
        $this->assign('order_time', $order_time);
	    
        $where = array('status' => 1);
        $category = M('serveType')->where($where)->select();
	    
        $this->assign('category', $category);
        
        $this->display('form');
    }

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
        $data['class']      = isset($_POST['class']) ? intval($_POST['class']) : 0;
        $head = I('post.head', '', 'strip_tags');
        $data['head']       = $head ? $head : '';
        $data['sex']        = isset($_POST['sex']) ? intval($_POST['sex']) : 0;
        $data['birthday']   = isset($_POST['birthday']) ? strtotime($_POST['birthday']) : 0;
        $data['phone']      = isset($_POST['phone']) ? trim($_POST['phone']) : '';
        $data['qq']         = isset($_POST['qq']) ? trim($_POST['qq']) : '';
        $data['email']      = isset($_POST['email']) ? trim($_POST['email']) : '';
        $data['attestation']= isset($_POST['attestation']) ? intval($_POST['attestation']) : 0;
        $data['prov']       = isset($_POST['prov']) ? trim($_POST['prov']) : '';
        $data['city']       = isset($_POST['city']) ? trim($_POST['city']) : '';
        $data['contribution']= isset($_POST['contribution']) ? intval($_POST['contribution']) : 0;
        $data['is_anchor']  = isset($_POST['is_anchor']) ? intval($_POST['is_anchor']) : 0;
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
	
    public function add()
    {
        $category = M('ServeType')->field('serve_type_id id,pid,title name')->order('sort asc')->select();
        $this->assign('category', $category);//导航

        $usergroup = M('AuthGroup')->field('id,title')->select();
        $this->assign('usergroup', $usergroup);

        $user_class= C('USER_CLASS');

        $this->assign('user_class', $user_class);
        $this->display('form');
    }
	
	
	/**
	 * description: 主播审核页面
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/4 10:44
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
	public function check(){
		$p = isset($_GET['p']) ? intval($_GET['p']) : '1';
		$field = isset($_GET['field']) ? $_GET['field'] : '';
		$keyword = isset($_GET['keyword']) ? htmlentities($_GET['keyword']) : '';
		$order = isset($_GET['order']) ? $_GET['order'] : 'DESC';
		
		$prefix = C('DB_PREFIX');
		
		if ($order == 'asc') {
			$order = "{$prefix}member.st asc";
		}else{
			$order = "{$prefix}member.st desc";
		}
		
		//过滤提交申请
		$where = "{$prefix}member.step >= 1";
		
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
		
		$this->display();
	}
	
	/**
	 * description: 保存审核
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/4 10:43
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
	public function checkUpdate(){
		$uid = I('get.uid',0,'intval');
		if($uid == 0){
			$this->error('没有传入正确的用户ID');
		}
		$step = I('get.step',0,'intval');
		
		if($step == 0){
			$data['step'] = 3;
		}else{
			//新增主播记录
			$result = $this -> _createAnchor($uid);
			if(!$result){
				addlog('新增主播失败，UID：' . $uid);
				$this->error('操作失败！');
			}
			addlog('新增主播，用户ID：'.$uid.', 主播ID：' . $result);
			$data['step'] = 4;
		}
		
		M('member')->data($data)->where("uid=$uid")->save();
		addlog('审核主播申请信息，会员UID：' . $uid." 审核结果：".($step == 0 ? '驳回' : '通过'));
		
		$this->success('操作成功！');
	}
	
	/**
	 * description: 提交主播申请
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/4 10:43
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
	public function apply(){
		$uid = I('get.uid',0,'intval');
		if($uid == 0){
			$this->error('没有传入正确的用户ID');
		}
		$data['step'] = 1;
		
		M('member')->data($data)->where("uid=$uid")->save();
		addlog('主播提交申请信息，会员UID：' . $uid);
		
		$this->success('操作成功！');
	}
	
	/**
	 * description: 新增主播记录
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/4 12:11
	 * @access:     public
	 *+-----------------------------------------------
	 * @param $uid
	 * @history:    更改记录
	 */
	private function _createAnchor($uid){
		$data['uid'] = $uid;
		$data['t']   = time();
		$data['u']   = time();
		$anchor_id = M('anchor')->data($data)->add();
		return $anchor_id;
	}
}
