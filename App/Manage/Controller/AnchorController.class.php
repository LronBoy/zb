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
    
    public function serve(){
	    $p = isset($_GET['p']) ? intval($_GET['p']) : '1';
	    $keyword = isset($_GET['keyword']) ? htmlentities($_GET['keyword']) : '';

	
	    $prefix = C('DB_PREFIX');

	    $anchor_id = isset($_GET['anchor_id']) ? intval(($_GET['anchor_id'])) : 0;
	    if($anchor_id < 1){
            $this->error('参数错误！');
        }

        $where = "{$prefix}anchor_type.anchor_id = {$anchor_id}";

	    if ($keyword <> '') {
		    $where .= " and {$prefix}serve_type.title LIKE '%$keyword%'";
	    }
	    $anchor = M('anchorType');
	    $pagesize = 10;//每页数量
	    $offset = $pagesize * ($p - 1);//计算记录偏移量
	    $count = $anchor->field("{$prefix}anchor_type.*,{$prefix}serve_type.title,{$prefix}serve_type.class,{$prefix}serve_type.way")
		    ->join("{$prefix}serve_type ON {$prefix}anchor_type.serve_id = {$prefix}serve_type.serve_type_id")
		    ->where($where)
		    ->count();
	    $list = $anchor->field("{$prefix}anchor_type.*,{$prefix}serve_type.title,{$prefix}serve_type.class,{$prefix}serve_type.way")
            ->join("{$prefix}serve_type ON {$prefix}anchor_type.serve_id = {$prefix}serve_type.serve_type_id")
            ->where($where)
		    ->limit($offset . ',' . $pagesize)
		    ->select();

	    if(is_array($list) && !empty($list)){
	        $anchor_serve_way = C('ANCHOR_SERVE_WAY');

            foreach ($list as $lk => &$lv){
                //分类等级
                $class_array_temp = isset($lv['class']) ? explode(',', $lv['class']) : array();
                $lv['class_str']    = isset($class_array_temp[$lv['level']]) ? $class_array_temp[$lv['level']] : '无';
                //收费类型
                $lv['way_str']      = isset($anchor_serve_way[$lv['way']]) ? $anchor_serve_way[$lv['way']] : '无';
            }
        }

	
	    //$user->getLastSql();
	    $page = new \Think\Page($count, $pagesize);
	    $page = $page->show();
	
	    $this->assign('list', $list);
	    $this->assign('page', $page);
	    $this->display();
    }


    public function serveUpdate(){


        $anchor_type_id  = isset($_POST['anchor_type_id']) ? intval($_POST['anchor_type_id']) : 0;



        if($anchor_type_id < 1) $this->error('该分类不存在！');

        //更新anchor主播信息表
        $data['level']      = isset($_POST['level']) ? intval($_POST['level']) : 0;
        $data['price']      = isset($_POST['price']) ? intval($_POST['price']) : 0;
        $data['num']        = isset($_POST['num']) ? intval($_POST['num']) : 0;
        $data['description']= isset($_POST['description']) ? trim($_POST['description']) : '';
        $data['t']          = time();


        M('anchorType') -> data($data) -> where("anchor_type_id=$anchor_type_id") -> save();
        addlog('修改主播分类信息ID：' . $anchor_type_id);


        $this->success('操作成功！');
    }


    /**
     * description: 编辑主播分类
     *+-----------------------------------------------
     * @author:     jeffry  2018/2/27 20:54
     * @access:     public
     *+-----------------------------------------------
     */
    public function serveEdit(){
        $anchor_type_id = isset($_GET['anchor_type_id']) ? intval($_GET['anchor_type_id']) : false;
        if ($anchor_type_id) {
            //$member = M('member')->where("uid='$uid'")->find();
            $prefix = C('DB_PREFIX');
            $anchor_type        = M('anchor_type');

            $anchor_type_info = $anchor_type->field("{$prefix}anchor_type.*,{$prefix}anchor.uid,{$prefix}member.username,{$prefix}serve_type.title,{$prefix}serve_type.class,{$prefix}serve_type.way")
                ->join("{$prefix}anchor ON {$prefix}anchor.anchor_id = {$prefix}anchor_type.anchor_id")
                ->join("{$prefix}member ON {$prefix}anchor.uid = {$prefix}member.uid")
                ->join("{$prefix}serve_type ON {$prefix}serve_type.serve_type_id = {$prefix}anchor_type.serve_id")
                ->where("{$prefix}anchor_type.anchor_type_id=$anchor_type_id")
                ->find();

            if(is_array($anchor_type_info) && !empty($anchor_type_info)){
                $anchor_serve_way = C('ANCHOR_SERVE_WAY');
                $anchor_type_info['way_str'] = isset($anchor_serve_way[$anchor_type_info['way']]) ? $anchor_serve_way[$anchor_type_info['way']] : '';
            }

            $this->assign('anchor_type', $anchor_type_info);

            $this->display('serveEdit');

        }else{
            $this->error('参数错误！');
        }

    }


    /**
     * description: 删除主播服务分类
     *+-----------------------------------------------
     * @author:     jeffry  2018/2/27 20:51
     * @access:     public
     *+-----------------------------------------------
     */
    public function serveDel(){
        $uids = isset($_REQUEST['anchor_type_id']) ? $_REQUEST['anchor_type_id'] : false;
        //uid为1的禁止删除
        if (!$uids) {
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

        $map['anchor_type_id'] = array('in', $uids);

        if (M('anchorType')->where($map)->delete()) {
            addlog('删除主播分类anchor_type_id：' . $uids);
            $this->success('恭喜，删除主播分类成功！');
        } else {
            $this->error('参数错误！');
        }
    }

	
	/**
	 * description: 主播删除
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/26 15:57
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
    public function del(){
        $uids = isset($_REQUEST['anchor_id']) ? $_REQUEST['anchor_id'] : false;
        //uid为1的禁止删除
        if (!$uids) {
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

        $map['anchor_id'] = array('in', $uids);
        
		//更改用户主播状态member表更新状态
		$member_step_data = array(
			'step'  =>  0,
			'st'    =>  0
		);
		$anchor_info_array = M('anchor')->where($map)->select();
		$uid_array = array();
		if($anchor_info_array){
			$uid_array = array_column($anchor_info_array,'uid');
		}
		$uid_str = implode(',', $uid_array);
		$member_map['uid'] = array('in', $uid_str);
		M('member') -> data($member_step_data) ->  where($member_map) -> save();
	
        if (M('anchor')->where($map)->delete()) {
            M('anchor_type')->where($map)->delete();
            addlog('删除主播anchor_id：' . $uids);
            $this->success('恭喜，删除主播成功！');
        } else {
            $this->error('参数错误！');
        }
    }
	
	/**
	 * description: 主播编辑页面
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/26 15:57
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
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
	        $this->assign('anchor_id', $anchor_id);
	        $this->assign('anchor_type', $anchor_type);
	        $this->assign('anchor_category', $anchor_type_array);
	        
        } else {
            $this->error('参数错误！');
        }
	    
        $charm = C('ANCHOR_CHARM');
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
	
	/**
	 * description: 修改主播信息
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/24 15:22
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
    public function update(){
        $anchor_id  = isset($_POST['anchor_id']) ? intval($_POST['anchor_id']) : 0;
	    if($anchor_id < 1) $this->error('该用户不存在！');
	    if(empty($_POST['serve_type'])) $this->error('请选择主播分类');
        //更新用户名
        $username   = isset($_POST['username']) ? htmlspecialchars($_POST['username'], ENT_QUOTES) : '';
        $anchor_info = M('anchor') -> where("anchor_id=$anchor_id") -> find();
	    M('member')->data(array('username' => $username))->where("uid={$anchor_info['uid']}")->save();
	    addlog('更新用户ID：' . $anchor_info['uid'] .';username：'. $username);
	    
        //更新anchor主播信息表
        $o_s_time   = isset($_POST['order_time_start']) ? $_POST['order_time_start'] : '00:00';
        $o_e_time   = isset($_POST['order_time_end']) ? $_POST['order_time_end'] : '23:30';
        $data['order_time'] = $o_s_time.'-'.$o_e_time;
	    $data['video']      = isset($_POST['video']) ? trim($_POST['video']) : '';
	    $data['audio']      = isset($_POST['audio']) ? trim($_POST['audio']) : '';
	    $data['usercp']     = isset($_POST['usercp']) ? intval($_POST['usercp']) : 0;
	    $data['signature']  = isset($_POST['signature']) ? trim($_POST['signature']) : '';
	    $data['height']     = isset($_POST['height']) ? intval($_POST['height']) : 0;
	    $data['profession'] = isset($_POST['profession']) ? intval($_POST['profession']) : 0;
	    $data['charm']      = isset($_POST['charm']) && !empty($_POST['charm']) ? implode(',',$_POST['charm']) : '';
	    $data['character']  = isset($_POST['character']) ? trim($_POST['character']) : '';
	    $data['hobbies']    = isset($_POST['hobbies']) ? trim($_POST['hobbies']) : '';
	    $data['recommend']  = isset($_POST['recommend']) ? intval($_POST['recommend']) : 0;
	    $data['sort']       = isset($_POST['sort']) ? intval($_POST['sort']) : 0;
	    $data['u']          = time();
	    M('anchor') -> data($data) -> where("anchor_id=$anchor_id") -> save();
	    addlog('修改主播信息ID：' . $anchor_id);
	    
	    //更新主播分类表anchor_type
	    $serve_type_array   = $_POST['serve_type'];
	    $anchor_type_model  = M('anchorType');
	    $anchor_type_old    = $anchor_type_model -> where("anchor_id=$anchor_id") -> select();
	    $anchor_serve_array   = array();
	    if(isset($anchor_type_old) && !empty($anchor_type_old)){
		    $anchor_serve_array   = array_column($anchor_type_old,'serve_id');
	    }
	    
	    //删除表中多余分类
	    if(!empty($anchor_serve_array)){
	    	foreach ($anchor_serve_array as $ks => $vs){
	    		if(!in_array($vs,$serve_type_array)){
	    			//删除
				    $anchor_type_model -> where("anchor_id=$anchor_id and serve_id=$vs") -> delete();
			    }
		    }
	    }
	    
	    //更新分类
	    foreach ($serve_type_array as $key => $val){
	    	if(in_array($val,$anchor_serve_array)){
	    	    //修改
	    	    $anchor_type_model -> data(array('level' => $_POST["level_$val"])) ->  where("anchor_id=$anchor_id and serve_id=$val") ->save();
			    
		    }else{
	    		//新增
			    $anchor_type_data = array(
				    'anchor_id' =>  $anchor_id,
				    'serve_id'  =>  $val,
				    'level'     =>  $_POST["level_$val"]
			    );
			    $anchor_type_model -> data($anchor_type_data) -> add();
		    }
	    }
	    addlog('更新主播分类等级：主播ID' . $anchor_id);
        $this->success('操作成功！');
    }
	
	/**
	 * description: 新增
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/26 15:37
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
    public function add(){
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
