/*
Navicat MySQL Data Transfer

Source Server         : DB
Source Server Version : 50720
Source Host           : localhost:3306
Source Database       : anchor

Target Server Type    : MYSQL
Target Server Version : 50720
File Encoding         : 65001

Date: 2018-02-28 17:34:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for zb_anchor
-- ----------------------------
DROP TABLE IF EXISTS `zb_anchor`;
CREATE TABLE `zb_anchor` (
  `anchor_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主播ID',
  `uid` int(11) unsigned NOT NULL COMMENT '用户ID',
  `order_time` varchar(128) DEFAULT '00:00-23:30' COMMENT '接单时间',
  `video` varchar(255) DEFAULT '' COMMENT '视频展示',
  `audio` varchar(255) DEFAULT NULL COMMENT '音频介绍',
  `usercp` int(11) DEFAULT '0' COMMENT '魅力值',
  `signature` varchar(255) DEFAULT NULL COMMENT '签名',
  `height` int(3) unsigned DEFAULT NULL COMMENT '身高单位CM',
  `profession` tinyint(2) DEFAULT NULL COMMENT '职业,默认0其它,1主播,2学生,3模特,4护士,5教师',
  `charm` varchar(64) DEFAULT '0' COMMENT '魅力部位，默认0无,详情看配置,多个以逗号分割',
  `character` varchar(128) DEFAULT NULL COMMENT '个性标签',
  `hobbies` varchar(128) DEFAULT NULL COMMENT '兴趣爱好',
  `recommend` tinyint(1) unsigned DEFAULT '0' COMMENT '是否推荐，默认0不推荐，1推荐',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `t` int(11) unsigned NOT NULL COMMENT '创建时间',
  `u` int(11) unsigned DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`anchor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='主播基础表';

-- ----------------------------
-- Records of zb_anchor
-- ----------------------------
INSERT INTO `zb_anchor` VALUES ('1', '30', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405317', '1518405317');
INSERT INTO `zb_anchor` VALUES ('2', '25', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405320', '1518405320');
INSERT INTO `zb_anchor` VALUES ('3', '20', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405322', '1518405322');
INSERT INTO `zb_anchor` VALUES ('4', '15', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405325', '1518405325');
INSERT INTO `zb_anchor` VALUES ('5', '10', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405327', '1518405327');
INSERT INTO `zb_anchor` VALUES ('6', '5', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405329', '1518405329');
INSERT INTO `zb_anchor` VALUES ('7', '27', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405331', '1518405331');
INSERT INTO `zb_anchor` VALUES ('8', '22', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405334', '1518405334');
INSERT INTO `zb_anchor` VALUES ('9', '17', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405337', '1518405337');
INSERT INTO `zb_anchor` VALUES ('10', '12', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405339', '1518405339');
INSERT INTO `zb_anchor` VALUES ('11', '7', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405352', '1518405352');
INSERT INTO `zb_anchor` VALUES ('12', '3', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405354', '1518405354');
INSERT INTO `zb_anchor` VALUES ('13', '29', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405357', '1518405357');
INSERT INTO `zb_anchor` VALUES ('14', '24', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405360', '1518405360');
INSERT INTO `zb_anchor` VALUES ('15', '19', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405362', '1518405362');
INSERT INTO `zb_anchor` VALUES ('16', '14', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405364', '1518405364');
INSERT INTO `zb_anchor` VALUES ('17', '9', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405367', '1518405367');
INSERT INTO `zb_anchor` VALUES ('18', '31', '00:00-23:30', '/Public/attached/2018/02/22/5a8e6f682e214.mp4', '/Public/demo/1765661496402891.MP3', '845', '123456', '170', '3', '1,2,3', '颜值担当,激情四射', '做饭,上网', '1', '123', '1518405369', '1519622632');
INSERT INTO `zb_anchor` VALUES ('19', '26', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405371', '1518405371');
INSERT INTO `zb_anchor` VALUES ('20', '21', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405375', '1518405375');
INSERT INTO `zb_anchor` VALUES ('21', '16', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405378', '1518405378');
INSERT INTO `zb_anchor` VALUES ('22', '11', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405381', '1518405381');
INSERT INTO `zb_anchor` VALUES ('23', '6', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405383', '1518405383');
INSERT INTO `zb_anchor` VALUES ('24', '28', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405386', '1518405386');
INSERT INTO `zb_anchor` VALUES ('25', '23', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405388', '1518405388');
INSERT INTO `zb_anchor` VALUES ('26', '18', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405390', '1518405390');
INSERT INTO `zb_anchor` VALUES ('27', '13', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405393', '1518405393');
INSERT INTO `zb_anchor` VALUES ('28', '8', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405395', '1518405395');
INSERT INTO `zb_anchor` VALUES ('29', '4', '00:00-23:30', '', null, '0', null, null, null, null, null, null, '0', null, '1518405397', '1518405397');

-- ----------------------------
-- Table structure for zb_anchor_type
-- ----------------------------
DROP TABLE IF EXISTS `zb_anchor_type`;
CREATE TABLE `zb_anchor_type` (
  `anchor_type_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID自增',
  `anchor_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `serve_id` int(11) unsigned NOT NULL COMMENT '服务ID',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '分类等级，0，1，2，3，4，5',
  `price` int(11) unsigned DEFAULT '0' COMMENT '价格',
  `num` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '接单次数',
  `description` text COMMENT '订单描述',
  `t` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`anchor_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COMMENT='主播类型映射表';

-- ----------------------------
-- Records of zb_anchor_type
-- ----------------------------
INSERT INTO `zb_anchor_type` VALUES ('1', '1', '1', '2', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('2', '2', '2', '2', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('3', '3', '3', '2', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('4', '4', '4', '2', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('5', '5', '5', '2', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('6', '6', '6', '2', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('7', '7', '7', '2', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('8', '8', '8', '2', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('9', '9', '1', '1', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('10', '10', '2', '2', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('11', '11', '3', '3', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('12', '12', '4', '4', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('13', '13', '5', '4', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('14', '14', '6', '1', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('15', '15', '7', '2', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('16', '16', '8', '3', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('17', '17', '1', '4', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('35', '18', '3', '2', '0', '12', '', '1519784278');
INSERT INTO `zb_anchor_type` VALUES ('19', '19', '3', '1', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('20', '20', '4', '2', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('21', '21', '5', '3', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('22', '22', '6', '4', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('23', '23', '7', '5', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('24', '24', '8', '1', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('25', '25', '1', '2', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('26', '26', '2', '3', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('27', '27', '3', '4', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('28', '28', '4', '5', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('29', '29', '5', '1', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('30', '30', '6', '2', '0', '3600', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('34', '18', '2', '4', '0', '0', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('36', '18', '4', '0', '0', '0', null, '0');
INSERT INTO `zb_anchor_type` VALUES ('37', '18', '7', '1', '0', '0', null, '0');

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
INSERT INTO `zb_auth_group_access` VALUES ('2', '2');
INSERT INTO `zb_auth_group_access` VALUES ('3', '2');
INSERT INTO `zb_auth_group_access` VALUES ('4', '2');
INSERT INTO `zb_auth_group_access` VALUES ('5', '2');
INSERT INTO `zb_auth_group_access` VALUES ('6', '2');
INSERT INTO `zb_auth_group_access` VALUES ('7', '2');
INSERT INTO `zb_auth_group_access` VALUES ('8', '2');
INSERT INTO `zb_auth_group_access` VALUES ('9', '2');
INSERT INTO `zb_auth_group_access` VALUES ('10', '2');
INSERT INTO `zb_auth_group_access` VALUES ('11', '2');
INSERT INTO `zb_auth_group_access` VALUES ('12', '2');
INSERT INTO `zb_auth_group_access` VALUES ('13', '2');
INSERT INTO `zb_auth_group_access` VALUES ('14', '2');
INSERT INTO `zb_auth_group_access` VALUES ('15', '2');
INSERT INTO `zb_auth_group_access` VALUES ('16', '2');
INSERT INTO `zb_auth_group_access` VALUES ('17', '2');
INSERT INTO `zb_auth_group_access` VALUES ('18', '2');
INSERT INTO `zb_auth_group_access` VALUES ('19', '2');
INSERT INTO `zb_auth_group_access` VALUES ('20', '2');
INSERT INTO `zb_auth_group_access` VALUES ('21', '2');
INSERT INTO `zb_auth_group_access` VALUES ('22', '2');
INSERT INTO `zb_auth_group_access` VALUES ('23', '2');
INSERT INTO `zb_auth_group_access` VALUES ('24', '2');
INSERT INTO `zb_auth_group_access` VALUES ('25', '2');
INSERT INTO `zb_auth_group_access` VALUES ('26', '2');
INSERT INTO `zb_auth_group_access` VALUES ('27', '2');
INSERT INTO `zb_auth_group_access` VALUES ('28', '2');
INSERT INTO `zb_auth_group_access` VALUES ('29', '2');
INSERT INTO `zb_auth_group_access` VALUES ('30', '2');
INSERT INTO `zb_auth_group_access` VALUES ('31', '2');

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
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;

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
INSERT INTO `zb_auth_rule` VALUES ('74', '73', 'Anchor/dynamic', '动态管理', 'menu-icon fa fa-caret-right', '1', '1', '', '1', '0', '');

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
  `content` varchar(255) NOT NULL COMMENT '动态标题',
  `image` varchar(255) NOT NULL COMMENT '动态图片地址',
  `t` int(11) unsigned NOT NULL COMMENT '创建时间',
  `u` int(11) unsigned DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`dynamic_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='主播动态表';

-- ----------------------------
-- Records of zb_dynamic
-- ----------------------------
INSERT INTO `zb_dynamic` VALUES ('1', '31', '测试1', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '1518404590', '1518404590');
INSERT INTO `zb_dynamic` VALUES ('2', '31', '测试2', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '1518404592', '1518404590');
INSERT INTO `zb_dynamic` VALUES ('3', '31', '测试3', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '1518404593', '1518404590');
INSERT INTO `zb_dynamic` VALUES ('4', '31', '测试4', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '1518404594', '1518404590');
INSERT INTO `zb_dynamic` VALUES ('5', '31', '测试5', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '1518404595', '1518404590');
INSERT INTO `zb_dynamic` VALUES ('6', '31', '测试6', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '1518404596', '1518404590');
INSERT INTO `zb_dynamic` VALUES ('7', '31', '测试7', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '1518404597', '1518404590');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zb_flash
-- ----------------------------
INSERT INTO `zb_flash` VALUES ('2', '绝地求生', 'http://www.baidu.com', '/Public/attached/2018/02/12/5a80fa7659e13.jpg', '1');
INSERT INTO `zb_flash` VALUES ('3', '我是男主播', 'http://www.baidu.com', '/Public/attached/2018/02/12/5a80fab3bcd8f.jpg', '2');
INSERT INTO `zb_flash` VALUES ('4', '最强路人王', 'http://www.baidu.com', '/Public/attached/2018/02/12/5a80fad4dddef.jpg', '3');
INSERT INTO `zb_flash` VALUES ('5', '战意', 'http://www.baidu.com', '/Public/attached/2018/02/12/5a80faf5e491d.jpg', '4');

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
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zb_log
-- ----------------------------
INSERT INTO `zb_log` VALUES ('1', 'admin', '1518404590', '127.0.0.1', '新增会员，会员UID：2');
INSERT INTO `zb_log` VALUES ('2', 'admin', '1518405226', '127.0.0.1', '主播提交申请信息，会员UID：2');
INSERT INTO `zb_log` VALUES ('3', 'admin', '1518405229', '127.0.0.1', '主播提交申请信息，会员UID：3');
INSERT INTO `zb_log` VALUES ('4', 'admin', '1518405231', '127.0.0.1', '主播提交申请信息，会员UID：4');
INSERT INTO `zb_log` VALUES ('5', 'admin', '1518405233', '127.0.0.1', '主播提交申请信息，会员UID：5');
INSERT INTO `zb_log` VALUES ('6', 'admin', '1518405235', '127.0.0.1', '主播提交申请信息，会员UID：6');
INSERT INTO `zb_log` VALUES ('7', 'admin', '1518405238', '127.0.0.1', '主播提交申请信息，会员UID：7');
INSERT INTO `zb_log` VALUES ('8', 'admin', '1518405242', '127.0.0.1', '主播提交申请信息，会员UID：8');
INSERT INTO `zb_log` VALUES ('9', 'admin', '1518405245', '127.0.0.1', '主播提交申请信息，会员UID：9');
INSERT INTO `zb_log` VALUES ('10', 'admin', '1518405248', '127.0.0.1', '主播提交申请信息，会员UID：10');
INSERT INTO `zb_log` VALUES ('11', 'admin', '1518405255', '127.0.0.1', '主播提交申请信息，会员UID：11');
INSERT INTO `zb_log` VALUES ('12', 'admin', '1518405258', '127.0.0.1', '主播提交申请信息，会员UID：12');
INSERT INTO `zb_log` VALUES ('13', 'admin', '1518405260', '127.0.0.1', '主播提交申请信息，会员UID：13');
INSERT INTO `zb_log` VALUES ('14', 'admin', '1518405263', '127.0.0.1', '主播提交申请信息，会员UID：14');
INSERT INTO `zb_log` VALUES ('15', 'admin', '1518405265', '127.0.0.1', '主播提交申请信息，会员UID：15');
INSERT INTO `zb_log` VALUES ('16', 'admin', '1518405267', '127.0.0.1', '主播提交申请信息，会员UID：16');
INSERT INTO `zb_log` VALUES ('17', 'admin', '1518405269', '127.0.0.1', '主播提交申请信息，会员UID：17');
INSERT INTO `zb_log` VALUES ('18', 'admin', '1518405271', '127.0.0.1', '主播提交申请信息，会员UID：18');
INSERT INTO `zb_log` VALUES ('19', 'admin', '1518405273', '127.0.0.1', '主播提交申请信息，会员UID：19');
INSERT INTO `zb_log` VALUES ('20', 'admin', '1518405275', '127.0.0.1', '主播提交申请信息，会员UID：20');
INSERT INTO `zb_log` VALUES ('21', 'admin', '1518405280', '127.0.0.1', '主播提交申请信息，会员UID：21');
INSERT INTO `zb_log` VALUES ('22', 'admin', '1518405284', '127.0.0.1', '主播提交申请信息，会员UID：22');
INSERT INTO `zb_log` VALUES ('23', 'admin', '1518405286', '127.0.0.1', '主播提交申请信息，会员UID：23');
INSERT INTO `zb_log` VALUES ('24', 'admin', '1518405288', '127.0.0.1', '主播提交申请信息，会员UID：24');
INSERT INTO `zb_log` VALUES ('25', 'admin', '1518405290', '127.0.0.1', '主播提交申请信息，会员UID：25');
INSERT INTO `zb_log` VALUES ('26', 'admin', '1518405292', '127.0.0.1', '主播提交申请信息，会员UID：26');
INSERT INTO `zb_log` VALUES ('27', 'admin', '1518405295', '127.0.0.1', '主播提交申请信息，会员UID：27');
INSERT INTO `zb_log` VALUES ('28', 'admin', '1518405297', '127.0.0.1', '主播提交申请信息，会员UID：28');
INSERT INTO `zb_log` VALUES ('29', 'admin', '1518405299', '127.0.0.1', '主播提交申请信息，会员UID：29');
INSERT INTO `zb_log` VALUES ('30', 'admin', '1518405302', '127.0.0.1', '主播提交申请信息，会员UID：30');
INSERT INTO `zb_log` VALUES ('31', 'admin', '1518405309', '127.0.0.1', '主播提交申请信息，会员UID：31');
INSERT INTO `zb_log` VALUES ('32', 'admin', '1518405317', '127.0.0.1', '新增主播，用户ID：30, 主播ID：1');
INSERT INTO `zb_log` VALUES ('33', 'admin', '1518405317', '127.0.0.1', '审核主播申请信息，会员UID：30 审核结果：通过');
INSERT INTO `zb_log` VALUES ('34', 'admin', '1518405320', '127.0.0.1', '新增主播，用户ID：25, 主播ID：2');
INSERT INTO `zb_log` VALUES ('35', 'admin', '1518405320', '127.0.0.1', '审核主播申请信息，会员UID：25 审核结果：通过');
INSERT INTO `zb_log` VALUES ('36', 'admin', '1518405322', '127.0.0.1', '新增主播，用户ID：20, 主播ID：3');
INSERT INTO `zb_log` VALUES ('37', 'admin', '1518405322', '127.0.0.1', '审核主播申请信息，会员UID：20 审核结果：通过');
INSERT INTO `zb_log` VALUES ('38', 'admin', '1518405325', '127.0.0.1', '新增主播，用户ID：15, 主播ID：4');
INSERT INTO `zb_log` VALUES ('39', 'admin', '1518405325', '127.0.0.1', '审核主播申请信息，会员UID：15 审核结果：通过');
INSERT INTO `zb_log` VALUES ('40', 'admin', '1518405327', '127.0.0.1', '新增主播，用户ID：10, 主播ID：5');
INSERT INTO `zb_log` VALUES ('41', 'admin', '1518405327', '127.0.0.1', '审核主播申请信息，会员UID：10 审核结果：通过');
INSERT INTO `zb_log` VALUES ('42', 'admin', '1518405329', '127.0.0.1', '新增主播，用户ID：5, 主播ID：6');
INSERT INTO `zb_log` VALUES ('43', 'admin', '1518405329', '127.0.0.1', '审核主播申请信息，会员UID：5 审核结果：通过');
INSERT INTO `zb_log` VALUES ('44', 'admin', '1518405331', '127.0.0.1', '新增主播，用户ID：27, 主播ID：7');
INSERT INTO `zb_log` VALUES ('45', 'admin', '1518405331', '127.0.0.1', '审核主播申请信息，会员UID：27 审核结果：通过');
INSERT INTO `zb_log` VALUES ('46', 'admin', '1518405334', '127.0.0.1', '新增主播，用户ID：22, 主播ID：8');
INSERT INTO `zb_log` VALUES ('47', 'admin', '1518405334', '127.0.0.1', '审核主播申请信息，会员UID：22 审核结果：通过');
INSERT INTO `zb_log` VALUES ('48', 'admin', '1518405337', '127.0.0.1', '新增主播，用户ID：17, 主播ID：9');
INSERT INTO `zb_log` VALUES ('49', 'admin', '1518405337', '127.0.0.1', '审核主播申请信息，会员UID：17 审核结果：通过');
INSERT INTO `zb_log` VALUES ('50', 'admin', '1518405339', '127.0.0.1', '新增主播，用户ID：12, 主播ID：10');
INSERT INTO `zb_log` VALUES ('51', 'admin', '1518405339', '127.0.0.1', '审核主播申请信息，会员UID：12 审核结果：通过');
INSERT INTO `zb_log` VALUES ('52', 'admin', '1518405352', '127.0.0.1', '新增主播，用户ID：7, 主播ID：11');
INSERT INTO `zb_log` VALUES ('53', 'admin', '1518405352', '127.0.0.1', '审核主播申请信息，会员UID：7 审核结果：通过');
INSERT INTO `zb_log` VALUES ('54', 'admin', '1518405354', '127.0.0.1', '新增主播，用户ID：3, 主播ID：12');
INSERT INTO `zb_log` VALUES ('55', 'admin', '1518405354', '127.0.0.1', '审核主播申请信息，会员UID：3 审核结果：通过');
INSERT INTO `zb_log` VALUES ('56', 'admin', '1518405357', '127.0.0.1', '新增主播，用户ID：29, 主播ID：13');
INSERT INTO `zb_log` VALUES ('57', 'admin', '1518405357', '127.0.0.1', '审核主播申请信息，会员UID：29 审核结果：通过');
INSERT INTO `zb_log` VALUES ('58', 'admin', '1518405360', '127.0.0.1', '新增主播，用户ID：24, 主播ID：14');
INSERT INTO `zb_log` VALUES ('59', 'admin', '1518405360', '127.0.0.1', '审核主播申请信息，会员UID：24 审核结果：通过');
INSERT INTO `zb_log` VALUES ('60', 'admin', '1518405362', '127.0.0.1', '新增主播，用户ID：19, 主播ID：15');
INSERT INTO `zb_log` VALUES ('61', 'admin', '1518405362', '127.0.0.1', '审核主播申请信息，会员UID：19 审核结果：通过');
INSERT INTO `zb_log` VALUES ('62', 'admin', '1518405364', '127.0.0.1', '新增主播，用户ID：14, 主播ID：16');
INSERT INTO `zb_log` VALUES ('63', 'admin', '1518405364', '127.0.0.1', '审核主播申请信息，会员UID：14 审核结果：通过');
INSERT INTO `zb_log` VALUES ('64', 'admin', '1518405367', '127.0.0.1', '新增主播，用户ID：9, 主播ID：17');
INSERT INTO `zb_log` VALUES ('65', 'admin', '1518405367', '127.0.0.1', '审核主播申请信息，会员UID：9 审核结果：通过');
INSERT INTO `zb_log` VALUES ('66', 'admin', '1518405369', '127.0.0.1', '新增主播，用户ID：31, 主播ID：18');
INSERT INTO `zb_log` VALUES ('67', 'admin', '1518405369', '127.0.0.1', '审核主播申请信息，会员UID：31 审核结果：通过');
INSERT INTO `zb_log` VALUES ('68', 'admin', '1518405371', '127.0.0.1', '新增主播，用户ID：26, 主播ID：19');
INSERT INTO `zb_log` VALUES ('69', 'admin', '1518405371', '127.0.0.1', '审核主播申请信息，会员UID：26 审核结果：通过');
INSERT INTO `zb_log` VALUES ('70', 'admin', '1518405375', '127.0.0.1', '新增主播，用户ID：21, 主播ID：20');
INSERT INTO `zb_log` VALUES ('71', 'admin', '1518405375', '127.0.0.1', '审核主播申请信息，会员UID：21 审核结果：通过');
INSERT INTO `zb_log` VALUES ('72', 'admin', '1518405378', '127.0.0.1', '新增主播，用户ID：16, 主播ID：21');
INSERT INTO `zb_log` VALUES ('73', 'admin', '1518405378', '127.0.0.1', '审核主播申请信息，会员UID：16 审核结果：通过');
INSERT INTO `zb_log` VALUES ('74', 'admin', '1518405381', '127.0.0.1', '新增主播，用户ID：11, 主播ID：22');
INSERT INTO `zb_log` VALUES ('75', 'admin', '1518405381', '127.0.0.1', '审核主播申请信息，会员UID：11 审核结果：通过');
INSERT INTO `zb_log` VALUES ('76', 'admin', '1518405383', '127.0.0.1', '新增主播，用户ID：6, 主播ID：23');
INSERT INTO `zb_log` VALUES ('77', 'admin', '1518405383', '127.0.0.1', '审核主播申请信息，会员UID：6 审核结果：通过');
INSERT INTO `zb_log` VALUES ('78', 'admin', '1518405386', '127.0.0.1', '新增主播，用户ID：28, 主播ID：24');
INSERT INTO `zb_log` VALUES ('79', 'admin', '1518405386', '127.0.0.1', '审核主播申请信息，会员UID：28 审核结果：通过');
INSERT INTO `zb_log` VALUES ('80', 'admin', '1518405388', '127.0.0.1', '新增主播，用户ID：23, 主播ID：25');
INSERT INTO `zb_log` VALUES ('81', 'admin', '1518405388', '127.0.0.1', '审核主播申请信息，会员UID：23 审核结果：通过');
INSERT INTO `zb_log` VALUES ('82', 'admin', '1518405390', '127.0.0.1', '新增主播，用户ID：18, 主播ID：26');
INSERT INTO `zb_log` VALUES ('83', 'admin', '1518405390', '127.0.0.1', '审核主播申请信息，会员UID：18 审核结果：通过');
INSERT INTO `zb_log` VALUES ('84', 'admin', '1518405393', '127.0.0.1', '新增主播，用户ID：13, 主播ID：27');
INSERT INTO `zb_log` VALUES ('85', 'admin', '1518405393', '127.0.0.1', '审核主播申请信息，会员UID：13 审核结果：通过');
INSERT INTO `zb_log` VALUES ('86', 'admin', '1518405395', '127.0.0.1', '新增主播，用户ID：8, 主播ID：28');
INSERT INTO `zb_log` VALUES ('87', 'admin', '1518405395', '127.0.0.1', '审核主播申请信息，会员UID：8 审核结果：通过');
INSERT INTO `zb_log` VALUES ('88', 'admin', '1518405397', '127.0.0.1', '新增主播，用户ID：4, 主播ID：29');
INSERT INTO `zb_log` VALUES ('89', 'admin', '1518405397', '127.0.0.1', '审核主播申请信息，会员UID：4 审核结果：通过');
INSERT INTO `zb_log` VALUES ('90', 'admin', '1519262665', '127.0.0.1', '登录成功。');
INSERT INTO `zb_log` VALUES ('91', 'admin', '1519266168', '127.0.0.1', '服务分类修改，ID：1，名称：线上LOL');
INSERT INTO `zb_log` VALUES ('92', 'admin', '1519266177', '127.0.0.1', '服务分类修改，ID：1，名称：线上LOL');
INSERT INTO `zb_log` VALUES ('93', 'admin', '1519270498', '127.0.0.1', '登录成功。');
INSERT INTO `zb_log` VALUES ('94', 'admin', '1519276985', '127.0.0.1', '登录成功。');
INSERT INTO `zb_log` VALUES ('95', 'admin', '1519277008', '127.0.0.1', '登录成功。');
INSERT INTO `zb_log` VALUES ('96', 'admin', '1519277288', '127.0.0.1', '登录成功。');
INSERT INTO `zb_log` VALUES ('97', 'admin', '1519277348', '127.0.0.1', '登录成功。');
INSERT INTO `zb_log` VALUES ('98', 'admin', '1519277861', '127.0.0.1', '登录成功。');
INSERT INTO `zb_log` VALUES ('99', 'admin', '1519277887', '127.0.0.1', '登录成功。');
INSERT INTO `zb_log` VALUES ('100', 'admin', '1519350352', '127.0.0.1', '登录成功。');
INSERT INTO `zb_log` VALUES ('101', 'admin', '1519456787', '127.0.0.1', '更新用户ID：31;username：记忆灬♚厘子');
INSERT INTO `zb_log` VALUES ('102', 'admin', '1519456787', '127.0.0.1', '修改主播信息ID：18');
INSERT INTO `zb_log` VALUES ('103', 'admin', '1519456787', '127.0.0.1', '更新主播分类等级：主播ID18;分类ID：2;');
INSERT INTO `zb_log` VALUES ('104', 'admin', '1519456787', '127.0.0.1', '更新主播分类等级：主播ID18;分类ID：3;');
INSERT INTO `zb_log` VALUES ('105', 'admin', '1519456805', '127.0.0.1', '更新用户ID：31;username：记忆灬♚厘子');
INSERT INTO `zb_log` VALUES ('106', 'admin', '1519456805', '127.0.0.1', '修改主播信息ID：18');
INSERT INTO `zb_log` VALUES ('107', 'admin', '1519456805', '127.0.0.1', '更新主播分类等级：主播ID18;分类ID：2;');
INSERT INTO `zb_log` VALUES ('108', 'admin', '1519456805', '127.0.0.1', '更新主播分类等级：主播ID18;分类ID：3;');
INSERT INTO `zb_log` VALUES ('109', 'admin', '1519456805', '127.0.0.1', '更新主播分类等级：主播ID18;分类ID：4;');
INSERT INTO `zb_log` VALUES ('110', 'admin', '1519456805', '127.0.0.1', '更新主播分类等级：主播ID18;分类ID：7;');
INSERT INTO `zb_log` VALUES ('111', 'admin', '1519607427', '127.0.0.1', '登录成功。');
INSERT INTO `zb_log` VALUES ('112', 'admin', '1519622320', '127.0.0.1', '更新用户ID：31;username：记忆灬♚厘子');
INSERT INTO `zb_log` VALUES ('113', 'admin', '1519622320', '127.0.0.1', '修改主播信息ID：18');
INSERT INTO `zb_log` VALUES ('114', 'admin', '1519622320', '127.0.0.1', '更新主播分类等级：主播ID18');
INSERT INTO `zb_log` VALUES ('115', 'admin', '1519622599', '127.0.0.1', '更新用户ID：31;username：记忆灬♚厘子');
INSERT INTO `zb_log` VALUES ('116', 'admin', '1519622599', '127.0.0.1', '修改主播信息ID：18');
INSERT INTO `zb_log` VALUES ('117', 'admin', '1519622599', '127.0.0.1', '更新主播分类等级：主播ID18');
INSERT INTO `zb_log` VALUES ('118', 'admin', '1519622632', '127.0.0.1', '更新用户ID：31;username：记忆灬♚厘子');
INSERT INTO `zb_log` VALUES ('119', 'admin', '1519622632', '127.0.0.1', '修改主播信息ID：18');
INSERT INTO `zb_log` VALUES ('120', 'admin', '1519622632', '127.0.0.1', '更新主播分类等级：主播ID18');
INSERT INTO `zb_log` VALUES ('121', 'admin', '1519711065', '127.0.0.1', '登录成功。');
INSERT INTO `zb_log` VALUES ('122', 'admin', '1519784278', '127.0.0.1', '修改主播分类信息ID：35');
INSERT INTO `zb_log` VALUES ('123', 'admin', '1519785329', '127.0.0.1', '新增菜单，名称：动态管理');

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zb_member
-- ----------------------------
INSERT INTO `zb_member` VALUES ('1', 'admin', null, '超管', '/Public/attached/2018/02/12/5a8103c7ed2a0.png', '1', '1420128000', '27', null, null, '13800000000', '', 'w@phpuse.cn', '66d6a1c8748025462128dc75bf5ae8d1', '0', '', '', '0.00', '0', '0', '0', '1', '0', '1517390586');
INSERT INTO `zb_member` VALUES ('2', 'test1', null, '记忆灬♚厘子', '/Public/attached/2018/02/12/5a8103c7ed2a0.png', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '1', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('3', 'test2', '', 've萌你心de女人', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('4', 'test3', '', '先生邇真帥', '/Public/attached/2018/02/12/5a8103c7ed2a02.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('5', 'test4', '', '穿裙子倒立', '/Public/attached/2018/02/12/5a8103c7ed2a03.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('6', 'test5', '', '红衣女子i', '/Public/attached/2018/02/12/5a8103c7ed2a04.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('7', 'test6', '', '味尐釹馆', '/Public/attached/2018/02/12/5a8103c7ed2a05.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('8', 'test7', '', '哪艏婧謌', '/Public/attached/2018/02/12/5a8103c7ed2a06.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('9', 'test8', '', '袹迣鯖', '/Public/attached/2018/02/12/5a8103c7ed2a07.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('10', 'test9', '', '恋爱达人', '/Public/attached/2018/02/12/5a8103c7ed2a08.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('11', 'test10', '', '照不完的美', '/Public/attached/2018/02/12/5a8103c7ed2a09.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('12', 'test11', '', '等颩拾裏', '/Public/attached/2018/02/12/5a8103c7ed2a10.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('13', 'test12', '', '非良人何须情深', '/Public/attached/2018/02/12/5a8103c7ed2a11.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('14', 'test13', '', '恋梦菇凉', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('15', 'test14', '', '记忆灬♚厘子', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('16', 'test15', '', '记忆灬♚厘子', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('17', 'test16', '', '记忆灬♚厘子', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('18', 'test17', '', '记忆灬♚厘子', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('19', 'test18', '', '记忆灬♚厘子', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('20', 'test19', '', '记忆灬♚厘子', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('21', 'test20', '', '记忆灬♚厘子', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('22', 'test21', '', '记忆灬♚厘子', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('23', 'test22', '', '记忆灬♚厘子', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('24', 'test23', '', '记忆灬♚厘子', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('25', 'test24', '', '记忆灬♚厘子', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('26', 'test25', '', '记忆灬♚厘子', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('27', 'test26', '', '记忆灬♚厘子', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('28', 'test27', '', '记忆灬♚厘子', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('29', 'test28', '', '记忆灬♚厘子', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('30', 'test29', '', '记忆灬♚厘子', '/Public/attached/2018/02/12/5a8103c7ed2a01.jpg', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');
INSERT INTO `zb_member` VALUES ('31', 'test30', '', '记忆灬♚厘子', '/Public/attached/2018/02/12/5a8103c7ed2a0.png', '2', '1509465600', '27', '酉鸡', '天蝎座)', '18511353013', '123456789', '123@qq.com', 'f6d080a7f6e9f62199f401715ddb37f7', '1', '黑龙江', '佳木斯', '0.00', '9999', '4', '0', '1', '1518404590', '1518404590');

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
  `class` varchar(255) NOT NULL COMMENT '等级说明',
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
INSERT INTO `zb_serve_type` VALUES ('1', '线上LOL', '/Public/home/images/wx_lol.png', '黄金以下,铂金,钻石,大师,王者', '1', '1', '1', '0', '0', '1519266177');
INSERT INTO `zb_serve_type` VALUES ('2', '线下LOL', '/Public/home/images/wx_xlol.png', '黄金以下,铂金,钻石,大师,王者', '2', '1', '1', '0', '0', null);
INSERT INTO `zb_serve_type` VALUES ('3', '王者荣耀', '/Public/home/images/wx_wzry.png', '荣耀黄金,尊贵铂金,永恒钻石,最强王者,荣耀王者,至尊星耀', '3', '1', '4', '0', '0', null);
INSERT INTO `zb_serve_type` VALUES ('4', '绝地求生', '/Public/home/images/wx_jdqs.png', '快递员,伏地魔,高级,千强,百强', '4', '1', '1', '0', '0', null);
INSERT INTO `zb_serve_type` VALUES ('5', '声优聊天', '/Public/home/images/wx_sylt.png', '新声,正式,高级,音诱', '5', '1', '1', '0', '0', null);
INSERT INTO `zb_serve_type` VALUES ('6', '荒野行动', '/Public/attached/2018/02/12/5a8101afef466.png', '新秀,中级,高级,大神', '6', '1', '1', '0', '0', '1518404017');
INSERT INTO `zb_serve_type` VALUES ('7', '哄睡觉', '/Public/home/images/wx_hs.png', '正式,高级', '7', '1', '1', '0', '0', null);
INSERT INTO `zb_serve_type` VALUES ('8', '虚拟恋人', '/Public/attached/2018/02/12/5a8101d691af1.png', '青涩,成熟,韵味', '8', '1', '2', '0', '0', '1518404060');
INSERT INTO `zb_serve_type` VALUES ('9', 'ASMR', '/Public/home/images/wx_asmr.png', '新声,正式,高级,音诱', '9', '1', '1', '0', '0', null);
INSERT INTO `zb_serve_type` VALUES ('10', '线上歌手', '/Public/home/images/wx_xsgs.png', '实习,正式,动听,天籁', '10', '1', '5', '0', '0', null);
INSERT INTO `zb_serve_type` VALUES ('11', '叫醒', '/Public/home/images/wx_jx.png', '正式,高级', '11', '1', '3', '0', '0', null);
INSERT INTO `zb_serve_type` VALUES ('12', '声音鉴定', '/Public/home/images/wx_sj.png', '正式,专业', '12', '1', '3', '0', '0', null);
INSERT INTO `zb_serve_type` VALUES ('13', '视频聊天', '/Public/attached/2018/02/12/5a8102069348b.png', '新秀,颜高,惊鸿,神', '13', '1', '1', '0', '1517588236', '1518404103');

-- ----------------------------
-- Table structure for zb_setting
-- ----------------------------
DROP TABLE IF EXISTS `zb_setting`;
CREATE TABLE `zb_setting` (
  `k` varchar(100) NOT NULL COMMENT '变量',
  `v` varchar(255) NOT NULL COMMENT '值',
  `type` tinyint(1) NOT NULL COMMENT '0系统，1自定义',
  `name` varchar(255) NOT NULL COMMENT '说明',
  `t` int(11) unsigned DEFAULT '0' COMMENT '时间',
  PRIMARY KEY (`k`),
  KEY `k` (`k`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zb_setting
-- ----------------------------
INSERT INTO `zb_setting` VALUES ('sitename', 'MANAGE', '0', '', '0');
INSERT INTO `zb_setting` VALUES ('title', '微笑前行', '0', '', '0');
INSERT INTO `zb_setting` VALUES ('keywords', '关键词', '0', '', '0');
INSERT INTO `zb_setting` VALUES ('description', '网站描述', '0', '', '0');
INSERT INTO `zb_setting` VALUES ('footer', '2016©Anchor', '0', '', '0');
INSERT INTO `zb_setting` VALUES ('access_token', '', '0', 'access_token', '0');
INSERT INTO `zb_setting` VALUES ('te', '测试', '1', '测试变量', '0');
