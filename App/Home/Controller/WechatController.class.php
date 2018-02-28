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
	
	protected $token          = null; //验证微信token
	protected $appID          = null; //appID
	protected $appSecret      = null; //appSecret
	protected $wx_obj         = null; //微信操作对象
	protected $access_token   = null; //access_token
	
	
	protected $options;   //微信配置信息
	protected $open_id;   //用户open_id
	protected $wxUser;    //用户信息
	
	
	/**
	 * description: 构造方法（获取access_token）
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/27 15:14
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
	public function _initialize(){
		
		//获取微信对象
		$weChat_config          = C('WE_CHAT');
		$this->options          = $weChat_config;
		$this->token            = $weChat_config['token'];
		$this->encodingAesKey   = $weChat_config['encodingaeskey'];
		$this->appID            = $weChat_config['appid'];
		$this->appSecret        = $weChat_config['appsecret'];
		
		unset($weChat_config['encodingaeskey']);
		$this->wx_obj           = new WeChat($weChat_config);
		
		//获取access_token
		$access_token_array = json_decode(setting('access_token'),true);
		if(empty($access_token_array['v']) || (time() - $access_token_array['t']) > 7000){
			$this->access_token = $this->wx_obj -> checkAuth($this->appID, $this->appSecret);
			//更新数据库
			M('setting') -> data(array('v' => $this->access_token, 't' => time())) -> where("k='access_token'") -> save();
		}else{
			$this->access_token = $this->wx_obj -> checkAuth($this->appID, $this->appSecret, $access_token_array['v']);
		}
	}
	
	
	/**
	 * description: 删除菜单
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/27 15:35
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
	public function delMenu(){
		$result = $this->wx_obj -> deleteMenu();
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
					"url"=>"http://www.phpuse.cn/zb/index.php/Home/Wechat/wxoAuth"//要跳转的地址
				),
			),
		);
		$result = $this->wx_obj -> createMenu($data);
		var_dump($result);
	}
	
	
	public function getUserInfo(){
		$this->wxoAuth();
		var_dump($_SESSION);
	}
	
	
	public function wxoAuth(){
		$scope = 'snsapi_base';
		$code = isset($_GET['code']) ? $_GET['code']:'';
		$token_time = isset($_SESSION['token_time'])?$_SESSION['token_time']:0;
		if(!$code && isset($_SESSION['open_id']) && isset($_SESSION['user_token']) && $token_time>time()-3600) {
			if (!$this->wxUser) {
				$this->wxUser = $_SESSION['wxuser'];
			}
			$this->open_id = $_SESSION['open_id'];
			return $this->open_id;
		} else {
			
			if ($code) {
				$json = $this->wx_obj->getOauthAccessToken();
				if (!$json) {
					unset($_SESSION['wx_redirect']);
					die('获取用户授权失败，请重新确认');
				}
				$_SESSION['open_id'] = $this->open_id = $json["openid"];
				$access_token = $json['access_token'];
				$_SESSION['user_token'] = $access_token;
				$_SESSION['token_time'] = time();
				$userinfo = $this->wx_obj->getUserInfo($this->open_id);
				
				if($userinfo && !empty($userinfo['nickname'])){
					$this->wxUser = array(
						'open_id'   =>$this->open_id,
						'nickname'  =>$userinfo['nickname'],
						'sex'       =>intval($userinfo['sex']),
						'location'  =>$userinfo['province'].'-'.$userinfo['city'],
						'province'  =>$userinfo['province'],
						'city'      =>$userinfo['city'],
						'avatar'    =>$userinfo['headimgurl']
					);
				} else if(strstr($json['scope'],'snsapi_userinfo')!==false) {
					$userinfo = $this->wx_obj->getOauthUserinfo($access_token,$this->open_id);
					if ($userinfo && !empty($userinfo['nickname'])) {
						$this->wxuser = array(
							'open_id'   =>$this->open_id,
							'nickname'  =>$userinfo['nickname'],
							'sex'       =>intval($userinfo['sex']),
							'location'  =>$userinfo['province'].'-'.$userinfo['city'],
							'province'  =>$userinfo['province'],
							'city'      =>$userinfo['city'],
							'avatar'    =>$userinfo['headimgurl']
						);
					} else {
						return $this->open_id;
					}
				}
				if ($this->wxuser) {
					$_SESSION['wxuser']     = $this->wxuser;
					$_SESSION['open_id']    =  $json["openid"];
					unset($_SESSION['wx_redirect']);
					return $this->open_id;
				}
				$scope = 'snsapi_userinfo';
			}
			if ($scope=='snsapi_base') {
				$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
				$_SESSION['wx_redirect'] = $url;
			} else {
				$url = $_SESSION['wx_redirect'];
			}
			if (!$url) {
				unset($_SESSION['wx_redirect']);
				die('获取用户授权失败');
			}
			$oauth_url = $this->wx_obj->getOauthRedirect($url,"wxbase",$scope);
			redirect ( $oauth_url );
		}
	}
	
}