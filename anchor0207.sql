/*
Navicat MySQL Data Transfer

Source Server         : DB
Source Server Version : 50720
Source Host           : localhost:3306
Source Database       : anchor

Target Server Type    : MYSQL
Target Server Version : 50720
File Encoding         : 65001

Date: 2018-02-07 20:15:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for zb_anchor
-- ----------------------------
DROP TABLE IF EXISTS `zb_anchor`;
CREATE TABLE `zb_anchor` (
  `anchor_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主播ID',
  `uid` int(11) unsigned NOT NULL COMMENT '用户ID',
  `order_time` varchar(128) DEFAULT '00:00-24:00' COMMENT '接单时间',
  `video` varchar(255) DEFAULT '' COMMENT '视频展示',
  `usercp` varchar(16) DEFAULT '0' COMMENT '魅力值',
  `signature` varchar(255) DEFAULT NULL COMMENT '签名',
  `height` int(3) unsigned DEFAULT NULL COMMENT '身高单位CM',
  `profession` varchar(128) DEFAULT NULL COMMENT '职业',
  `charm` varchar(128) DEFAULT NULL COMMENT '魅力部位',
  `character` varchar(128) DEFAULT NULL COMMENT '个性标签',
  `hobbies` varchar(128) DEFAULT NULL COMMENT '兴趣爱好',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `t` int(11) unsigned NOT NULL COMMENT '创建时间',
  `u` int(11) unsigned DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`anchor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='主播基础表';

-- ----------------------------
-- Records of zb_anchor
-- ----------------------------
INSERT INTO `zb_anchor` VALUES ('1', '3', '00:00-24:00', '', '0', null, null, null, null, null, null, null, '1517974300', '1517974300');
INSERT INTO `zb_anchor` VALUES ('2', '2', '00:00-24:00', '', '0', null, null, null, null, null, null, null, '1517981421', '1517981421');

-- ----------------------------
-- Table structure for zb_anchor_type
-- ----------------------------
DROP TABLE IF EXISTS `zb_anchor_type`;
CREATE TABLE `zb_anchor_type` (
  `anchor_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `serve_id` int(11) unsigned NOT NULL COMMENT '服务ID'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='主播类型映射表';

-- ----------------------------
-- Records of zb_anchor_type
-- ----------------------------

-- ----------------------------
-- Table structure for zb_article
-- ----------------------------
DROP TABLE IF EXISTS `zb_article`;
CREATE TABLE `zb_article` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL COMMENT '分类id',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `seotitle` varchar(255) DEFAULT NULL COMMENT 'SEO标题',
  `keywords` varchar(255) NOT NULL COMMENT '关键词',
  `description` varchar(255) NOT NULL COMMENT '摘要',
  `thumbnail` varchar(255) NOT NULL COMMENT '缩略图',
  `content` text NOT NULL COMMENT '内容',
  `t` int(10) unsigned NOT NULL COMMENT '时间',
  `n` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击',
  PRIMARY KEY (`aid`),
  KEY `sid` (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zb_article
-- ----------------------------

-- ----------------------------
-- Table structure for zb_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `zb_auth_group`;
CREATE TABLE `zb_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zb_auth_group
-- ----------------------------
INSERT INTO `zb_auth_group` VALUES ('1', '超级管理员', '1', '1,2,58,65,59,60,61,62,3,56,4,6,5,7,8,9,10,51,52,53,57,11,54,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,29,30,31,32,33,34,36,37,38,39,40,41,42,43,44,45,46,47,63,48,49,50,55');
INSERT INTO `zb_auth_group` VALUES ('2', '主播', '1', '1,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,29,30,31,32,33,34,36');
INSERT INTO `zb_auth_group` VALUES ('3', '普通用户', '1', '1');

-- ----------------------------
-- Table structure for zb_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `zb_auth_group_access`;
CREATE TABLE `zb_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zb_auth_group_access
-- ----------------------------
INSERT INTO `zb_auth_group_access` VALUES ('1', '1');
INSERT INTO `zb_auth_group_access` VALUES ('2', '3');
INSERT INTO `zb_auth_group_access` VALUES ('3', '3');
INSERT INTO `zb_auth_group_access` VALUES ('4', '3');

-- ----------------------------
-- Table structure for zb_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `zb_auth_rule`;
CREATE TABLE `zb_auth_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `icon` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  `islink` tinyint(1) NOT NULL DEFAULT '1',
  `o` int(11) NOT NULL COMMENT '排序',
  `tips` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zb_auth_rule
-- ----------------------------
INSERT INTO `zb_auth_rule` VALUES ('1', '0', 'Index/index', '控制台', 'menu-icon fa fa-tachometer', '1', '1', '', '1', '1', '友情提示：经常查看操作日志，发现异常以便及时追查原因。');
INSERT INTO `zb_auth_rule` VALUES ('2', '0', '', '系统设置', 'menu-icon fa fa-cog', '1', '1', '', '1', '2', '');
INSERT INTO `zb_auth_rule` VALUES ('3', '2', 'Setting/setting', '网站设置', 'menu-icon fa fa-caret-right', '1', '1', '', '1', '2', '这是网站设置的提示。');
INSERT INTO `zb_auth_rule` VALUES ('4', '2', 'Menu/index', '后台菜单', 'menu-icon fa fa-caret-right', '1', '1', '', '1', '3', '');
INSERT INTO `zb_auth_rule` VALUES ('5', '2', 'Menu/add', '新增菜单', 'menu-icon fa fa-caret-right', '1', '1', '', '1', '4', '');
INSERT INTO `zb_auth_rule` VALUES ('6', '4', 'Menu/edit', '编辑菜单', '', '1', '1', '', '0', '6', '');
INSERT INTO `zb_auth_rule` VALUES ('7', '2', 'Menu/update', '保存菜单', 'menu-icon fa fa-caret-right', '1', '1', '', '0', '5', '');
INSERT INTO `zb_auth_rule` VALUES ('8', '2', 'Menu/del', '删除菜单', 'menu-icon fa fa-caret-right', '1', '1', '', '0', '6', '');
INSERT INTO `zb_auth_rule` VALUES ('9', '2', 'Database/backup', '数据库备份', 'menu-icon fa fa-caret-right', '1', '1', '', '1', '7', '');
INSERT INTO `zb_auth_rule` VALUES ('10', '9', 'Database/recovery', '数据库还原', '', '1', '1', '', '0', '10', '');
INSERT INTO `zb_auth_rule` VALUES ('13', '0', '', '用户管理', 'menu-icon fa fa-users', '1', '1', '', '1', '4', '');
INSERT INTO `zb_auth_rule` VALUES ('14', '13', 'Member/index', '用户管理', 'menu-icon fa fa-caret-right', '1', '1', '', '1', '14', '');
INSERT INTO `zb_auth_rule` VALUES ('15', '13', 'Member/add', '新增用户', 'menu-icon fa fa-caret-right', '1', '1', '', '1', '15', '');
INSERT INTO `zb_auth_rule` VALUES ('16', '13', 'Member/edit', '编辑用户', 'menu-icon fa fa-caret-right', '1', '1', '', '0', '16', '');
INSERT INTO `zb_auth_rule` VALUES ('17', '13', 'Member/update', '保存用户', 'menu-icon fa fa-caret-right', '1', '1', '', '0', '17', '');
INSERT INTO `zb_auth_rule` VALUES ('18', '13', 'Member/del', '删除用户', '', '1', '1', '', '0', '18', '');
INSERT INTO `zb_auth_rule` VALUES ('19', '13', 'Group/index', '用户组管理', 'menu-icon fa fa-caret-right', '1', '1', '', '1', '19', '');
INSERT INTO `zb_auth_rule` VALUES ('20', '13', 'Group/add', '新增用户组', 'menu-icon fa fa-caret-right', '1', '1', '', '1', '20', '');
INSERT INTO `zb_auth_rule` VALUES ('21', '13', 'Group/edit', '编辑用户组', 'menu-icon fa fa-caret-right', '1', '1', '', '0', '21', '');
INSERT INTO `zb_auth_rule` VALUES ('22', '13', 'Group/update', '保存用户组', 'menu-icon fa fa-caret-right', '1', '1', '', '0', '22', '');
INSERT INTO `zb_auth_rule` VALUES ('23', '13', 'Group/del', '删除用户组', '', '1', '1', '', '0', '23', '');
INSERT INTO `zb_auth_rule` VALUES ('24', '0', '', '网站内容', 'menu-icon fa fa-desktop', '1', '1', '', '1', '24', '');
INSERT INTO `zb_auth_rule` VALUES ('25', '24', 'Serve/index', '主播服务管理', 'menu-icon fa fa-caret-right', '1', '1', '', '1', '25', '网站虽然重要，身体更重要，出去走走吧。');
INSERT INTO `zb_auth_rule` VALUES ('26', '24', 'Serve/add', '新增主播服务', 'menu-icon fa fa-caret-right', '1', '1', '', '1', '26', '');
INSERT INTO `zb_auth_rule` VALUES ('27', '24', 'Serve/edit', '编辑主播服务', 'menu-icon fa fa-caret-right', '1', '1', '', '0', '27', '');
INSERT INTO `zb_auth_rule` VALUES ('29', '24', 'Serve/update', '保存主播服务', 'menu-icon fa fa-caret-right', '1', '1', '', '0', '29', '');
INSERT INTO `zb_auth_rule` VALUES ('30', '24', 'Serve/del', '删除主播服务', '', '1', '1', '', '0', '30', '');
INSERT INTO `zb_auth_rule` VALUES ('31', '24', 'Category/index', '主播分类管理', 'menu-icon fa fa-caret-right', '1', '1', '', '1', '31', '');
INSERT INTO `zb_auth_rule` VALUES ('32', '24', 'Category/add', '新增主播分类', 'menu-icon fa fa-caret-right', '1', '1', '', '1', '32', '');
INSERT INTO `zb_auth_rule` VALUES ('33', '24', 'Category/edit', '编辑主播分类', 'menu-icon fa fa-caret-right', '1', '1', '', '0', '33', '');
INSERT INTO `zb_auth_rule` VALUES ('34', '24', 'Category/update', '保存主播分类', 'menu-icon fa fa-caret-right', '1', '1', '', '0', '34', '');
INSERT INTO `zb_auth_rule` VALUES ('36', '24', 'Category/del', '删除主播分类', '', '1', '1', '', '0', '36', '');
INSERT INTO `zb_auth_rule` VALUES ('37', '0', '', '其它功能', 'menu-icon fa fa-legal', '1', '1', '', '1', '37', '');
INSERT INTO `zb_auth_rule` VALUES ('38', '37', 'Link/index', '友情链接', 'menu-icon fa fa-caret-right', '1', '1', '', '1', '38', '');
INSERT INTO `zb_auth_rule` VALUES ('39', '37', 'Link/add', '增加链接', '', '1', '1', '', '1', '39', '');
INSERT INTO `zb_auth_rule` VALUES ('40', '37', 'Link/edit', '编辑链接', '', '1', '1', '', '0', '40', '');
INSERT INTO `zb_auth_rule` VALUES ('41', '37', 'Link/update', '保存链接', '', '1', '1', '', '0', '41', '');
INSERT INTO `zb_auth_rule` VALUES ('42', '37', 'Link/del', '删除链接', '', '1', '1', '', '0', '42', '');
INSERT INTO `zb_auth_rule` VALUES ('43', '37', 'Flash/index', '焦点图', 'menu-icon fa fa-desktop', '1', '1', '', '1', '43', '');
INSERT INTO `zb_auth_rule` VALUES ('44', '37', 'Flash/add', '新增焦点图', '', '1', '1', '', '1', '44', '');
INSERT INTO `zb_auth_rule` VALUES ('45', '37', 'Flash/update', '保存焦点图', '', '1', '1', '', '0', '45', '');
INSERT INTO `zb_auth_rule` VALUES ('46', '37', 'Flash/edit', '编辑焦点图', '', '1', '1', '', '0', '46', '');
INSERT INTO `zb_auth_rule` VALUES ('47', '37', 'Flash/del', '删除焦点图', '', '1', '1', '', '0', '47', '');
INSERT INTO `zb_auth_rule` VALUES ('48', '0', 'Personal/index', '个人中心', 'menu-icon fa fa-user', '1', '1', '', '1', '48', '');
INSERT INTO `zb_auth_rule` VALUES ('49', '48', 'Personal/profile', '个人资料', 'menu-icon fa fa-user', '1', '1', '', '1', '49', '');
INSERT INTO `zb_auth_rule` VALUES ('50', '48', 'Logout/index', '退出', '', '1', '1', '', '1', '50', '');
INSERT INTO `zb_auth_rule` VALUES ('51', '9', 'Database/export', '备份', '', '1', '1', '', '0', '51', '');
INSERT INTO `zb_auth_rule` VALUES ('52', '9', 'Database/optimize', '数据优化', '', '1', '1', '', '0', '52', '');
INSERT INTO `zb_auth_rule` VALUES ('53', '9', 'Database/repair', '修复表', '', '1', '1', '', '0', '53', '');
INSERT INTO `zb_auth_rule` VALUES ('54', '11', 'Update/updating', '升级安装', '', '1', '1', '', '0', '54', '');
INSERT INTO `zb_auth_rule` VALUES ('55', '48', 'Personal/update', '资料保存', '', '1', '1', '', '0', '55', '');
INSERT INTO `zb_auth_rule` VALUES ('56', '3', 'Setting/update', '设置保存', '', '1', '1', '', '0', '56', '');
INSERT INTO `zb_auth_rule` VALUES ('57', '9', 'Database/del', '备份删除', '', '1', '1', '', '0', '57', '');
INSERT INTO `zb_auth_rule` VALUES ('58', '2', 'variable/index', '自定义变量', 'menu-icon fa fa-caret-right', '1', '1', '', '1', '1', '');
INSERT INTO `zb_auth_rule` VALUES ('59', '58', 'variable/add', '新增变量', '', '1', '1', '', '0', '0', '');
INSERT INTO `zb_auth_rule` VALUES ('60', '58', 'variable/edit', '编辑变量', '', '1', '1', '', '0', '0', '');
INSERT INTO `zb_auth_rule` VALUES ('61', '58', 'variable/update', '保存变量', '', '1', '1', '', '0', '0', '');
INSERT INTO `zb_auth_rule` VALUES ('62', '58', 'variable/del', '删除变量', '', '1', '1', '', '0', '0', '');
INSERT INTO `zb_auth_rule` VALUES ('66', '73', 'Anchor/index', '主播管理', 'menu-icon fa fa-caret-right', '1', '1', '', '1', '1', '');
INSERT INTO `zb_auth_rule` VALUES ('67', '73', 'Anchor/check', '主播审核', 'menu-icon fa fa-caret-right', '1', '1', '', '1', '2', '');
INSERT INTO `zb_auth_rule` VALUES ('73', '0', '', '主播管理', 'menu-icon fa fa-heart', '1', '1', '', '1', '3', '');
INSERT INTO `zb_auth_rule` VALUES ('69', '73', 'Anchor/edit', '编辑主播', 'menu-icon fa fa-caret-right', '1', '1', '', '0', '3', '');
INSERT INTO `zb_auth_rule` VALUES ('70', '73', 'Anchor/update', '保存主播', 'menu-icon fa fa-caret-right', '1', '1', '', '0', '4', '');
INSERT INTO `zb_auth_rule` VALUES ('71', '73', 'Anchor/del', '删除主播', 'menu-icon fa fa-caret-right', '1', '1', '', '0', '5', '');
INSERT INTO `zb_auth_rule` VALUES ('72', '73', 'Anchor/checkUpdate', '保存审核', 'menu-icon fa fa-caret-right', '1', '1', '', '0', '7', '');

-- ----------------------------
-- Table structure for zb_comment
-- ----------------------------
DROP TABLE IF EXISTS `zb_comment`;
CREATE TABLE `zb_comment` (
  `comment_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键自增',
  `uid` int(11) unsigned NOT NULL COMMENT '用户ID',
  `content` text NOT NULL COMMENT '评论内容',
  `grade` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '评星默认0星，1星，2星，3星，4星，5星',
  `t` int(11) unsigned NOT NULL COMMENT '创建时间',
  `u` int(11) unsigned DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论表';

-- ----------------------------
-- Records of zb_comment
-- ----------------------------

-- ----------------------------
-- Table structure for zb_dynamic
-- ----------------------------
DROP TABLE IF EXISTS `zb_dynamic`;
CREATE TABLE `zb_dynamic` (
  `dynamic_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键自增',
  `uid` int(11) unsigned NOT NULL COMMENT '用户ID',
  `title` varchar(255) NOT NULL COMMENT '动态标题',
  `image` varchar(255) NOT NULL COMMENT '动态图片地址',
  `t` int(11) unsigned NOT NULL COMMENT '创建时间',
  `u` int(11) unsigned DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`dynamic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='主播动态表';

-- ----------------------------
-- Records of zb_dynamic
-- ----------------------------

-- ----------------------------
-- Table structure for zb_flash
-- ----------------------------
DROP TABLE IF EXISTS `zb_flash`;
CREATE TABLE `zb_flash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `o` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `o` (`o`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zb_flash
-- ----------------------------
INSERT INTO `zb_flash` VALUES ('1', '吃鸡吃鸡', 'http://www.baidu.com', '/Public/attached/2018/02/01/5a72856d0e4e9.jpeg', '1');

-- ----------------------------
-- Table structure for zb_level
-- ----------------------------
DROP TABLE IF EXISTS `zb_level`;
CREATE TABLE `zb_level` (
  `level_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键自增，等级ID',
  `serve_type_id` int(11) unsigned NOT NULL COMMENT '服务类型ID',
  `lever_name` varchar(32) DEFAULT NULL COMMENT '等级名称',
  `t` int(11) unsigned NOT NULL COMMENT '创建时间',
  `u` int(11) unsigned DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`level_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='等级分类表';

-- ----------------------------
-- Records of zb_level
-- ----------------------------

-- ----------------------------
-- Table structure for zb_links
-- ----------------------------
DROP TABLE IF EXISTS `zb_links`;
CREATE TABLE `zb_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `o` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `o` (`o`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zb_links
-- ----------------------------

-- ----------------------------
-- Table structure for zb_log
-- ----------------------------
DROP TABLE IF EXISTS `zb_log`;
CREATE TABLE `zb_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `t` int(10) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `log` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zb_log
-- ----------------------------
INSERT INTO `zb_log` VALUES ('1', 'admin', '1517390355', '127.0.0.1', '登录成功。');
INSERT INTO `zb_log` VALUES ('2', 'admin', '1517390405', '127.0.0.1', '修改网站配置。');
INSERT INTO `zb_log` VALUES ('3', 'admin', '1517390569', '127.0.0.1', '编辑会员信息，会员UID：1');
INSERT INTO `zb_log` VALUES ('4', 'admin', '1517390586', '127.0.0.1', '编辑会员信息，会员UID：1');
INSERT INTO `zb_log` VALUES ('5', 'admin', '1517390605', '127.0.0.1', '删除用户组ID：6');
INSERT INTO `zb_log` VALUES ('6', 'admin', '1517450386', '127.0.0.1', '登录成功。');
INSERT INTO `zb_log` VALUES ('7', 'admin', '1517451164', '127.0.0.1', '编辑用户组，ID：2，组名：主播');
INSERT INTO `zb_log` VALUES ('8', 'admin', '1517451268', '127.0.0.1', '新增会员，会员UID：2');
INSERT INTO `zb_log` VALUES ('9', 'admin', '1517452275', '127.0.0.1', '登录成功。');
INSERT INTO `zb_log` VALUES ('10', 'admin', '1517454704', '127.0.0.1', '新增焦点图');
INSERT INTO `zb_log` VALUES ('11', 'admin', '1517534440', '127.0.0.1', '登录成功。');
INSERT INTO `zb_log` VALUES ('12', 'admin', '1517577457', '::1', '备份完成！');
INSERT INTO `zb_log` VALUES ('13', 'admin', '1517577501', '::1', '备份文件删除成功！');
INSERT INTO `zb_log` VALUES ('14', 'admin', '1517578241', '::1', '编辑菜单，ID：24');
INSERT INTO `zb_log` VALUES ('15', 'admin', '1517579547', '::1', '分类修改排序，ID：1');
INSERT INTO `zb_log` VALUES ('16', 'admin', '1517580551', '::1', '登录成功。');
INSERT INTO `zb_log` VALUES ('17', 'admin', '1517580577', '::1', '分类修改排序，ID：12');
INSERT INTO `zb_log` VALUES ('18', 'admin', '1517580623', '::1', '分类修改排序，ID：1');
INSERT INTO `zb_log` VALUES ('19', 'admin', '1517580632', '::1', '分类修改排序，ID：13');
INSERT INTO `zb_log` VALUES ('20', 'admin', '1517580960', '::1', '分类修改排序，ID：12');
INSERT INTO `zb_log` VALUES ('21', 'admin', '1517580966', '::1', '分类修改排序，ID：13');
INSERT INTO `zb_log` VALUES ('22', 'admin', '1517581744', '::1', '登录成功。');
INSERT INTO `zb_log` VALUES ('23', 'admin', '1517584259', '::1', '登录成功。');
INSERT INTO `zb_log` VALUES ('24', 'admin', '1517584588', '::1', '登录成功。');
INSERT INTO `zb_log` VALUES ('25', 'admin', '1517584607', '::1', '新增分类，ID：36，名称：去玩儿群翁');
INSERT INTO `zb_log` VALUES ('26', 'admin', '1517588130', '::1', '删除分类，ID：13');
INSERT INTO `zb_log` VALUES ('27', 'admin', '1517588236', '::1', '新增分类，ID：14，名称：');
INSERT INTO `zb_log` VALUES ('28', 'admin', '1517588616', '::1', '删除菜单ID：63');
INSERT INTO `zb_log` VALUES ('29', 'admin', '1517588844', '::1', '删除菜单ID：11');
INSERT INTO `zb_log` VALUES ('30', 'admin', '1517588850', '::1', '删除菜单ID：12');
INSERT INTO `zb_log` VALUES ('31', 'admin', '1517621662', '::1', '编辑菜单，ID：26');
INSERT INTO `zb_log` VALUES ('32', 'admin', '1517621691', '::1', '编辑菜单，ID：25');
INSERT INTO `zb_log` VALUES ('33', 'admin', '1517621715', '::1', '编辑菜单，ID：27');
INSERT INTO `zb_log` VALUES ('34', 'admin', '1517621750', '::1', '编辑菜单，ID：29');
INSERT INTO `zb_log` VALUES ('35', 'admin', '1517621780', '::1', '编辑菜单，ID：30');
INSERT INTO `zb_log` VALUES ('36', 'admin', '1517621834', '::1', '编辑菜单，ID：31');
INSERT INTO `zb_log` VALUES ('37', 'admin', '1517621853', '::1', '编辑菜单，ID：32');
INSERT INTO `zb_log` VALUES ('38', 'admin', '1517621869', '::1', '编辑菜单，ID：33');
INSERT INTO `zb_log` VALUES ('39', 'admin', '1517621884', '::1', '编辑菜单，ID：34');
INSERT INTO `zb_log` VALUES ('40', 'admin', '1517621899', '::1', '编辑菜单，ID：36');
INSERT INTO `zb_log` VALUES ('41', 'admin', '1517621984', '::1', '编辑菜单，ID：24');
INSERT INTO `zb_log` VALUES ('42', 'admin', '1517623546', '::1', '编辑菜单，ID：58');
INSERT INTO `zb_log` VALUES ('43', 'admin', '1517623561', '::1', '编辑菜单，ID：3');
INSERT INTO `zb_log` VALUES ('44', 'admin', '1517623570', '::1', '编辑菜单，ID：4');
INSERT INTO `zb_log` VALUES ('45', 'admin', '1517623581', '::1', '编辑菜单，ID：5');
INSERT INTO `zb_log` VALUES ('46', 'admin', '1517623592', '::1', '编辑菜单，ID：7');
INSERT INTO `zb_log` VALUES ('47', 'admin', '1517623601', '::1', '编辑菜单，ID：7');
INSERT INTO `zb_log` VALUES ('48', 'admin', '1517623611', '::1', '编辑菜单，ID：8');
INSERT INTO `zb_log` VALUES ('49', 'admin', '1517623633', '::1', '编辑菜单，ID：8');
INSERT INTO `zb_log` VALUES ('50', 'admin', '1517623660', '::1', '编辑菜单，ID：58');
INSERT INTO `zb_log` VALUES ('51', 'admin', '1517623674', '::1', '编辑菜单，ID：9');
INSERT INTO `zb_log` VALUES ('52', 'admin', '1517623717', '::1', '编辑菜单，ID：13');
INSERT INTO `zb_log` VALUES ('53', 'admin', '1517623731', '::1', '编辑菜单，ID：13');
INSERT INTO `zb_log` VALUES ('54', 'admin', '1517623836', '::1', '新增菜单，名称：主播管理');
INSERT INTO `zb_log` VALUES ('55', 'admin', '1517623869', '::1', '编辑菜单，ID：66');
INSERT INTO `zb_log` VALUES ('56', 'admin', '1517624089', '::1', '新增菜单，名称：主播审核');
INSERT INTO `zb_log` VALUES ('57', 'admin', '1517624169', '::1', '新增菜单，名称：新增主播');
INSERT INTO `zb_log` VALUES ('58', 'admin', '1517624234', '::1', '新增菜单，名称：编辑主播');
INSERT INTO `zb_log` VALUES ('59', 'admin', '1517624316', '::1', '新增菜单，名称：保存主播');
INSERT INTO `zb_log` VALUES ('60', 'admin', '1517624392', '::1', '新增菜单，名称：删除主播');
INSERT INTO `zb_log` VALUES ('61', 'admin', '1517645919', '::1', '新增会员，会员UID：3');
INSERT INTO `zb_log` VALUES ('62', 'admin', '1517647289', '::1', '登录成功。');
INSERT INTO `zb_log` VALUES ('63', 'admin', '1517648287', '::1', '编辑菜单，ID：67');
INSERT INTO `zb_log` VALUES ('64', 'admin', '1517648301', '::1', '编辑菜单，ID：68');
INSERT INTO `zb_log` VALUES ('65', 'admin', '1517648331', '::1', '编辑菜单，ID：68');
INSERT INTO `zb_log` VALUES ('66', 'admin', '1517649282', '::1', '编辑会员信息，会员UID：2');
INSERT INTO `zb_log` VALUES ('67', 'admin', '1517649315', '::1', '编辑会员信息，会员UID：2');
INSERT INTO `zb_log` VALUES ('68', 'admin', '1517652289', '::1', '编辑菜单，ID：67');
INSERT INTO `zb_log` VALUES ('69', 'admin', '1517652307', '::1', '编辑菜单，ID：69');
INSERT INTO `zb_log` VALUES ('70', 'admin', '1517652320', '::1', '编辑菜单，ID：70');
INSERT INTO `zb_log` VALUES ('71', 'admin', '1517652334', '::1', '编辑菜单，ID：71');
INSERT INTO `zb_log` VALUES ('72', 'admin', '1517652439', '::1', '新增菜单，名称：保存审核');
INSERT INTO `zb_log` VALUES ('73', 'admin', '1517652468', '::1', '编辑菜单，ID：72');
INSERT INTO `zb_log` VALUES ('74', 'admin', '1517652513', '::1', '登录成功。');
INSERT INTO `zb_log` VALUES ('75', 'admin', '1517652556', '::1', '审核主播申请信息，会员UID：2 审核结果：驳回');
INSERT INTO `zb_log` VALUES ('76', 'admin', '1517802483', '127.0.0.1', '登录成功。');
INSERT INTO `zb_log` VALUES ('77', 'admin', '1517802533', '127.0.0.1', '删除菜单ID：68');
INSERT INTO `zb_log` VALUES ('78', 'admin', '1517807768', '127.0.0.1', '新增菜单，名称：主播管理');
INSERT INTO `zb_log` VALUES ('79', 'admin', '1517807784', '127.0.0.1', '编辑菜单，ID：13');
INSERT INTO `zb_log` VALUES ('80', 'admin', '1517807803', '127.0.0.1', '编辑菜单，ID：66');
INSERT INTO `zb_log` VALUES ('81', 'admin', '1517807837', '127.0.0.1', '编辑菜单，ID：67');
INSERT INTO `zb_log` VALUES ('82', 'admin', '1517807911', '127.0.0.1', '编辑菜单，ID：67');
INSERT INTO `zb_log` VALUES ('83', 'admin', '1517883736', '127.0.0.1', '登录成功。');
INSERT INTO `zb_log` VALUES ('84', 'admin', '1517883764', '127.0.0.1', '编辑菜单，ID：69');
INSERT INTO `zb_log` VALUES ('85', 'admin', '1517883778', '127.0.0.1', '编辑菜单，ID：70');
INSERT INTO `zb_log` VALUES ('86', 'admin', '1517883794', '127.0.0.1', '编辑菜单，ID：71');
INSERT INTO `zb_log` VALUES ('87', 'admin', '1517883846', '127.0.0.1', '编辑菜单，ID：72');
INSERT INTO `zb_log` VALUES ('88', 'admin', '1517968831', '127.0.0.1', '登录成功。');
INSERT INTO `zb_log` VALUES ('89', 'admin', '1517974287', '127.0.0.1', '主播提交申请信息，会员UID：2');
INSERT INTO `zb_log` VALUES ('90', 'admin', '1517974300', '127.0.0.1', '新增主播，用户ID：3, 主播ID：1');
INSERT INTO `zb_log` VALUES ('91', 'admin', '1517974300', '127.0.0.1', '审核主播申请信息，会员UID：3 审核结果：通过');
INSERT INTO `zb_log` VALUES ('92', 'admin', '1517981421', '127.0.0.1', '新增主播，用户ID：2, 主播ID：2');
INSERT INTO `zb_log` VALUES ('93', 'admin', '1517981421', '127.0.0.1', '审核主播申请信息，会员UID：2 审核结果：通过');
INSERT INTO `zb_log` VALUES ('94', 'admin', '1517993167', '127.0.0.1', '新增会员，会员UID：4');

-- ----------------------------
-- Table structure for zb_member
-- ----------------------------
DROP TABLE IF EXISTS `zb_member`;
CREATE TABLE `zb_member` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(225) NOT NULL,
  `wx` varchar(255) DEFAULT NULL COMMENT '微信帐号预留',
  `username` varchar(255) DEFAULT NULL COMMENT '昵称',
  `head` varchar(255) DEFAULT '' COMMENT '头像',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0保密1男，2女',
  `birthday` int(10) DEFAULT NULL COMMENT '生日',
  `age` int(3) unsigned DEFAULT NULL COMMENT '年龄，根据生日获取',
  `animal` varchar(32) DEFAULT NULL COMMENT '生肖，根据生日获取',
  `constellation` varchar(32) DEFAULT NULL COMMENT '星座，根据生日获取',
  `phone` varchar(20) DEFAULT '' COMMENT '电话',
  `qq` varchar(20) DEFAULT '' COMMENT 'QQ',
  `email` varchar(255) DEFAULT '' COMMENT '邮箱',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `attestation` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否认证，默认0未认证，1认证',
  `prov` varchar(128) DEFAULT '未知' COMMENT '省份',
  `city` varchar(128) DEFAULT '未知' COMMENT '城市',
  `balance` decimal(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '账户余额',
  `contribution` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '贡献值',
  `step` tinyint(1) NOT NULL DEFAULT '0' COMMENT '申请主播状态，默认0没申请，1提交申请，2申请撤销，3申请驳回，4申请通过',
  `st` int(11) NOT NULL DEFAULT '0' COMMENT '申请主播时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态，默认1正常，0禁用',
  `lt` int(11) NOT NULL COMMENT '最后登录时间',
  `t` int(10) unsigned NOT NULL COMMENT '注册时间',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zb_member
-- ----------------------------
INSERT INTO `zb_member` VALUES ('1', 'admin', null, null, '/Public/attached/201601/1453389194.png', '1', '1420128000', null, null, null, '13800000000', '', 'w@phpuse.cn', '66d6a1c8748025462128dc75bf5ae8d1', '0', '', '', '0.00', '0', '0', '0', '1', '0', '1517390586');
INSERT INTO `zb_member` VALUES ('2', '张三', null, '', '/Public/attached/2018/02/01/5a7277d6638c7.jpg', '2', '0', null, null, null, '', '', '', '7a3cd50141e765a5e3040dc5f195b4b6', '0', '北京', '东城区', '0.00', '0', '4', '1517635919', '1', '1517649315', '1517451267');
INSERT INTO `zb_member` VALUES ('3', 'soso', null, '嗖嗖', '/Public/attached/2018/02/03/5a75702564590.png', '1', '599068800', null, null, null, '18380450051', '475789765', 'w@phpuse.cn', '7a3cd50141e765a5e3040dc5f195b4b6', '1', '内蒙古', '通辽', '0.00', '9999', '4', '1517645919', '1', '1517645919', '1517645919');
INSERT INTO `zb_member` VALUES ('4', 'jeffry', null, '司徒侯远', '/Public/attached/2018/02/07/5a7abcacf2641.gif', '1', '643820400', '27', '午马', '双子座', '17600236932', '', '', '7a3cd50141e765a5e3040dc5f195b4b6', '1', '四川', '成都', '0.00', '123456', '0', '0', '1', '1517993167', '1517993167');

-- ----------------------------
-- Table structure for zb_serve
-- ----------------------------
DROP TABLE IF EXISTS `zb_serve`;
CREATE TABLE `zb_serve` (
  `serve_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键自增',
  `uid` int(11) unsigned NOT NULL COMMENT '用户ID',
  `serve_type_id` int(11) unsigned NOT NULL COMMENT '服务类型ID',
  `title` varchar(255) DEFAULT NULL COMMENT '服务标题',
  `level_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '类型ID',
  `price` int(11) unsigned DEFAULT NULL COMMENT '价格',
  `sales_volume` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '销量',
  `voice` varchar(255) DEFAULT NULL COMMENT '服务介绍音频地址',
  `description` text COMMENT '描述',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '服务排序',
  `t` int(11) unsigned NOT NULL COMMENT '创建时间',
  `u` int(11) unsigned DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`serve_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='服务表【商品表】';

-- ----------------------------
-- Records of zb_serve
-- ----------------------------

-- ----------------------------
-- Table structure for zb_serve_type
-- ----------------------------
DROP TABLE IF EXISTS `zb_serve_type`;
CREATE TABLE `zb_serve_type` (
  `serve_type_id` int(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键自增ID',
  `title` varchar(32) NOT NULL COMMENT '分类名称',
  `icon` varchar(255) NOT NULL COMMENT '分类图标地址',
  `sort` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '分类排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '分类状态，1正常，0禁用',
  `way` tinyint(1) NOT NULL DEFAULT '1' COMMENT '收费方式，1:小时,2:天,3:次,4:局,5:首',
  `pid` int(6) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `t` int(11) NOT NULL COMMENT '创建时间',
  `u` int(11) unsigned DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`serve_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='服务类型表';

-- ----------------------------
-- Records of zb_serve_type
-- ----------------------------
INSERT INTO `zb_serve_type` VALUES ('1', '线上LOL', '/Public/home/images/wx_lol.png', '1', '1', '1', '0', '0', null);
INSERT INTO `zb_serve_type` VALUES ('2', '线下LOL', '/Public/home/images/wx_xlol.png', '2', '1', '1', '0', '0', null);
INSERT INTO `zb_serve_type` VALUES ('3', '王者荣耀', '/Public/home/images/wx_wzry.png', '3', '1', '4', '0', '0', null);
INSERT INTO `zb_serve_type` VALUES ('4', '绝地求生', '/Public/home/images/wx_jdqs.png', '4', '1', '1', '0', '0', null);
INSERT INTO `zb_serve_type` VALUES ('5', '声优聊天', '/Public/home/images/wx_sylt.png', '5', '1', '1', '0', '0', null);
INSERT INTO `zb_serve_type` VALUES ('6', '荒野行动', '/Public/home/images/wx_hover_20016.png', '6', '1', '1', '0', '0', null);
INSERT INTO `zb_serve_type` VALUES ('7', '哄睡觉', '/Public/home/images/wx_hs.png', '7', '1', '1', '0', '0', null);
INSERT INTO `zb_serve_type` VALUES ('8', '虚拟恋人', '/Public/home/images/xnlr.png', '8', '1', '2', '0', '0', null);
INSERT INTO `zb_serve_type` VALUES ('9', 'ASMR', '/Public/home/images/wx_asmr.png', '9', '1', '1', '0', '0', null);
INSERT INTO `zb_serve_type` VALUES ('10', '线上歌手', '/Public/home/images/wx_xsgs.png', '10', '1', '5', '0', '0', null);
INSERT INTO `zb_serve_type` VALUES ('11', '叫醒', '/Public/home/images/wx_jx.png', '11', '1', '3', '0', '0', null);
INSERT INTO `zb_serve_type` VALUES ('12', '声音鉴定', '/Public/home/images/wx_sj.png', '12', '1', '3', '0', '0', null);
INSERT INTO `zb_serve_type` VALUES ('13', '视频聊天', '/Public/attached/2018/02/03/5a748f0b5b8ac.png', '13', '1', '1', '0', '1517588236', null);

-- ----------------------------
-- Table structure for zb_setting
-- ----------------------------
DROP TABLE IF EXISTS `zb_setting`;
CREATE TABLE `zb_setting` (
  `k` varchar(100) NOT NULL COMMENT '变量',
  `v` varchar(255) NOT NULL COMMENT '值',
  `type` tinyint(1) NOT NULL COMMENT '0系统，1自定义',
  `name` varchar(255) NOT NULL COMMENT '说明',
  PRIMARY KEY (`k`),
  KEY `k` (`k`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zb_setting
-- ----------------------------
INSERT INTO `zb_setting` VALUES ('sitename', 'MANAGE', '0', '');
INSERT INTO `zb_setting` VALUES ('title', '微笑前行', '0', '');
INSERT INTO `zb_setting` VALUES ('keywords', '关键词', '0', '');
INSERT INTO `zb_setting` VALUES ('description', '网站描述', '0', '');
INSERT INTO `zb_setting` VALUES ('footer', '2016©Anchor', '0', '');
INSERT INTO `zb_setting` VALUES ('test', '测试', '1', '测试变量');
