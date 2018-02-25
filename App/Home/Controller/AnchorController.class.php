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
		if(I('anchor_id') < 1 ) $this->error('该主播不存在！');
		$anchor_id = intval(I('anchor_id'));
		$prefix = C('DB_PREFIX');
		$anchor_model   = M('anchor');
		$anchor_info    = $anchor_model -> field("{$prefix}anchor.*,{$prefix}member.*")
			->join("{$prefix}member ON {$prefix}member.uid = {$prefix}anchor.uid")
			->where("{$prefix}anchor.anchor_id=$anchor_id and {$prefix}member.status=1")
			->find();
		
		if(!$anchor_info) $this->error('该主播不存在！');
		$anchor_info['last_time'] = format_date($anchor_info['lt']);

		$profession_array = C('ANCHOR_PROFESSION');
        $anchor_info['profession_str'] = $profession_array[$anchor_info['profession']];

        $charm_str = '无';
        if(isset($anchor_info['charm']) && !empty($anchor_info['charm'])){
            $charm_config = C('ANCHOR_CHARM');
            $charm_array = explode(',',$anchor_info['charm']);
            if($charm_array != 0){
                $charm_str = '';
                foreach ($charm_array as $val){
                    $charm_str = $charm_str.$charm_config[$val].' ';
                }
            }

        }

        $anchor_info['charm_str'] = $charm_str;

		$this->assign('anchor_info', $anchor_info);
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