<?php
/***********************************************************
 * copyright(C): Jeffry<w@jeffry.cn>
 * description:  模块公共文件
 * version:      v1.0.0
 * function:     包含方法列表
 *
 * @author:      Pante
 * @datetime:    2018/1/31 16:21
 * @others:      Use the PhpStorm
 *
 * history:      修改记录
 ***********************************************************/


/**
 * description: 根据生日中的月份和日期来计算所属星座
 *+-----------------------------------------------
 * @author:     Pante  2018/2/7 16:20
 * @access:     public
 *+-----------------------------------------------
 * @param $birth_month
 * @param $birth_date
 * @return mixed
 * @history:    更改记录
 */
function get_constellation($birth_month,$birth_date){
//判断的时候，为避免出现1和true的疑惑，或是判断语句始终为真的问题，这里统一处理成字符串形式
	$birth_month = strval($birth_month);
	$constellation_name = array('水瓶座','双鱼座','白羊座','金牛座','双子座','巨蟹座', '狮子座','处女座','天秤座','天蝎座)','射手座','摩羯座');
	if ($birth_date <= 22) {
		if ('1' !== $birth_month) {
			$constellation = $constellation_name[$birth_month-2];
		} else {
			$constellation = $constellation_name[11];
		}
	} else {
		$constellation = $constellation_name[$birth_month-1];
	}
	return $constellation;
}

/**
 * description: 根据生日中的年份来计算所属生肖
 *+-----------------------------------------------
 * @author:     Pante  2018/2/7 16:19
 * @access:     public
 *+-----------------------------------------------
 * @param $birth_year
 * @return mixed
 * @history:    更改记录
 */
function get_animal($birth_year){
	//1900年是子鼠年
	$animal = array('子鼠','丑牛','寅虎','卯兔','辰龙','巳蛇', '午马','未羊','申猴','酉鸡','戌狗','亥猪');
	$my_animal = ($birth_year-1900)%12;
	return $animal[$my_animal];
}

/**
 * description: 根据生日来计算年龄
 * 用Unix时间戳计算是最准确的，但不太好处理1970年之前出生的情况
 * 而且还要考虑闰年的问题，所以就暂时放弃这种方式的开发，保留思想
 *+-----------------------------------------------
 * @author:     Pante  2018/2/7 16:19
 * @access:     public
 *+-----------------------------------------------
 * @param $birth_year
 * @param $birth_month
 * @param $birth_date
 * @return false|int|string
 * @history:    更改记录
 */
function get_age($birthday){
	$age = strtotime($birthday);
	if($age === false){
		return false;
	}
	list($y1,$m1,$d1) = explode("-",date("Y-m-d",$age));
	$now = strtotime("now");
	list($y2,$m2,$d2) = explode("-",date("Y-m-d",$now));
	$age = $y2 - $y1;
	if((int)($m2.$d2) < (int)($m1.$d1))
		$age -= 1;
	return $age;
}


/**
 * description: 求两个日期之间相差的天数(针对1970年1月1日之后，求之前可以采用泰勒公式)
 *+-----------------------------------------------
 * @author:     Pante  2018/2/4 13:23
 * @access:     public
 *+-----------------------------------------------
 * @param $day1
 * @param $day2
 * @return float|int
 * @history:    更改记录
 */
function diffBetweenTwoDays($day1, $day2){
	$second1 = strtotime($day1);
	$second2 = strtotime($day2);
	
	if ($second1 < $second2) {
		$tmp = $second2;
		$second2 = $second1;
		$second1 = $tmp;
	}
	return ($second1 - $second2) / 86400;
}

/**
 * description: 中文字符检测
 *+-----------------------------------------------
 * @author:     Pante  2018/2/4 13:23
 * @access:     public
 *+-----------------------------------------------
 * @param $str
 * @return bool
 * @history:    更改记录
 */
