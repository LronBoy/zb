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
	private $wx_obj     = null;
	
	private $appID      = null;
	
	private $appSecret  = null;
	
	private $options;
	
	public $open_id;
	
	public $wxuser;
	/**
	 * description: 构造方法（获取token）
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/27 15:14
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
	public function _initialize(){
		$weChat_config  = C('WE_CHAT');
		
		$this->appID    = $weChat_config['appid'];
		$this->appSecret= $weChat_config['appsecret'];
		
		$this->wx_obj   = new WeChat($weChat_config);
		
		//初始化access_token
		$access_token_array = json_decode(setting('access_token'),true);
		
		if(empty($access_token_array['v']) || (time() - $access_token_array['t']) > 7000){
			
			$access_token = $this->wx_obj -> checkAuth($this->appID, $this->appSecret);
			
			//更新数据库
			M('setting') -> data(array('v' => $access_token, 't' => time())) -> where("k='access_token'") -> save();
		}else{
			
			$access_token = $this->wx_obj -> checkAuth($this->appID, $this->appSecret, $access_token_array['v']);
		}
		
		$this->options = array(
			'token'=>$access_token, //填写你设定的key
			'appid'=>$this->appID, //填写高级调用功能的app id, 请在微信开发模式后台查询
			'appsecret'=>$this->appSecret, //填写高级调用功能的密钥
		);
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
	
	public function wxoAuth(){
		$scope = 'snsapi_base';
		$code = isset($_GET['code'])?$_GET['code']:'';
		$token_time = isset($_SESSION['token_time'])?$_SESSION['token_time']:0;
		if(!$code && isset($_SESSION['open_id']) && isset($_SESSION['user_token']) && $token_time>time()-3600) {
			if (!$this->wxuser) {
				$this->wxuser = $_SESSION['wxuser'];
			}
			$this->open_id = $_SESSION['open_id'];
			return $this->open_id;
		} else {
			$options = array(
				'token'=>$this->options["token"], //填写你设定的key
				'encodingaeskey'=>$this->options["encodingaeskey"], //填写加密用的EncodingAESKey
				'appid'=>$this->options["appid"], //填写高级调用功能的app id
				'appsecret'=>$this->options["appsecret"] //填写高级调用功能的密钥
			);
			
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
				
				if ($userinfo && !empty($userinfo['nickname'])) {
					$this->wxuser = array(
						'open_id'=>$this->open_id,
						'nickname'=>$userinfo['nickname'],
						'sex'=>intval($userinfo['sex']),
						'location'=>$userinfo['province'].'-'.$userinfo['city'],
						'avatar'=>$userinfo['headimgurl']
					);
				} elseif (strstr($json['scope'],'snsapi_userinfo')!==false) {
					$userinfo = $this->wx_obj->getOauthUserinfo($access_token,$this->open_id);
					if ($userinfo && !empty($userinfo['nickname'])) {
						$this->wxuser = array(
							'open_id'=>$this->open_id,
							'nickname'=>$userinfo['nickname'],
							'sex'=>intval($userinfo['sex']),
							'location'=>$userinfo['province'].'-'.$userinfo['city'],
							'avatar'=>$userinfo['headimgurl']
						);
					} else {
						return $this->open_id;
					}
				}
				if ($this->wxuser) {
					$_SESSION['wxuser'] = $this->wxuser;
					$_SESSION['open_id'] =  $json["openid"];
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