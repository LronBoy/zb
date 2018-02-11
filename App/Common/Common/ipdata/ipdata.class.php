<?php
/*---------------------------------------------------------------------------------------
* File: sms.php  for o.com project
* Version: 1.0
* Description: 纯真IP地址底层接口，返回对应IP的城市及具体地址
* CreateTool: PhpStorm
*---------------------------------------------------------------------------------------
* Author:
* Datetime: 2017/5/25 20:29
*---------------------------------------------------------------------------------------
*/

class ipdata{

    static public $obj = null;

    /*
     * 构造函数(私有化单例模式)
     * */
    private function __construct(){

    }

    //程序的入口。在这个入口中实例化
    static public function getObj(){
        //用静态的成员属性只能初始化一次的特性
        //判断静态成员属性是否是初始值
        if(is_null(self::$obj)){
            //如果是初始值就实例化对象。并把对象赋值给静态成员属性
            self::$obj =  new self();
        }
        //把静态成员属性中的对象返回
        return self::$obj;
    }

    /**
     * 获取IP对应的地址信息
     *
     * @author	Jeffry
     * @since	2017-05-27
     *
     * @access	private
     * @param   string  $ip     ip地址
     * @return  array   经过处理后的数据 $this->param()
     */
    public function convertip($ip) {
        if(!preg_match("/^\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}$/", $ip)) {
            $return = false;
        } else {
            $iparray = explode('.', $ip);
            if($iparray[0] == 10 || $iparray[0] == 127 || ($iparray[0] == 192 && $iparray[1] == 168) || ($iparray[0] == 172 && ($iparray[1] >= 16 && $iparray[1] <= 31))) {
                $return = '本地局域网';
            } else if($iparray[0] > 255 || $iparray[1] > 255 || $iparray[2] > 255 || $iparray[3] > 255) {
                $return = false;
            } else {
                if(@is_readable(dirname(__FILE__).'/tiny.dat')) {
                    $return = $this->_convertip_tiny($ip);
                } else if(@file_exists(dirname(__FILE__).'/wry.dat')) {
                    $return = $this->_convertip_full($ip);
                }else{
                    $return = false;
                }
            }
        }

        if($return === false){
            return array();
        }
        //处理编码
        $result = $this->_charsetToUTF8($return);
        //处理数据
        $reTemp = explode(' ', $result);
        $param = array('country' => '', 'province' => '', 'city' => '');
        if(count($reTemp)>1){
            $convertArr = array_combine(array('city', 'area'),$reTemp);
            if(!empty($convertArr['city'])){
                $param = $this->_returnParam($convertArr['city']);
            }
            if(!empty($convertArr['area'])){
                if(empty($param['province']) && empty($param['city'])){
                    $param = $this->_returnParam($convertArr['city'].$convertArr['area']);
                }
            }
        }else{
            $param['country'] = $reTemp[0];
        }

        return $param;
    }


    /**
     * 将非UTF-8字符集的编码转为UTF-8
     * @author	Jeffry
     * @since	2017-05-16
     *
     * @access	private
     * @param   mixed $mixed 源数据
     * @return  mixed utf-8格式数据
     */
    private function _charsetToUTF8($mixed){
        if (is_array($mixed)) {
            foreach ($mixed as $k => $v) {
                if (is_array($v)) {
                    $mixed[$k] = $this->_charsetToUTF8($v);
                } else {
                    $encode = mb_detect_encoding($v, array('ASCII', 'UTF-8', 'GB2312', 'GBK', 'BIG5'));
                    if ($encode == 'EUC-CN') {
                        $mixed[$k] = iconv('GBK', 'UTF-8', $v);
                    }
                }
            }
        } else {
            $encode = mb_detect_encoding($mixed, array('ASCII', 'UTF-8', 'GB2312', 'GBK', 'BIG5'));
            if ($encode == 'EUC-CN') {
                $mixed = iconv('GBK', 'UTF-8', $mixed);
            }
        }
        return $mixed;
    }


