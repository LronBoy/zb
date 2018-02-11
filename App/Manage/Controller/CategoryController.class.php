<?php
/***********************************************************
 * copyright(C): Jeffry<w@jeffry.cn>
 * description:  文章控制器
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

use Vendor\Tree;

class CategoryController extends ComController
{

    public function index(){
        $category = M('ServeType')->field('serve_type_id id,pid,title name,sort o')->order('sort asc')->select();
        $category = $this->getMenu($category);
        $this->assign('category', $category);
        $this->display();
    }

    public function del()
    {

        $id = isset($_GET['id']) ? intval($_GET['id']) : false;
        if ($id) {
            $data['id'] = $id;
            $category = M('ServeType');
            if ($category->where('pid=' . $id)->count()) {
                die('2');//存在子类，严禁删除。
            } else {
                $category->where('serve_type_id=' . $id)->delete();
                addlog('删除分类，ID：' . $id);
            }
            die('1');
        } else {
            die('0');
        }

    }

    public function edit()
    {

        $id = isset($_GET['id']) ? intval($_GET['id']) : false;
        $currentcategory = M('ServeType')->field('serve_type_id id,title name,icon image,sort o,way type,t,u')->where('serve_type_id=' . $id)->find();
        $this->assign('currentcategory', $currentcategory);

        $category = M('ServeType')->field('serve_type_id id,pid,title name')->where("serve_type_id <> {$id}")->order('sort asc')->select();
        $tree = new Tree($category);
        $str = "<option value=\$id \$selected>\$spacer\$name</option>"; //生成的形式
        $category = $tree->get_tree(0, $str, $currentcategory['pid']);

        $this->assign('category', $category);
        $this->display('form');
    }

    public function add()
    {

        $pid = isset($_GET['pid']) ? intval($_GET['pid']) : 0;
        $category = M('ServeType')->field('serve_type_id id,pid,title name')->order('sort asc')->select();
        $tree = new Tree($category);
        $str = "<option value=\$id \$selected>\$spacer\$name</option>"; //生成的形式
        $category = $tree->get_tree(0, $str, $pid);
        
        $this->assign('category', $category);
        $this->display('form');
    }

    public function update($act = null)
    {
        if ($act == 'order') {
            $id = I('post.id', 0, 'intval');
            if (!$id) {
                die('0');
            }
            $o = I('post.o', 0, 'intval');
            M('ServeType')->data(array('sort' => $o))->where("serve_type_id='{$id}'")->save();
            addlog('分类修改排序，ID：' . $id);
            die('1');
        }

        $id = I('post.id', false, 'intval');
        $data['title'] = I('post.name');
        $data['icon'] = I('post.image');
        $data['sort'] = I('post.o');
        $data['way'] = I('post.type');

        if ($data['title'] == '') {
            $this->error('分类名称不能为空！');
        }
        if ($id) {
            $data['u'] = time();
            if (M('ServeType')->data($data)->where('serve_type_id=' . $id)->save()) {
                addlog('服务分类修改，ID：' . $id . '，名称：' . $data['title']);
                $this->success('恭喜，分类修改成功！');
                die(0);
            }
        } else {
            $data['t'] = time();
            $id = M('ServeType')->data($data)->add();
            if ($id) {
                addlog('新增分类，ID：' . $id . '，名称：' . $data['name']);
                $this->success('恭喜，新增分类成功！', 'index');
                die(0);
            }
        }
        $this->success('恭喜，操作成功！');
    }
}