function checkChinese($str){
	if (isset($str) && preg_match('/^[\x{4e00}-\x{9fa5}]+$/u',$str)) {
		return true;
	} else {
		return false;
	}
}


/**
 * description: 获取浏览器名称及版本号
 *+-----------------------------------------------
 * @author:     Pante  2018/2/4 13:21
 * @access:     public
 *+-----------------------------------------------
 * @return array|string
 * @history:    更改记录
 */
function getBrowser(){
	if (empty($_SERVER['HTTP_USER_AGENT'])) return '';
	
	$agent  = $_SERVER['HTTP_USER_AGENT'];
	$browser  = '';
	$browser_ver = '';
	if (preg_match('/MSIE\s([^\s|;]+)/i', $agent, $regs)) {
		$browser  = 'Internet Explorer';
		$browser_ver = $regs[1];
	} elseif (preg_match('/FireFox\/([^\s]+)/i', $agent, $regs)) {
		$browser  = 'FireFox';
		$browser_ver = $regs[1];
	} elseif (preg_match('/Chrome\/([^\s]+)/i', $agent, $regs)) {
		$browser  = 'Chrome';
		$browser_ver = $regs[1];
	} elseif (preg_match('/Maxthon/i', $agent, $regs)) {
		$browser  = '(Internet Explorer ' .$browser_ver. ') Maxthon';
		$browser_ver = '';
	} elseif (preg_match('/Opera[\s|\/]([^\s]+)/i', $agent, $regs)) {
		$browser  = 'Opera';
		$browser_ver = $regs[1];
	} elseif (preg_match('/OmniWeb\/(v*)([^\s|;]+)/i', $agent, $regs)) {
		$browser  = 'OmniWeb';
		$browser_ver = $regs[2];
	} elseif (preg_match('/Netscape([\d]*)\/([^\s]+)/i', $agent, $regs)) {
		$browser  = 'Netscape';
		$browser_ver = $regs[2];
	} elseif (preg_match('/safari\/([^\s]+)/i', $agent, $regs)) {
		$browser  = 'Safari';
		$browser_ver = $regs[1];
	} elseif (preg_match('/NetCaptor\s([^\s|;]+)/i', $agent, $regs)) {
		$browser  = '(Internet Explorer ' .$browser_ver. ') NetCaptor';
		$browser_ver = $regs[1];
	} elseif (preg_match('/Lynx\/([^\s]+)/i', $agent, $regs)) {
		$browser  = 'Lynx';
		$browser_ver = $regs[1];
	}
	
	if (!empty($browser)) {
		$data = array(
			'browser'=>$browser,
			'version'=>$browser_ver
		);
		return   $data;
	} else {
		return 'Unknow browser';
	}
}

/**
 * description: 获取Excel文件内容
 *+-----------------------------------------------
 * @author:     Pante  2018/2/4 13:18
 * @access:     public
 *+-----------------------------------------------
 * @param $excelPath    string  Excel文件地址
 * @return mixed
 *  array(
 *      'key值1'  =>  '值1',
 *      'key值2'  =>  '值2',
 *      'key值3'  =>  '值3',
 *      ...
 *  );
 * @history:    更改记录
 */
function getExcelContent($excelPath){
	header("Content-Type:text/html;charset=utf-8");
	//引入类
	include_once __DIR__ . '/phpexcelreader/phpexcelreader.class.php';
	//创建对象
	$data = new Spreadsheet_Excel_Reader();
	//设置文本输出编码
	$data->setOutputEncoding('UTF-8');
	//读取Excel文件
	$data->read($excelPath);
	return $data->sheets[0]['cells'];
}

/**
 * description: 获取IP归属地
 *+-----------------------------------------------
 * @author:     Pante  2018/2/4 13:13
 * @access:     public
 *+-----------------------------------------------
 * @param   string  $ip  需要查询的ip(11.152.162.44)
 * @return  array   失败返回空数组，成功返回
 *  array(
 *      'country'  =>  '美国',//国家
 *      'province' =>  '俄亥俄州'//省份
 *      'city'     =>  '哥伦布市'//城市
 *  );
 * @history:    更改记录
 */
