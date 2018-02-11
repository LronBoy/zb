<?php
/***********************************************************
 * copyright(C): Jeffry<w@jeffry.cn>
 * description:  管理后台模块公共控制器，用于储存公共数据。
 * version:      v1.0.0
 * function:     包含方法列表
 *
 * @author:      Pante
 * @datetime:    2018/1/31 16:21
 * @others:      Use the PhpStorm
 *
 * history:      修改记录
 ***********************************************************/
namespace Common\Controller;

use Think\Controller;

class BaseController extends Controller
{
    public function _initialize()
    {
        C(setting());
    }
}