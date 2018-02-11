<?php
/***********************************************************
 * copyright(C): Jeffry<w@jeffry.cn>
 * description:  数据库配置文件
 * version:      v1.0.0
 * function:     包含方法列表
 *
 * @author:      Pante
 * @datetime:    2018/1/31 16:34
 * @others:      Use the PhpStorm
 *
 * history:      修改记录
 ***********************************************************/
return array(
    'DB_TYPE'   => 'mysql',         // 数据库类型
    'DB_HOST'   => 'localhost',     // 服务器地址
    'DB_NAME'   => 'anchor',        // 数据库名
    'DB_USER'   => 'root',          // 用户名
    'DB_PWD'    => 'root',          // 密码
    'DB_PORT'   => 3306,            // 端口
    'DB_PREFIX' => 'zb_',           // 数据库表前缀
    'DB_CHARSET'=>  'utf8',         // 数据库编码默认采用utf8
);