function getIpConvert($ip){
	static $ipdataObj = null;
	if($ipdataObj === null){
		//引入IP操作接口类
		include_once __DIR__.'/ipdata/ipdata.class.php';
		//获取ipdata对象
		$ipdataObj = ipdata::getObj();
	}
	return $ipdataObj->convertip($ip);
}

/**
 * description: 返回数组中部分的key数组
 *+-----------------------------------------------
 * @author:     at  ct
 * @access:     public
 *+-----------------------------------------------
 * @param     array     $array     数据数组
 * @param     array     $keys      需要返回key数组
 * @return array
 * @history:    更改记录
 */
function array_keys_array($array, $keys){
	return array_intersect_key($array, array_fill_keys($keys, 0));
}

/**
 * description: 获取浏览器的Accept(头信息)
 *+-----------------------------------------------
 * @author:     Pante  2018/2/4 13:08
 * @access:     public
 *+-----------------------------------------------
 * @return string
 * @history:    更改记录
 */
function getBrowerHeaders(){
	$str = '';
	if(!function_exists('getallheaders'))
	{
		foreach ($_SERVER as $name => $value) {
			if (substr($name, 0, 5) == 'HTTP_') {
				$str .= $value;
			}
		}
	}else{
		foreach (getallheaders() as $name => $value) {
			$str .= $value;
		}
	}
	
	return $str;
}


/**
 * description: 格式化金钱
 *+-----------------------------------------------
 * @author:     at  ct
 * @access:     public
 *+-----------------------------------------------
 * @param $money
 * @param int $scale
 * @return string
 * @history:    更改记录
 */
function format_money($money, $scale=2){
	return bcadd($money,0,$scale);
}

/**
 * description: 格式化数字
 *+-----------------------------------------------
 * @author:     at  ct
 * @access:     public
 *+-----------------------------------------------
 * @param $num
 * @param int $scale
 * @return string
 * @history:    更改记录
 */
function format_digital($num, $scale=1){
	return bcadd($num,0,$scale);
}


/**
 * description: 隐藏姓名中的名
 *+-----------------------------------------------
 * @author:     Pante  2018/2/4 13:07
 * @access:     public
 *+-----------------------------------------------
 * @param $userName
 * @return string
 * @history:    更改记录
 */
function hiddenName($userName){
	if (empty($userName)) return '无名氏';
	
	$str	  = explode(',', $userName);
	$userName = $str[0];
	$strlen	  = mb_strlen($userName, 'utf-8');
	$return	  = mb_substr($userName, 0, 1, 'utf-8');//截取姓
	
	return $return . '**';
}

/**
 * description: 随机生成字符串
 *+-----------------------------------------------
 * @author:     Pante  2018/2/4 13:06
 * @access:     public
 *+-----------------------------------------------
 * @param $length
 * @return null|string
 * @history:    更改记录
 */
function getRandChar($length){
	$str	= null;
	$strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
	$max	= strlen($strPol)-1;
	for ( $i = 0; $i < $length; $i++ ) {
		$str .= $strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
	}
	
	return $str;
}

/**
 * description: 隐藏电话号码
 *+-----------------------------------------------
 * @author:     Pante  2018/2/4 13:06
 * @access:     public
 *+-----------------------------------------------
 * @param $phone
 * @return mixed|string
 * @history:    更改记录
 */
function hiddenPhone($phone){
	if ($phone && is_numeric($phone) && !strpos($phone, '@')) {
		if ($phone && strlen($phone) > 10) {
			$phone = substr_replace($phone,'******',3,6);
		} else {
			$start = substr($phone,0,5);
			$phone = $start.'***';
		}
	}
	
	return $phone;
}


