<?php
/***********************************************************
 * copyright(C): Jeffry<w@jeffry.cn>
 * description:  焦点图
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

class FlashController extends ComController
{

    //flash焦点图
    public function index()
    {

        $list = M('flash')->order('o asc')->select();
        $this->assign('list', $list);
        $this->display();
    }

    //新增焦点图
    public function add()
    {

        $this->display('form');
    }

    //修改焦点图
    public function edit($id = null)
    {

        $id = intval($id);
        $flash = M('flash')->where('id=' . $id)->find();
        $this->assign('flash', $flash);
        $this->display('form');
    }

    //删除焦点图
    public function del()
    {

        $ids = isset($_REQUEST['ids']) ? $_REQUEST['ids'] : false;
        if ($ids) {
            if (is_array($ids)) {
                $ids = implode(',', $ids);
                $map['id'] = array('in', $ids);
            } else {
                $map = 'id=' . $ids;
            }
            if (M('flash')->where($map)->delete()) {
                addlog('删除焦点图，ID：' . $ids);
                $this->success('恭喜，删除成功！');
            } else {
                $this->error('参数错误！');
            }
        } else {
            $this->error('参数错误！');
        }
    }

    //保存焦点图
    public function update($id = 0)
    {
        $id = intval($id);
        $data['title'] = I('post.title', '', 'strip_tags');
        if (!$data['title']) {
            $this->error('请填写标题！');
        }
        $data['url'] = I('post.url', '', 'strip_tags');
        $data['o'] = I('post.o', '', 'strip_tags');
        $data['pic'] = I('post.pic', '', 'strip_tags');
        if ($data['pic'] == '') {
            $this->error('请上传图片！');
        }
        if ($id) {
            M('flash')->data($data)->where('id=' . $id)->save();
            addlog('修改焦点图，ID：' . $id);
        } else {
            M('flash')->data($data)->add();
            addlog('新增焦点图');
        }

        $this->success('恭喜，操作成功！', U('index'));
    }
}