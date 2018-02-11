<?php
/***********************************************************
 * copyright(C): Jeffry<w@jeffry.cn>
 * description:  前台公用控制器
 * version:      v1.0.0
 * function:     包含方法列表
 *
 * @author:      Pante
 * @datetime:    2018/1/31 16:21
 * @others:      Use the PhpStorm
 *
 * history:      修改记录
 ***********************************************************/

namespace Home\Controller;

use Think\Controller;

class AppController extends Controller{
	
	protected $web_config = array();
	protected $web_name = '';
	
    public function _initialize(){
        $config = C(setting());
	    $this -> web_config = $config;
	    $this -> web_name = isset($config['title']) ? $config['title'].'-' : '';
    }
}