/**
 * description: 隐藏身份证（生日）
 *+-----------------------------------------------
 * @author:     Pante  2018/2/4 13:05
 * @access:     public
 *+-----------------------------------------------
 * @param $ID
 * @return string
 * @history:    更改记录
 */
function hiddenID($ID){
	if( $ID != '' ) {
		$start = substr($ID,0,2);
		$end   = substr($ID,-2,2);
		$ID = $start.'********'.$end;
	}
	
	return $ID;
}


/**
 * description: 检验是否为手机
 *+-----------------------------------------------
 * @author:     Pante  2018/2/4 13:04
 * @access:     public
 *+-----------------------------------------------
 * @param $str
 * @return int
 * @history:    更改记录
 */
function isMobile($str){
	$mobileMatch = "/^1(4|3|5|8|7)\d{9}$/";
	
	if (preg_match($mobileMatch, $str) ) {
		return 1;
	}
	return 0;
}


/**
 * description: 检验是否为邮箱
 *+-----------------------------------------------
 * @author:     Pante  2018/2/4 13:04
 * @access:     public
 *+-----------------------------------------------
 * @param $str
 * @return int
 * @history:    更改记录
 */
function isEmail($str){
	$mailMatch   = "/^[\w\.\-]+@[\w\.\-]+\.[a-zA-Z]+$/";
	if ( preg_match($mailMatch, $str) ) {
		return 1;
	}
	return 0;
}

/**
 * description: 生成订单号
 *+-----------------------------------------------
 * @author:     Pante  2018/2/4 12:57
 * @access:     public
 *+-----------------------------------------------
 * @param   int     $user_id 	   用户id
 * @param   int     $type 	       分类ID
 * @param   int     $channel       渠道 1微信支付 2支付宝支付
 * @return bool|string
 * @history:    更改记录
 */
function get_order_sn($user_id, $type = 0,  $channel = 1){
	
	if ($channel == 1) {
		$pre_str = 'W';
	}else{
		$pre_str = 'Z';
	}
	if ($user_id <= 0) return false;
	$order_str = $type . date('ymdHis').rand(0,9).sprintf("%09d", $user_id);
	return $pre_str.$order_str;
}


/**
 * description: 身份证格式验证
 *+-----------------------------------------------
 * @author:     Pante  2018/2/4 12:59
 * @access:     public
 *+-----------------------------------------------
 * @param $id
 * @return bool
 * @history:    更改记录
 */
function is_idcard( $id ){
	$id = strtoupper($id);
	$regx = "/(^\d{15}$)|(^\d{17}([0-9]|X)$)/";
	$arr_split = array();
	if(!preg_match($regx, $id))
	{
		return FALSE;
	}
	if(15==strlen($id)) //检查15位
	{
		$regx = "/^(\d{6})+(\d{2})+(\d{2})+(\d{2})+(\d{3})$/";
		
		@preg_match($regx, $id, $arr_split);
		//检查生日日期是否正确
		$dtm_birth = "19".$arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4];
		if(!strtotime($dtm_birth))
		{
			return FALSE;
		} else {
			return TRUE;
		}
	}
	else      //检查18位
	{
		$regx = "/^(\d{6})+(\d{4})+(\d{2})+(\d{2})+(\d{3})([0-9]|X)$/";
		@preg_match($regx, $id, $arr_split);
		$dtm_birth = $arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4];
		if(!strtotime($dtm_birth)) //检查生日日期是否正确
		{
			return FALSE;
		}
		else
		{
			//检验18位身份证的校验码是否正确。
			//校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。
			$arr_int = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
			$arr_ch = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
			$sign = 0;
			for ( $i = 0; $i < 17; $i++ )
			{
				$b = (int) $id{$i};
				$w = $arr_int[$i];
				$sign += $b * $w;
			}
			$n = $sign % 11;
			$val_num = $arr_ch[$n];
			if ($val_num != substr($id,17, 1))
			{
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
	}
}

