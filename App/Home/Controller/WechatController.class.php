<?php
/***********************************************************
 * copyright(C): Shanghai YiDai
 * description:  文件描述
 * version:      v1.0.0
 * function:     包含方法列表
 *
 * @author:      Pante
 * @datetime:    2018/2/27 14:19
 * @others:      Use the PhpStorm
 *
 * history:      修改记录
 ***********************************************************/

namespace Home\Controller;

use Org\WeChat\WeChat;

class WechatController extends AppController{
	
	/**
	 * description: 删除菜单
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/27 15:35
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
	public function delMenu(){
		$wx_obj  = new WeChat($this->options);
		$result = $wx_obj -> deleteMenu();
		var_dump($result);
	}
	
	
	/**
	 * description: 创建菜单 TODO:url正式修改
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/27 15:28
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
	public function addMenu(){
		$data =  	array (
			'button' => array (
				0 => array (
					'type' => 'view',
					'name' => '进入首页',
					"url"=>"http://www.phpuse.cn/zb/index.php/Home/Wechat/getOpenId"//要跳转的地址
				),
			),
		);
		$wx_obj  = new WeChat($this->options);
		$result = $wx_obj -> createMenu($data);
		var_dump($result);
	}
	
	
	public function getOpenId(){
		if(!isset($_SESSION['open_id']) || empty($_SESSION['open_id'])) $this->wxoAuth();
		var_dump($_SESSION['open_id']);
	}
	
	

}