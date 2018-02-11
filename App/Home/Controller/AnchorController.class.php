<?php
/***********************************************************
 * copyright(C): Shanghai YiDai
 * description:  文件描述
 * version:      v1.0.0
 * function:     包含方法列表
 *
 * @author:      Pante
 * @datetime:    2018/2/9 9:33
 * @others:      Use the PhpStorm
 *
 * history:      修改记录
 ***********************************************************/

namespace Home\Controller;

class AnchorController extends AppController{
	/**
	 * description: 方法描述
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/11 13:25
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
	public function index(){
		$this->assign('meta_title', $this->web_name.'主播');
		$this->display();
	}
	
	/**
	 * description: 方法描述
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/11 13:25
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
	public function searchAnchor(){
		$this->assign('meta_title', $this->web_name.'搜索');
		//渲染模板
		$this->display();
	}
}