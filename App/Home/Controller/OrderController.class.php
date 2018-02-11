<?php
/***********************************************************
 * copyright(C): Shanghai YiDai
 * description:  订单控制器
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
 * description: 订单类
 *+-----------------------------------------------
 * @author:     Pante  2018/2/8 10:09
 *+-----------------------------------------------
 * @Class:       OrderController
 * @package Home\Controller
 */
class OrderController extends AppController{
	public function index(){
		$this->assign('meta_title', $this->web_name.'订单');
		$this->display();
	}
}