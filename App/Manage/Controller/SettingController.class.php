<?php
/***********************************************************
 * copyright(C): Jeffry<w@jeffry.cn>
 * description:  网站设置控制器
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

class SettingController extends ComController
{
    public function setting()
    {

        $vars = M('setting')->where('type=1')->select();
        $this->assign('vars', $vars);

        $this->display();
    }

    public function update()
    {

        $data = $_POST;
        $data['sitename'] = isset($_POST['sitename']) ? strip_tags($_POST['sitename']) : '';
        $data['title'] = isset($_POST['title']) ? strip_tags($_POST['title']) : '';
        $data['keywords'] = isset($_POST['keywords']) ? strip_tags($_POST['keywords']) : '';
        $data['description'] = isset($_POST['description']) ? strip_tags($_POST['description']) : '';
        $data['footer'] = isset($_POST['footer']) ? $_POST['footer'] : '';
        $Model = M('setting');
        foreach ($data as $k => $v) {
            $Model->data(array('v' => $v))->where("k='{$k}'")->save();
        }
        //清除旧的缓存数据
        $cache = \Think\Cache::getInstance();
        $cache->clear();
        addlog('修改网站配置。');
        $this->success('恭喜，网站配置成功！');
    }
}