/**
 * description: 验证银行卡
 *+-----------------------------------------------
 * @author:     Pante  2018/2/4 12:29
 * @access:     public
 *+-----------------------------------------------
 * @param $bankCard
 * @return bool
 * @history:    更改记录
 */
function isBankCard($bankCard){
	
	if(!preg_match('/^(\d{15,21})$/', $bankCard)){
		return false;
	}
	
	$arr_no = str_split($bankCard);
	$last_n = $arr_no[count($arr_no)-1];
	krsort($arr_no);
	$i = 1;
	$total = 0;
	foreach ($arr_no as $n){
		if($i%2==0){
			$ix = $n*2;
			if($ix>=10){
				$nx = 1 + ($ix % 10);
				$total += $nx;
			}else{
				$total += $ix;
			}
		}else{
			$total += $n;
		}
		$i++;
	}
	$total -= $last_n;
	$total *= 9;
	if($last_n == ($total%10)){
		return true;
	}else{
		return false;
	}
}

/**
 * description: 手机运营商验证
 *+-----------------------------------------------
 * @author:     Pante  2018/2/4 12:28
 * @access:     public
 *+-----------------------------------------------
 * @param $phone
 * @return bool|string
 * @history:    更改记录
 */
function phoneOperator($phone){
	$cmcc = array('134', '135', '136', '137', '138', '139', '150', '151', '152', '157', '158', '159', '182', '183', '184', '187', '188', '178', '147');
	$unicom = array('130', '131', '132', '155', '156', '185', '186', '176', '145', '175');
	$telecom = array('133', '153', '180', '181', '189', '177', '173', '149');
	
	if (!is_numeric($phone)) {
		return false;
	}
	
	if (!preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4,\\D]{1}\d{8}$|^17[0,3,5,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $phone)) {
		return false;
	}
	
	$three = substr($phone, 0 , 3);
	
	if (in_array($three, $cmcc)) {
		return 'cmcc';
	}
	
	if (in_array($three, $unicom)) {
		return 'unicom';
	}
	
	if (in_array($three, $telecom)) {
		return 'telecom';
	}
	
	return false;
}

/**
 * description: 图片上传
 *+-----------------------------------------------
 * @author:     Pante  2018/2/4 12:27
 * @access:     public
 *+-----------------------------------------------
 * @param string $callBack
 * @param int $width
 * @param int $height
 * @param string $image
 * @history:    更改记录
 */
function UpImage($callBack = "image", $width = 100, $height = 100, $image = "")
{

    echo '<iframe scrolling="no" frameborder="0" border="0" onload="this.height=this.contentWindow.document.body.scrollHeight;this.width=this.contentWindow.document.body.scrollWidth;" width=' . $width . ' height="' . $height . '"  src="' . U('Upload/uploadpic',
            array('Width' => $width, 'Height' => $height, 'BackCall' => $callBack)) . '"></iframe>
         <input type="hidden" ' . 'value = "' . $image . '"' . 'name="' . $callBack . '" id="' . $callBack . '">';
}

/**
 * description: 图片批量上传
 *+-----------------------------------------------
 * @author:     Pante  2018/2/4 12:28
 * @access:     public
 *+-----------------------------------------------
 * @param string $callBack
 * @param int $width
 * @param int $height
 * @param string $image
 * @history:    更改记录
 */
function BatchImage($callBack = "image", $width = 100, $height = 100, $image = ""){
    
    echo '<iframe scrolling="no" frameborder="0" border="0" width=100% onload="this.height=this.contentWindow.document.body.scrollHeight;" src="' . U('Upload/batchpic',
            array('Width' => $width, 'Height' => $height, 'BackCall' => $callBack)) . '"></iframe>
		<input type="hidden" ' . 'value = "' . $image . '"' . 'name="' . $callBack . '" id="' . $callBack . '">';
}