    /*
     * IP基库查询
     * @author	Jeffry
     * @since	2017-05-27
     *
     * @access	private
     * @param   string  $ip IP地址
     * @return  array   处理后的数据
     */
    private function _convertip_tiny($ip) {

        static $fp = NULL, $offset = array(), $index = NULL;

        $ipdot = explode('.', $ip);
        $ip    = pack('N', ip2long($ip));

        $ipdot[0] = (int)$ipdot[0];
        $ipdot[1] = (int)$ipdot[1];

        if($fp === NULL && $fp = @fopen(dirname(__FILE__).'/tiny.dat', 'rb')) {
            $offset = unpack('Nlen', fread($fp, 4));
            $index  = fread($fp, $offset['len'] - 4);
        } else if($fp == FALSE) {
            return  false;
        }

        $length = $offset['len'] - 1028;
        $start  = unpack('Vlen', $index[$ipdot[0] * 4] . $index[$ipdot[0] * 4 + 1] . $index[$ipdot[0] * 4 + 2] . $index[$ipdot[0] * 4 + 3]);

        for ($start = $start['len'] * 8 + 1024; $start < $length; $start += 8) {

            if ($index{$start} . $index{$start + 1} . $index{$start + 2} . $index{$start + 3} >= $ip) {
                $index_offset = unpack('Vlen', $index{$start + 4} . $index{$start + 5} . $index{$start + 6} . "\x0");
                $index_length = unpack('Clen', $index{$start + 7});
                break;
            }
        }

        fseek($fp, $offset['len'] + $index_offset['len'] - 1024);
        //查询失败
        if(!$index_length['len']) {
            return false;
        }
        //查询成功
        return fread($fp, $index_length['len']);
    }


    /*
     * 数据处理
     * @author	Jeffry
     * @since	2017-05-27
     *
     * @access	private
     * @param   string  $location 城市信息
     * @return  array   处理后的数据
     */
    private function _returnParam($location){
        $result = array('country' => '', 'province' => '', 'city' => '');
        $country = explode('国', $location);
        if(count($country)>1){
            $result['country'] = $country[0].'国';
            $province = explode('省', $country[1]);
            $state = explode('州', $country[1]);
            if(count($province) > 1){
                $result['province'] = $province[0].'省';
                $city = explode('市', $province[1]);
                if(count($city) > 1){
                    $result['city'] = $city[0].'市';
                }
            }else if(count($state) > 1){
                $result['province'] = $state[0].'州';
                $city = explode('市', $state[1]);
                if(count($city) > 1){
                    $result['city'] = $city[0].'市';
                }
            }
        }else{
            $province = explode('省', $location);
            $state = explode('州', $location);
            if(count($province) > 1){
                $result['province'] = $province[0].'省';
                $city = explode('市', $province[1]);
                if(count($city) > 1){
                    $result['city'] = $city[0].'市';
                }
            }else if(count($state) > 1){
                $result['province'] = $state[0].'州';
                $city = explode('市', $state[1]);
                if(count($city) > 1){
                    $result['city'] = $city[0].'市';
                }
            }else{
                $city = explode('市', $location);
                if(count($city) > 1){
                    $result['city'] = $city[0].'市';
                }else{
                    $result['country'] = $location;
                }
            }
        }
        return $result;
    }


