/*
Navicat MySQL Data Transfer

Source Server         : 本机
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : tp

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2020-02-03 11:38:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_admin
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin`;
CREATE TABLE `tp_admin` (
  `id` smallint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` varchar(20) DEFAULT NULL COMMENT '管理账号',
  `password` varchar(32) DEFAULT NULL COMMENT '管理密码',
  `roleid` tinyint(4) unsigned DEFAULT '0',
  `encrypt` varchar(6) DEFAULT NULL COMMENT '加密因子',
  `nickname` char(16) NOT NULL COMMENT '昵称',
  `last_login_time` int(10) unsigned DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` char(15) NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `email` varchar(40) DEFAULT NULL COMMENT '邮箱',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of tp_admin
-- ----------------------------
INSERT INTO `tp_admin` VALUES ('1', 'admin', '9724b5e6c56b95f5723009ef81961bfe', '1', 'Wo0bAa', '管理员', '1579745413', '127.0.0.1', '1144072700@qq.com', '1');

-- ----------------------------
-- Table structure for tp_adminlog
-- ----------------------------
DROP TABLE IF EXISTS `tp_adminlog`;
CREATE TABLE `tp_adminlog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '日志ID',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `uid` smallint(3) NOT NULL DEFAULT '0' COMMENT '操作者ID',
  `info` text COMMENT '说明',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` char(15) NOT NULL DEFAULT '' COMMENT '操作IP',
  `get` varchar(255) NOT NULL DEFAULT '请求地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='操作日志';

-- ----------------------------
-- Records of tp_adminlog
-- ----------------------------

-- ----------------------------
-- Table structure for tp_menu
-- ----------------------------
DROP TABLE IF EXISTS `tp_menu`;
CREATE TABLE `tp_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '菜单ID',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `icon` varchar(64) NOT NULL DEFAULT '' COMMENT '图标',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `app` char(20) NOT NULL DEFAULT '' COMMENT '应用标识',
  `controller` char(20) NOT NULL DEFAULT '' COMMENT '控制器标识',
  `action` char(20) NOT NULL DEFAULT '' COMMENT '方法标识',
  `parameter` char(255) NOT NULL DEFAULT '' COMMENT '附加参数',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `tip` varchar(255) NOT NULL DEFAULT '' COMMENT '提示',
  `is_dev` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否开发者可见',
  `listorder` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '排序ID',
  PRIMARY KEY (`id`),
  KEY `pid` (`parentid`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COMMENT='后台菜单表';

-- ----------------------------
-- Records of tp_menu
-- ----------------------------
INSERT INTO `tp_menu` VALUES ('3', '设置', 'icon-setup', '0', 'admin', 'setting', 'index', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('4', '模块', 'icon-supply', '0', 'admin', 'module', 'index1', '', '1', '', '0', '9');
INSERT INTO `tp_menu` VALUES ('5', '扩展', 'icon-tools', '0', 'addons', 'addons', 'index1', '', '0', '', '0', '10');
INSERT INTO `tp_menu` VALUES ('10', '系统配置', 'icon-zidongxiufu', '3', 'admin', 'config', 'index1', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('11', '配置管理', 'icon-apartment', '10', 'admin', 'config', 'index', '', '0', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('12', '删除日志', '', '20', 'admin', 'adminlog', 'deletelog', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('13', '网站设置', 'icon-setup', '10', 'admin', 'config', 'setting', '', '0', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('14', '菜单管理', 'icon-other', '10', 'admin', 'menu', 'index', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('15', '权限管理', 'icon-guanliyuan', '3', 'admin', 'manager', 'index1', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('16', '管理员管理', 'icon-guanliyuan', '15', 'admin', 'manager', 'index', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('17', '角色管理', 'icon-group', '15', 'admin', 'authManager', 'index', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('18', '添加管理员', '', '16', 'admin', 'manager', 'add', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('19', '编辑管理员', '', '16', 'admin', 'manager', 'edit', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('20', '管理日志', 'icon-rizhi', '15', 'admin', 'adminlog', 'index', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('21', '删除管理员', '', '16', 'admin', 'manager', 'del', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('22', '添加角色', '', '17', 'admin', 'authManager', 'createGroup', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('23', '附件管理', 'icon-accessory', '10', 'attachment', 'attachments', 'index', '', '0', '', '0', '1');
INSERT INTO `tp_menu` VALUES ('24', '新增配置', '', '11', 'admin', 'config', 'add', '', '1', '', '0', '1');
INSERT INTO `tp_menu` VALUES ('25', '编辑配置', '', '11', 'admin', 'config', 'edit', '', '1', '', '0', '2');
INSERT INTO `tp_menu` VALUES ('26', '删除配置', '', '11', 'admin', 'config', 'del', '', '1', '', '0', '3');
INSERT INTO `tp_menu` VALUES ('27', '新增菜单', '', '14', 'admin', 'menu', 'add', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('28', '编辑菜单', '', '14', 'admin', 'menu', 'edit', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('29', '删除菜单', '', '14', 'admin', 'menu', 'delete', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('30', '附件上传', '', '23', 'attachment', 'attachments', 'upload', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('31', '附件删除', '', '23', 'attachment', 'attachments', 'delete', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('32', '编辑器附件', '', '23', 'attachment', 'ueditor', 'run', '', '0', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('33', '图片列表', '', '23', 'attachment', 'attachments', 'showFileLis', '', '0', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('34', '图片本地化', '', '23', 'attachment', 'attachments', 'getUrlFile', '', '0', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('38', '插件扩展', 'icon-tools', '5', 'addons', 'addons', 'index2', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('39', '插件管理', 'icon-plugins-', '38', 'addons', 'addons', 'index', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('40', '行为管理', 'icon-hangweifenxi', '38', 'addons', 'addons', 'hooks', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('41', '插件后台列表', 'icon-liebiaosousuo', '5', 'addons', 'addons', 'addonadmin', '', '0', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('42', '在线云平台', 'icon-cloud-download', '4', 'admin', 'cloud', 'index', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('43', '本地模块', 'icon-supply', '4', 'admin', 'module', 'index2', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('44', '模块管理', 'icon-mokuaishezhi', '43', 'admin', 'module', 'index', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('45', '模块后台列表', 'icon-liebiaosousuo', '4', 'admin', 'module', 'index', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('46', '模块商店', 'icon-caigou-xianxing', '42', 'admin', 'moduleshop', 'index', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('47', '插件商店', 'icon-caigou-xianxing', '42', 'admin', 'addonshop', 'index', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('48', '编辑角色', '', '17', 'admin', 'authManager', 'editGroup', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('49', '删除角色', '', '17', 'admin', 'authManager', 'deleteGroup', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('50', '访问授权', '', '17', 'admin', 'authManager', 'access', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('51', '角色授权', '', '17', 'admin', 'authManager', 'writeGroup', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('52', '模块安装', '', '44', 'admin', 'module', 'install', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('53', '模块卸载', '', '44', 'admin', 'module', 'uninstall', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('54', '本地安装', '', '44', 'admin', 'module', 'local', '', '1', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('55', '采集', 'icon-apartment', '0', 'collection', 'node', 'index1', '', '0', '', '0', '4');
INSERT INTO `tp_menu` VALUES ('56', '采集管理', 'icon-apartment', '55', 'collection', 'node', 'index2', '', '0', '', '0', '0');
INSERT INTO `tp_menu` VALUES ('57', '采集任务', 'icon-renwu', '56', 'collection', 'node', 'index', '', '0', '', '0', '0');
