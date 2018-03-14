/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : thinkcmf5

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-01-13 11:55:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cmf_blog_ad`
-- ----------------------------
DROP TABLE IF EXISTS `cmf_blog_ad`;
CREATE TABLE `cmf_blog_ad` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '广告ID',
  `name` char(50) DEFAULT '广告' COMMENT '广告名字',
  `link` char(200) DEFAULT '#' COMMENT '广告链接',
  `img_link` char(200) DEFAULT NULL COMMENT '广告图片',
  `list_order` int(5) NOT NULL DEFAULT '0' COMMENT '广告排列顺序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of cmf_blog_ad
-- ----------------------------
INSERT INTO `cmf_blog_ad` VALUES ('1', '阿里云服务器', '#', 'https://gss1.bdstatic.com/9vo3dSag_xI4khGkpoWK1HF6hhy/baike/w%3D268%3Bg%3D0/sign=2caeaf5892ef76c6d0d2fc2da52d9ac7/2f738bd4b31c870168f8cf9f257f9e2f0708ff79.jpg', '50');
INSERT INTO `cmf_blog_ad` VALUES ('2', '广告', '#', 'http://imgsrc.baidu.com/imgad/pic/item/cdbf6c81800a19d8a1af34d139fa828ba71e46b1.jpg', '10');
INSERT INTO `cmf_blog_ad` VALUES ('3', '广告', '111', '/upload/blog/20180105/899f7e634be8383df63cc0965ea7770d.png', '100');
INSERT INTO `cmf_blog_ad` VALUES ('4', '广告', '#', 'https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=2450994032,3525797548&fm=27&gp=0.jpg', '101');
INSERT INTO `cmf_blog_ad` VALUES ('5', '1', '2', '/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png', '10');
INSERT INTO `cmf_blog_ad` VALUES ('6', '1', '2', '/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png', '10');

-- ----------------------------
-- Table structure for `cmf_blog_article`
-- ----------------------------
DROP TABLE IF EXISTS `cmf_blog_article`;
CREATE TABLE `cmf_blog_article` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `title` char(50) NOT NULL COMMENT '文章标题',
  `introduce` char(255) DEFAULT NULL COMMENT '文章简介',
  `content` text COMMENT '文章内容',
  `create_time` int(10) DEFAULT NULL COMMENT '文章发布时间',
  `update_time` int(10) DEFAULT NULL COMMENT '文章修改时间',
  `read_times` int(5) NOT NULL DEFAULT '0' COMMENT '文章阅读次数',
  `comment_nums` int(5) DEFAULT '0' COMMENT '文章评论数量',
  `category_id` int(10) DEFAULT '0' COMMENT '文章所属类别',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of cmf_blog_article
-- ----------------------------
INSERT INTO `cmf_blog_article` VALUES ('15', '去去去', '去', '&lt;p&gt;&lt;img src=&quot;https://img.baidu.com/hi/jx2/j_0015.gif&quot;/&gt;&lt;/p&gt;', '1514638155', '1514638155', '36', '1', '23');
INSERT INTO `cmf_blog_article` VALUES ('16', '哈哈哈', '哈哈哈', '&lt;p style=&quot;text-align: right;&quot;&gt;&lt;img src=&quot;/upload/20171230/3ad9062c6af8b08b896ff36dfc637d27.png&quot; title=&quot;icon.png&quot; alt=&quot;icon.png&quot;/&gt;啊，人生啊&lt;/p&gt;', '1514640734', '1514640734', '8', '0', '22');
INSERT INTO `cmf_blog_article` VALUES ('17', '人生如此艰难ai', '人生如此艰难啊', '&lt;p&gt;哎~~~&lt;/p&gt;', '1515740912', '1515740912', '11', '0', '22');
INSERT INTO `cmf_blog_article` VALUES ('18', 'java', 'java~', '&lt;p&gt;java&lt;/p&gt;', '1515741090', '1515741090', '21', '0', '26');

-- ----------------------------
-- Table structure for `cmf_blog_category`
-- ----------------------------
DROP TABLE IF EXISTS `cmf_blog_category`;
CREATE TABLE `cmf_blog_category` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '类别ID',
  `name` char(10) NOT NULL DEFAULT '' COMMENT '类别名称',
  `parent_id` int(5) NOT NULL DEFAULT '0' COMMENT '父类别ID',
  `list_order` int(5) NOT NULL DEFAULT '0' COMMENT '优先级关系，值越大，优先级越大',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of cmf_blog_category
-- ----------------------------
INSERT INTO `cmf_blog_category` VALUES ('22', '技术相关', '0', '10');
INSERT INTO `cmf_blog_category` VALUES ('23', '人生啊', '0', '20');
INSERT INTO `cmf_blog_category` VALUES ('24', 'php', '22', '1');
INSERT INTO `cmf_blog_category` VALUES ('25', '啊啊', '23', '1');
INSERT INTO `cmf_blog_category` VALUES ('26', 'java', '22', '10');

-- ----------------------------
-- Table structure for `cmf_blog_comment`
-- ----------------------------
DROP TABLE IF EXISTS `cmf_blog_comment`;
CREATE TABLE `cmf_blog_comment` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nickname` char(20) NOT NULL DEFAULT '' COMMENT '评论者昵称',
  `content` text NOT NULL COMMENT '评论内容',
  `email` char(50) NOT NULL COMMENT '联系邮箱',
  `create_time` int(10) NOT NULL COMMENT '评论时间',
  `article_id` int(5) NOT NULL COMMENT '评论所属文章',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of cmf_blog_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `cmf_blog_info`
-- ----------------------------
DROP TABLE IF EXISTS `cmf_blog_info`;
CREATE TABLE `cmf_blog_info` (
  `id` int(5) NOT NULL COMMENT '网站信息ID',
  `blog_name` char(50) DEFAULT 'Kavience''blog' COMMENT '博客名称',
  `blog_subtitle` char(50) DEFAULT 'It''s record all my life' COMMENT '副标题',
  `copyright` char(50) DEFAULT '' COMMENT '备案信息',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of cmf_blog_info
-- ----------------------------
INSERT INTO `cmf_blog_info` VALUES ('1', 'Kavience\'blog2', 'It will record all my life', '赣ICP备17009879号');

-- ----------------------------
-- Table structure for `cmf_blog_links`
-- ----------------------------
DROP TABLE IF EXISTS `cmf_blog_links`;
CREATE TABLE `cmf_blog_links` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '友链ID',
  `name` char(20) NOT NULL DEFAULT '' COMMENT '友链名称',
  `link` varchar(200) NOT NULL DEFAULT '#' COMMENT '友链地址',
  `create_time` int(10) DEFAULT NULL COMMENT '友链创建时间',
  `list_order` int(5) NOT NULL DEFAULT '0' COMMENT '友链优先级，值越大，优先级越大',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of cmf_blog_links
-- ----------------------------
INSERT INTO `cmf_blog_links` VALUES ('7', '碧瑶', '222', '1514707813', '100');
INSERT INTO `cmf_blog_links` VALUES ('6', '张小凡', '111', '1514706193', '200');