/**
 * description: 网站配置获取函数
 *+-----------------------------------------------
 * @author:     Pante  2018/2/4 13:25
 * @access:     public
 *+-----------------------------------------------
 * @param  string $k        可选，配置名称
 * @return mixed|string     用户数据
 * @history:    更改记录
 */
function setting($k = 'all'){
    $cache = S($k);
    //如果缓存不为空直接返回
    if (null != $cache) {
        return $cache;
    }
    $data = '';
    $setting = M('setting');
    //判断是否查询全部设置项
    if ($k == 'all') {
        $setting = $setting->field('k,v')->select();
        foreach ($setting as $v) {
            $config[$v['k']] = $v['v'];
        }
        $data = $config;

    } else {
        $result = $setting->where("k='{$k}'")->find();
        $data = $result['v'];

    }
    //建立缓存
    if ($data) {
        S($k, $data);
    }
    return $data;
}


/**
 * description: 格式化字节大小
 *+-----------------------------------------------
 * @author:     at  ct
 * @access:     public
 *+-----------------------------------------------
 * @param  number $size 字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 * @history:    更改记录
 */
function format_bytes($size, $delimiter = '')
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
    for ($i = 0; $size >= 1024 && $i < 5; $i++) {
        $size /= 1024;
    }
    return round($size, 2) . $delimiter . $units[$i];
}


/**
 * description: 加密
 *+-----------------------------------------------
 * @author:     at  ct
 * @access:     public
 *+-----------------------------------------------
 * @param $password     string  密码
 * @return string
 * @history:    更改记录
 */
function password($password){
	return md5('Q' . $password . 'W');
}

/**
 * 随机字符
 * @param number $length 长度
 * @param string $type 类型
 * @param number $convert 转换大小写
 * @return string
 */
function random($length = 6, $type = 'string', $convert = 0)
{
    $config = array(
        'number' => '1234567890',
        'letter' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
        'string' => 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789',
        'all' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
    );

    if (!isset($config[$type])) {
        $type = 'string';
    }
    $string = $config[$type];

    $code = '';
    $strlen = strlen($string) - 1;
    for ($i = 0; $i < $length; $i++) {
        $code .= $string{mt_rand(0, $strlen)};
    }
    if (!empty($convert)) {
        $code = ($convert > 0) ? strtoupper($code) : strtolower($code);
    }
    return $code;
}

//获取所有的子级id
function category_get_sons($sid, &$array = array())
{
    //获取当前sid下的所有子栏目的id
    $categorys = M("category")->where("pid = {$sid}")->select();

    $array = array_merge($array, array($sid));
    foreach ($categorys as $category) {
        category_get_sons($category['id'], $array);
    }
    $data = $array;
    unset($array);
    return $data;

}


/**
 * 获取文章url地址
 * url结构：ttp://wwww.jeffry.cn/分类/子分类/子分类/id.html
 * 使用方法：模板中{:articleUrl(array('aid'=>$val['aid']))}
 *
 *
 * @param $data
 * @return $string
 */
function articleUrl($data)
{
    //如果数组为空直接返回空字符
    if (!$data) {
        return '';
    }
    //如果参数错误直接返回空字符
    if (!isset($data['aid'])) {
        return '';
    }

    $aid = (int)$data['aid'];

    //获取文章信息
    $article = M('article')->where(array('aid' => $aid))->find();
    //获取当前内容所在分类
    $category = M('category')->where(array('id' => $article['sid']))->find();
    //获取当前分类
    $categoryUrl = $category['dir'];
    //遍历获取当前文章所在分类的有上级分类并且组合url
    while ($category['pid'] <> 0) {
        $category = M('category')->where(array('id' => $category['pid']))->find();
        $categoryUrl = $category['dir'] . "/" . $categoryUrl;
        //如果上级分类已经无上级分类则退出
    }

    $categoryUrl = __ROOT__ . "/" . $categoryUrl;
    //组合文章url
    $articleUrl = $categoryUrl . '/' . $aid . ".html";
    return $articleUrl;

}









