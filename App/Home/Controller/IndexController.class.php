<?php
/***********************************************************
 * copyright(C): Jeffry<w@jeffry.cn>
 * description:  前台控制器演示。
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

class IndexController extends AppController
{
    public function index(){
	    $prefix = C('DB_PREFIX');
    	//banner获取
	    $banner = M('flash') -> field('id,title,pic') -> order('o asc') -> select();
	    $this->assign('banner', $banner);
	    //获取分类
	    $serve_type_total = M('serveType') ->where("status = 1") -> count();
	    $serve_type_result   = array();
	    if($serve_type_total){
	        $serve_type_page     = ceil($serve_type_total/8);
	        for ($i=0; $i<$serve_type_page; $i++){
		        $serve_type = M('serveType') -> field('serve_type_id,title,icon') ->where("status = 1") -> order('sort asc') ->limit($i*8,8) -> select();
	            $serve_type_result[] = $serve_type;
	        }
	    }else{
	    	$this->error('没有分类');
	    }
	    $this->assign('serve_type', $serve_type_result);
	
	    
	    
	    //获取主播
	    $anchor_type = M('anchorType');
	    $serve_type_all = M('serveType') -> field('serve_type_id,title') -> where('status = 1') -> order('sort asc') -> select();
	    foreach ($serve_type_all as $key => &$val){
		
		    $anchor_list = $anchor_type->field("{$prefix}anchor.*,{$prefix}member.*,{$prefix}anchor_type.serve_id,{$prefix}anchor_type.level")
			    ->join("{$prefix}anchor ON {$prefix}anchor.anchor_id = {$prefix}anchor_type.anchor_id")
			    ->join("{$prefix}member ON {$prefix}member.uid = {$prefix}anchor.uid")
			    ->where("{$prefix}anchor_type.serve_id = {$val['serve_type_id']}")
			    ->limit("3")
			    ->select();
		    $val['anchor_list'] = $anchor_list;
	    }
	    
	    $this->assign('anchor_list', $serve_type_all);
	    
		$this->assign('meta_title', $this->web_name.'首页');
        $this->display();
    }
    /*
    //一些前台DEMO
    //单页
    public function single($aid){

        $aid = intval($aid);
        $article = M('article')->where('aid='.$aid)->find();
        $this->assign('article',$article);
        $this->assign('nav',$aid);
        $this -> display();
    }
    //文章
    public function article($aid){

        $aid = intval($aid);
        $article = M('article')->where('aid='.$aid)->find();
        $sort = M('asort')->field('name,id')->where("id='{$article['sid']}'")->find();
        $this->assign('article',$article);
        $this->assign('sort',$sort);
        $this -> display();
    }

    //列表
    public function articlelist($sid='',$p=1){
        $sid = intval($sid);
        $p = intval($p)>=1?$p:1;
        $sort = M('asort')->field('name,id')->where("id='$sid'")->find();
        if(!$sort) {
            $this -> error('参数错误！');
        }
        $sorts = M('asort')->field('id')->where("id='$sid' or pid='$sid'")->select();
        $sids = array();
        foreach($sorts as $k=>$v){
            $sids[] = $v['id'];
        }
        $sids = implode(',',$sids);

        $m = M('article');
        $pagesize = 2;#每页数量
        $offset = $pagesize*($p-1);//计算记录偏移量
        $count = $m->where("sid in($sids)")->count();
        $list  = $m->field('aid,title,description,thumbnail,t')->where("sid in($sids)")->order("aid desc")->limit($offset.','.$pagesize)->select();
        //echo $m->getlastsql();
        $params = array(
            'total_rows'=>$count, #(必须)
            'method'    =>'html', #(必须)
            'parameter' =>"/list-{$sid}-?.html",  #(必须)
            'now_page'  =>$p,  #(必须)
            'list_rows' =>$pagesize, #(可选) 默认为15
        );
        $page = new Page($params);
        $this->assign('list',$list);
        $this->assign('page',$page->show(1));
        $this->assign('sort',$sort);
        $this->assign('p',$p);
        $this->assign('n',$count);

        $this -> display();
    }
    */
}