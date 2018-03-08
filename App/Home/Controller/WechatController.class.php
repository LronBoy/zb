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
	
	protected   $options;              //微信配置信
	public      $open_id;
	public      $wx_user;
	
	/**
	 * description: 构造方法（获取access_token）
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/27 15:14
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
	public function _initialize(){
		//获取微信配置
		$this->options = C('WE_CHAT');
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
		$wx_obj  = new WeChat($this->option);
		$result = $wx_obj -> deleteMenu();
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
		$wx_obj  = new WeChat($this->option);
		$result = $wx_obj -> createMenu($data);
		var_dump($result);
	}
	
	
	public function getOpenId(){
		echo $this->wxoAuth();
	}
	
	public function wxoAuth(){
		//-----------------------------------------------一、初始化授权作用域----------------------------------------------
		$scope = 'snsapi_base';
		
		//code作为换取access_token的票据，每次用户授权带上的code将不一样，code只能使用一次，5分钟未被使用自动过期。
		$code = isset($_GET['code']) ? $_GET['code'] : '';
		
		//获取用户授权access_token，授权时间，授权后有效时间为7200秒
		//（如超时可用https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=APPID&grant_type=refresh_token&refresh_token=REFRESH_TOKEN）刷新access_token
		$token_time = isset($_SESSION['token_time']) ? $_SESSION['token_time'] : 0;
		
		//判断是否有code(有code代表未授权)，检测是否存在open_id,user_token(用户授权access_token)如果存在并且access_token有效期内
		if(!$code && isset($_SESSION['open_id']) && isset($_SESSION['user_token']) && $token_time>time()-3600) {
			if (!$this->wx_user) {                                      //如果用户信息不存在则
				$this->wxuser = $_SESSION['wx_user'];
			}
			$this->open_id = $_SESSION['open_id'];
			return $this->open_id;                                      //返回open_id
		//授权开始
		} else {
			//初始化WeChat对象
			$options = array(
				'token'=>$this->options["token"],                       //填写你设定的key
				'encodingaeskey'=>$this->options["encodingaeskey"],     //填写加密用的EncodingAESKey
				'appid'=>$this->options["appid"],                       //填写高级调用功能的app id
				'appsecret'=>$this->options["appsecret"]                //填写高级调用功能的密钥
			);
			$we_obj = new WeChat($options);
			
			//-------------------------------------------四、通过code获取授权信息------------------------------------------
			if ($code) {
				$json = $we_obj->getOauthAccessToken();                 //获取access_token、expires_in、refresh_token、open_id、scope
				if (!$json) {
					unset($_SESSION['wx_redirect']);
					die('获取用户授权失败，请重新确认');
				}
				$_SESSION['open_id'] = $this->open_id = $json["openid"];//session赋值open_id
				$access_token = $json['access_token'];
				$_SESSION['user_token'] = $access_token;                //session赋值access_token
				$_SESSION['token_time'] = time();                       //session赋值用户授权access_token获取时间
				$userinfo = $we_obj->getUserInfo($this->open_id);       //通过open_id、用户授权access_token获取关注用户资料
				if ($userinfo && !empty($userinfo['nickname'])) {       //赋值用户信息
					$this->wxuser = array(
						'open_id'=>$this->open_id,
						'nickname'=>$userinfo['nickname'],
						'sex'=>intval($userinfo['sex']),
						'location'=>$userinfo['province'].'-'.$userinfo['city'],
						'avatar'=>$userinfo['headimgurl']
					);
				} elseif (strstr($json['scope'],'snsapi_userinfo')!==false) {
					$userinfo = $we_obj->getOauthUserinfo($access_token,$this->open_id);//通过open_id、用户授权access_token获取授权后的用户资料
					if ($userinfo && !empty($userinfo['nickname'])) {   //赋值用户信息
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
				if ($this->wx_user) {
					$_SESSION['wx_user'] = $this->wx_user;
					$_SESSION['open_id'] =  $json["openid"];
					unset($_SESSION['wx_redirect']);
					return $this->open_id;
				}
				$scope = 'snsapi_userinfo';
			}
			
			//二、----------------------------获取当前请求url地址------------------------------
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
			
			//三、----------------------------获取code并返回url+code---------------------------
			//授权跳转接口(code获取)
			$oauth_url = $we_obj->getOauthRedirect($url,"wxbase",$scope);
			//请求授权链接
			//https://open.weixin.qq.com/connect/oauth2/authorize?appid=APPID&redirect_uri=REDIRECT_URI&response_type=code&scope=SCOPE&state=STATE#wechat_redirect
			//http://www.phpuse.cn/?code=021Ktxc62QactJ0IRKb62Vhqc62KtxcK&state=123 该页面（重新执行该方法）
			redirect ( $oauth_url );
		}
	}
}