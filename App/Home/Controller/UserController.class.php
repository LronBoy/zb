<?php
/***********************************************************
 * copyright(C): Shanghai YiDai
 * description:  用户控制器
 * version:      v1.0.0
 * function:     包含方法列表
 *
 * @author:      Pante
 * @datetime:    2018/2/8 10:08
 * @others:      Use the PhpStorm
 *
 * history:      修改记录
 ***********************************************************/
namespace Home\Controller;

/**
 * description: 用户类
 *+-----------------------------------------------
 * @author:     Pante  2018/2/8 10:39
 *+-----------------------------------------------
 * @Class:       UserController
 * @package Home\Controller
 */
class UserController extends AppController
{
	/**
	 * description: 用户中心
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/9 15:59
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
	public function index(){
		$this->assign('meta_title', $this->web_name.'用户中心');
		$this->display();
	}
	
	/**
	 * description: 用户编辑
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/9 15:58
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
	public function edit(){
		$this->assign('meta_title', $this->web_name.'用户编辑');
		$this->display();
	}
	
	/**
	 * description: 账户充值
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/9 16:00
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
	public function account(){
		$this->assign('meta_title', $this->web_name.'账户充值');
		$this->display();
	}
	
	/**
	 * description: 设置中心
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/9 16:15
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
	public function setting(){
		$this->assign('meta_title', $this->web_name.'设置中心');
		$this->display();
	}
	
	/**
	 * description: 申请入驻
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/9 16:25
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
	public function settle(){
		$this->assign('meta_title', $this->web_name.'申请入驻');
		$this->display();
	}
	
}