    /*
     * IP详细库查询
     * @author	Jeffry
     * @since	2017-05-27
     *
     * @access	private
     * @param  string $ip IP地址
     * @return  array   处理后的数据
     */
    private function _convertip_full($ip) {
        if(!$fd = @fopen(dirname(__FILE__).'/wry.dat', 'rb')) {
            return false;
        }

        $ip = explode('.', $ip);
        $ipNum = $ip[0] * 16777216 + $ip[1] * 65536 + $ip[2] * 256 + $ip[3];

        if(!($DataBegin = fread($fd, 4)) || !($DataEnd = fread($fd, 4)) ){
            return false;
        }

        @$ipbegin = implode('', unpack('L', $DataBegin));
        if($ipbegin < 0) $ipbegin += pow(2, 32);
        @$ipend = implode('', unpack('L', $DataEnd));
        if($ipend < 0) $ipend += pow(2, 32);
        $ipAllNum = ($ipend - $ipbegin) / 7 + 1;

        $BeginNum = $ip2num = $ip1num = 0;
        $ipAddr1 = $ipAddr2 = '';
        $EndNum = $ipAllNum;

        while($ip1num > $ipNum || $ip2num < $ipNum) {
            $Middle= intval(($EndNum + $BeginNum) / 2);

            fseek($fd, $ipbegin + 7 * $Middle);
            $ipData1 = fread($fd, 4);
            if(strlen($ipData1) < 4) {
                fclose($fd);
                return false;
            }
            $ip1num = implode('', unpack('L', $ipData1));
            if($ip1num < 0) $ip1num += pow(2, 32);

            if($ip1num > $ipNum) {
                $EndNum = $Middle;
                continue;
            }

            $DataSeek = fread($fd, 3);
            if(strlen($DataSeek) < 3) {
                fclose($fd);
                return false;
            }
            $DataSeek = implode('', unpack('L', $DataSeek.chr(0)));
            fseek($fd, $DataSeek);
            $ipData2 = fread($fd, 4);
            if(strlen($ipData2) < 4) {
                fclose($fd);
                return false;
            }
            $ip2num = implode('', unpack('L', $ipData2));
            if($ip2num < 0) $ip2num += pow(2, 32);

            if($ip2num < $ipNum) {
                if($Middle == $BeginNum) {
                    fclose($fd);
                    return false;
                }
                $BeginNum = $Middle;
            }
        }

        $ipFlag = fread($fd, 1);
        if($ipFlag == chr(1)) {
            $ipSeek = fread($fd, 3);
            if(strlen($ipSeek) < 3) {
                fclose($fd);
                return false;
            }
            $ipSeek = implode('', unpack('L', $ipSeek.chr(0)));
            fseek($fd, $ipSeek);
            $ipFlag = fread($fd, 1);
        }

        if($ipFlag == chr(2)) {
            $AddrSeek = fread($fd, 3);
            if(strlen($AddrSeek) < 3) {
                fclose($fd);
                return false;
            }
            $ipFlag = fread($fd, 1);
            if($ipFlag == chr(2)) {
                $AddrSeek2 = fread($fd, 3);
                if(strlen($AddrSeek2) < 3) {
                    fclose($fd);
                    return false;
                }
                $AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0)));
                fseek($fd, $AddrSeek2);
            } else {
                fseek($fd, -1, SEEK_CUR);
            }

            while(($char = fread($fd, 1)) != chr(0))
                $ipAddr2 .= $char;

            $AddrSeek = implode('', unpack('L', $AddrSeek.chr(0)));
            fseek($fd, $AddrSeek);

            while(($char = fread($fd, 1)) != chr(0))
                $ipAddr1 .= $char;
        } else {
            fseek($fd, -1, SEEK_CUR);
            while(($char = fread($fd, 1)) != chr(0))
                $ipAddr1 .= $char;

            $ipFlag = fread($fd, 1);
            if($ipFlag == chr(2)) {
                $AddrSeek2 = fread($fd, 3);
                if(strlen($AddrSeek2) < 3) {
                    fclose($fd);
                    return false;
                }
                $AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0)));
                fseek($fd, $AddrSeek2);
            } else {
                fseek($fd, -1, SEEK_CUR);
            }
            while(($char = fread($fd, 1)) != chr(0))
                $ipAddr2 .= $char;
        }
        fclose($fd);

        if(preg_match('/http/i', $ipAddr2)) {
            $ipAddr2 = '';
        }
        $ipaddr = "$ipAddr1 $ipAddr2";
        $ipaddr = preg_replace('/CZ88\.NET/is', '', $ipaddr);
        $ipaddr = preg_replace('/^\s*/is', '', $ipaddr);
        $ipaddr = preg_replace('/\s*$/is', '', $ipaddr);
        if(preg_match('/http/i', $ipaddr) || $ipaddr == '') {
            return false;
        }

        return $ipaddr;
    }

}
