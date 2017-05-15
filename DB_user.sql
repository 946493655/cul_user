-- MySQL dump 10.13  Distrib 5.6.27, for Linux (i686)
--
-- Host: localhost    Database: cul_user
-- ------------------------------------------------------
-- Server version	5.6.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ac_gold`
--

DROP TABLE IF EXISTS `ac_gold`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_gold` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `genre` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '金币奖励：\r\n1建议发布奖励，2建议评价奖励，3用户心声奖励，4订单奖励，',
  `gold` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '金币奖励个数，单位个：\r\n意见发布随机1-5个；\r\n意见评价随机10-15个；\r\n心声随机1-5个 ；\r\n订单奖励5个；',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户签到表 bs_user_sign';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_gold`
--

LOCK TABLES `ac_gold` WRITE;
/*!40000 ALTER TABLE `ac_gold` DISABLE KEYS */;
INSERT INTO `ac_gold` VALUES (1,1,1,1,1482742007,0);
/*!40000 ALTER TABLE `ac_gold` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_sign`
--

DROP TABLE IF EXISTS `ac_sign`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_sign` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `reward` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '签到奖励，1--10随机',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户签到表 bs_user_sign';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_sign`
--

LOCK TABLES `ac_sign` WRITE;
/*!40000 ALTER TABLE `ac_sign` DISABLE KEYS */;
INSERT INTO `ac_sign` VALUES (1,1,3,1472121253,0),(2,1,2,1472173411,0);
/*!40000 ALTER TABLE `ac_sign` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_tip`
--

DROP TABLE IF EXISTS `ac_tip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_tip` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '红包类型：1新人红包',
  `tip` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '额度，单位元',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户红包表 bs_user_tip';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_tip`
--

LOCK TABLES `ac_tip` WRITE;
/*!40000 ALTER TABLE `ac_tip` DISABLE KEYS */;
INSERT INTO `ac_tip` VALUES (1,1,1,200,1476175074,1476178328);
/*!40000 ALTER TABLE `ac_tip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_toweal`
--

DROP TABLE IF EXISTS `ac_toweal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_toweal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `genre` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '兑换类型：1签到兑换福利，2金币兑换福利，3红包兑换福利',
  `val` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '兑换额度',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='用户福利兑换表 bs_user_toweal';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_toweal`
--

LOCK TABLES `ac_toweal` WRITE;
/*!40000 ALTER TABLE `ac_toweal` DISABLE KEYS */;
INSERT INTO `ac_toweal` VALUES (1,1,1,3,1472121253),(2,1,1,2,1472173411),(3,1,3,100,1488336783),(4,1,3,100,1488336895);
/*!40000 ALTER TABLE `ac_toweal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_wallet`
--

DROP TABLE IF EXISTS `ac_wallet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_wallet` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `sign` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '签到总数',
  `gold` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '金币总数，单位个：',
  `tip` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '红包总数，单位元',
  `weal` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '福利，单位元：\r\n10签到兑换1元福利；\r\n30金币兑换1元福利；\r\n1红包兑换1元福利',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户钱袋(福利)表 bs_user_wallet';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_wallet`
--

LOCK TABLES `ac_wallet` WRITE;
/*!40000 ALTER TABLE `ac_wallet` DISABLE KEYS */;
INSERT INTO `ac_wallet` VALUES (1,1,5,6,200,0,1476063026,1488336949);
/*!40000 ALTER TABLE `ac_wallet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `act_users`
--

DROP TABLE IF EXISTS `act_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `act_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `act_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '活动id',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `del` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '回收站：0不删除，1删除',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='活动领取 act_users';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `act_users`
--

LOCK TABLES `act_users` WRITE;
/*!40000 ALTER TABLE `act_users` DISABLE KEYS */;
INSERT INTO `act_users` VALUES (1,0,0,0,20160423,0),(2,0,0,0,20160613,20160613),(6,0,0,0,1487149129,1488089886);
/*!40000 ALTER TABLE `act_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '活动名称',
  `genre` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '活动类型：\r\n1周期性免费，2公益专栏，\r\n3折扣不停，4套餐优惠，\r\n5分享返利，6消费返利，',
  `thumb` varchar(100) NOT NULL COMMENT '缩略图',
  `link` varchar(100) NOT NULL COMMENT '活动链接',
  `intro` varchar(500) NOT NULL COMMENT '介绍说明',
  `number` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '数量',
  `del` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '回收站：0不删除，1删除',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='活动表 activity';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity`
--

LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
INSERT INTO `activity` VALUES (1,'拿斧头男',0,'','','',0,0,20160423,0),(2,'如果它不符合',0,'','','',0,0,20160613,20160613),(6,'cscs',0,'','','',0,0,1487149129,1488089886);
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ba_action`
--

DROP TABLE IF EXISTS `ba_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ba_action` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '权限名称',
  `intro` varchar(255) DEFAULT NULL COMMENT '权限说明',
  `namespace` varchar(255) NOT NULL COMMENT '命名空间',
  `controller_prefix` varchar(255) NOT NULL DEFAULT '' COMMENT '控制器名称',
  `url` varchar(255) NOT NULL COMMENT '访问路径的部分 url',
  `action` varchar(255) NOT NULL COMMENT '操作方法名称',
  `style_class` varchar(255) NOT NULL COMMENT 'class样式名称',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序，数字越大越靠前面',
  `isshow` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '是否显示：1不显示，2显示',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COMMENT='系统管理员权限表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ba_action`
--

LOCK TABLES `ba_action` WRITE;
/*!40000 ALTER TABLE `ba_action` DISABLE KEYS */;
INSERT INTO `ba_action` VALUES (1,'首页','','App\\Http\\Controllers\\Admin','Home','home','index','am-cf',0,0,2,20160109,0),(2,'权限管理','','App\\Http\\Controllers\\Admin','Action','action','index','am-cf',0,0,2,20160109,0),(3,'操作管理','','App\\Http\\Controllers\\Admin','Action','action','index','am-cf',2,0,2,20160110,20160112),(4,'资料审核','','App\\Http\\Controllers\\Admin','Action','action','index','am-cf',0,0,2,0,20160110),(5,'供求管理','企业，设计师的','App\\Http\\Controllers\\Admin','Goods','goods','index','am-cf',0,0,2,0,20160409),(6,'角色管理','','App\\Http\\Controllers\\Admin','Role','role','index','am-cf',2,0,2,0,20160112),(7,'管理员管理','','App\\Http\\Controllers\\Admin','Admin','admin','index','am-cf',2,0,2,20160112,20160112),(8,'在线创作','','App\\Http\\Controllers\\Admin','Product','action','index','am-cf',0,0,2,20160112,20160216),(9,'系统管理','','App\\Http\\Controllers\\Admin','Action','action','index','am-cf',0,0,2,20160112,0),(10,'话题管理','','App\\Http\\Controllers\\Admin','Action','action','index','am-cf',0,0,2,20160112,0),(11,'企业功能管理','','App\\Http\\Controllers\\Admin','ComInfo','cominfo','index','am-cf',0,0,2,20160112,20160426),(12,'基本管理','','App\\Http\\Controllers\\Admin','Action','action','index','am-cf',0,0,2,20160112,20160404),(13,'消息管理','','App\\Http\\Controllers\\Admin','Message','message','index','am-cf',12,0,2,20160112,0),(14,'链接管理','','App\\Http\\Controllers\\Admin','Link','link','index','am-cf',12,0,2,20160112,0),(15,'心声管理','','App\\Http\\Controllers\\Admin','UserVoice','uservoice','index','am-cf',12,0,2,20160112,20160409),(16,'创作定制','','App\\Http\\Controllers\\Admin','OrderVideo','orderVideo','index','am-cf',45,0,1,20160113,1476606406),(17,'图片管理','','App\\Http\\Controllers\\Admin','Pic','pic','index','am-cf',12,0,1,20160113,20160411),(18,'广告管理','','App\\Http\\Controllers\\Admin','Ad','ad','index','am-cf',0,0,2,20160215,0),(19,'广告管理','','App\\Http\\Controllers\\Admin','Ad','ad','index','am-cf',18,0,2,20160215,0),(20,'广告位管理','','App\\Http\\Controllers\\Admin','AdPlace','place','index','am-cf',18,0,2,20160215,0),(21,'在线动画','','App\\Http\\Controllers\\Admin','Product','product','index','',8,0,2,20160216,1476606253),(22,'视频管理','','App\\Http\\Controllers\\Admin','Video','video','index','',12,0,1,20160216,1475741829),(23,'视频作品','制作公司，设计师的','App\\Http\\Controllers\\Admin','Goods','goods','index','',5,0,2,20160216,20160409),(24,'账务管理','','App\\Http\\Controllers\\Admin','Wallet','wallet','index','',0,0,2,20160216,1476178848),(25,'租赁管理','','App\\Http\\Controllers\\Admin','Rent','rent','index','',5,0,2,20160216,0),(26,'娱乐管理','','App\\Http\\Controllers\\Admin','Entertain','entertain','index','',5,0,2,20160216,0),(27,'设计管理','','App\\Http\\Controllers\\Admin','Design','design','index','',5,0,2,20160217,0),(28,'用户权限','','App\\Http\\Controllers\\Admin','Auths','auth','index','',2,0,1,20160217,1476845834),(29,'功能权限','','App\\Http\\Controllers\\Admin','Auths','auth','index','',2,0,2,20160217,1476948045),(30,'前台功能','','App\\Http\\Controllers\\Admin','Menus','menus','index','',2,0,2,20160229,1476861647),(31,'意见管理','','App\\Http\\Controllers\\Admin','Opinions','opinions','index','',9,0,2,20160404,1482739723),(32,'用户日志','','App\\Http\\Controllers\\Admin','Userlog','userlog','index','',9,0,2,20160407,20160411),(33,'会员管理','','App\\Http\\Controllers\\Admin','User','user','index','',4,0,2,20160411,0),(34,'地区管理','','App\\Http\\Controllers\\Admin','Area','area','index','',12,0,2,20160411,0),(35,'系统首页','','App\\Http\\Controllers\\Admin','Home','home','index','',1,0,2,20160415,1476954935),(36,'故事脚本','','App\\Http\\Controllers\\Admin','Idea','idea','index','',5,0,2,20160416,1490084761),(37,'话题列表','','App\\Http\\Controllers\\Admin','Talk','talk','index','',10,0,2,20160417,0),(38,'人员管理','','App\\Http\\Controllers\\Admin','Staff','staff','index','',5,0,2,20160423,0),(39,'企业模块','','App\\Http\\Controllers\\Admin','ComModule','commodule','index','',11,0,2,20160426,20160426),(40,'企业主体','','App\\Http\\Controllers\\Admin','ComMain','commain','index','',11,0,2,20160426,0),(41,'企业功能','','App\\Http\\Controllers\\Admin','ComFunc','comfunc','index','',11,0,2,20160426,0),(42,'访问管理','','App\\Http\\Controllers\\Admin','Visitlog','visit','index','',11,0,2,20160501,0),(43,'效果动画','','App\\Http\\Controllers\\Admin','ProductVideo','provideo','index','',8,0,2,20160502,1476606298),(44,'会员钱包','','App\\Http\\Controllers\\Admin','Wallet','wallet','index','',24,0,2,20160511,1476187152),(45,'订单管理','','App\\Http\\Controllers\\Admin','Order','order','index','',0,0,2,20160524,0),(46,'订单管理','','App\\Http\\Controllers\\Admin','Order','order','index','',45,0,2,20160524,0),(47,'售后服务','','App\\Http\\Controllers\\Admin','OrderFirm','orderfirm','index','',45,0,1,20160524,0),(48,'创作订单','','App\\Http\\Controllers\\Admin','OrderCreate','ordercre','index','',45,4,2,20160524,0),(49,'分镜管理','','App\\Http\\Controllers\\Admin','StoryBoard','storyboard','index','',5,0,1,20160524,20160524);
/*!40000 ALTER TABLE `ba_action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ba_admin`
--

DROP TABLE IF EXISTS `ba_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ba_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '管理员名称',
  `realname` varchar(50) NOT NULL COMMENT '真实名字',
  `password` varchar(255) NOT NULL COMMENT '加密过得密码',
  `pwd` varchar(50) NOT NULL COMMENT '登陆原始密码',
  `role_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员组别，关联ba_role',
  `intro` varchar(255) NOT NULL COMMENT '管理员介绍',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='系统后台管理员表（登陆者）';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ba_admin`
--

LOCK TABLES `ba_admin` WRITE;
/*!40000 ALTER TABLE `ba_admin` DISABLE KEYS */;
INSERT INTO `ba_admin` VALUES (1,'jiuge','jiuge','$2y$10$P9SN9.5CySu6AKGqSig0SO0M4cE5NMptcA8gr1GW7JfCBzEHrCiQO','jiuge',1,'',1470909119,1472215772);
/*!40000 ALTER TABLE `ba_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ba_log`
--

DROP TABLE IF EXISTS `ba_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ba_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `genre` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1用户记录www，2管理员记录www，3用户online，4管理员online，5用户talk，6管理员',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员id',
  `uname` varchar(100) NOT NULL COMMENT '用户名称',
  `serial` varchar(20) NOT NULL COMMENT '序号，唯一标识',
  `ip` varchar(15) NOT NULL COMMENT 'ip地址',
  `ipaddress` varchar(100) NOT NULL COMMENT '管理员IP所在地',
  `action` varchar(100) NOT NULL COMMENT '访问的方法',
  `loginTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登陆时间',
  `logoutTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '退出时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COMMENT='管理员日志表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ba_log`
--

LOCK TABLES `ba_log` WRITE;
/*!40000 ALTER TABLE `ba_log` DISABLE KEYS */;
INSERT INTO `ba_log` VALUES (1,3,1,'jiuge','201702071421419785','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1486448501,0),(2,3,1,'jiuge','201702080952275597','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1486518747,0),(3,4,1,'jiuge','201702080600077497','192.168.2.101','浙江省 杭州市 滨江区','/admin/dologin',1486533607,0),(4,3,1,'jiuge','201702090829371800','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1486600177,0),(5,3,1,'jiuge','201702091504539574','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1486623893,0),(6,4,1,'jiuge','201702090900508198','192.168.2.100','浙江省 杭州市 滨江区','/admin/dologin',1486630850,0),(7,3,1,'jiuge','201702100812158777','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1486685535,0),(8,1,1,'jiuge','201702141454217717','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1487055261,0),(9,1,1,'jiuge','201702141656104368','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1487062570,0),(10,1,1,'jiuge','201702150820404757','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1487118040,0),(11,1,1,'jiuge','201702160825449103','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1487204744,0),(12,2,1,'jiuge','201702222141568867','192.168.1.111','浙江省 杭州市 滨江区','/admin/login',1487770916,0),(13,2,1,'jiuge','201702242129328783','192.168.1.111','浙江省 杭州市 西湖区','/admin/login',1487942973,1487942999),(14,2,1,'jiuge','201702242132136448','192.168.1.111','浙江省 杭州市 西湖区','/admin/login',1487943133,1487943143),(15,2,1,'jiuge','201702242133472418','192.168.1.111','浙江省 杭州市 西湖区','/admin/login',1487943227,1487943456),(16,2,1,'jiuge','201702242138576148','192.168.1.111','浙江省 杭州市 西湖区','/admin/login',1487943537,1487943565),(17,2,1,'jiuge','201702242142157866','192.168.1.111','浙江省 杭州市 西湖区','/admin/login',1487943736,0),(18,2,1,'jiuge','201702250920036275','192.168.1.111','浙江省 杭州市 西湖区','/admin/login',1487985603,0),(19,2,1,'jiuge','201702251921411102','192.168.1.111','浙江省 杭州市 西湖区','/admin/login',1488021701,0),(20,2,1,'jiuge','201702270902164934','192.168.2.100','浙江省 杭州市 西湖区','/admin/login',1488157336,0),(21,2,1,'jiuge','2017022808365644','192.168.2.101','浙江省 杭州市 西湖区','/admin/login',1488242216,0),(22,2,1,'jiuge','201703010813435184','192.168.2.102','浙江省 杭州市 西湖区','/admin/login',1488327223,0),(23,2,1,'jiuge','201703020904371279','192.168.2.102','浙江省 杭州市 西湖区','/admin/login',1488416678,0),(24,2,1,'jiuge','201703030838431080','192.168.2.101','浙江省 杭州市 西湖区','/admin/login',1488501523,0),(25,2,1,'jiuge','201703040823353883','192.168.2.100','浙江省 杭州市 西湖区','/admin/login',1488587015,0),(26,2,1,'jiuge','20170306083731605','192.168.2.101','浙江省 杭州市 西湖区','/admin/login',1488760651,0),(27,2,1,'jiuge','201703070940228260','192.168.2.101','浙江省 杭州市 西湖区','/admin/login',1488850822,0),(28,2,1,'jiuge','201703080801073028','192.168.2.101','浙江省 杭州市 西湖区','/admin/login',1488931267,0),(29,2,1,'jiuge','20170308112838761','192.168.2.101','浙江省 杭州市 西湖区','/admin/login',1488943718,0),(30,2,1,'jiuge','20170309080726269','192.168.2.101','浙江省 杭州市 西湖区','/admin/login',1489018046,0),(31,2,1,'jiuge','20170309160855691','192.168.2.101','浙江省 杭州市 西湖区','/admin/login',1489046935,0),(32,2,1,'jiuge','201703100812075360','192.168.2.100','浙江省 杭州市 西湖区','/admin/login',1489104727,0),(33,3,1,'jiuge','201703131244009931','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1489380240,0),(34,3,1,'jiuge','201703131631479048','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1489393907,0),(35,3,1,'jiuge','201703140806167795','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1489449976,0),(36,2,1,'jiuge','201703140957164866','192.168.2.100','浙江省 杭州市 西湖区','/admin/login',1489456636,0),(37,3,1,'jiuge','201703160910123910','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1489626612,0),(38,3,1,'jiuge','201703161329082688','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1489642148,0),(39,3,1,'jiuge','201703170937167081','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1489714636,0),(40,3,1,'jiuge','201703171330574349','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1489728657,0),(41,3,1,'jiuge','201703200943225590','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1489974202,0),(42,3,2,'jiuge2','201703200944422066','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1489974282,0),(43,3,1,'jiuge','201703210906354770','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1490058396,0),(44,2,1,'jiuge','201703211611493076','192.168.2.100','浙江省 杭州市 西湖区','/admin/login',1490083909,0),(45,2,1,'jiuge','201703220734302425','192.168.2.101','浙江省 杭州市 西湖区','/admin/login',1490139270,0),(46,2,1,'jiuge','201703221103398977','192.168.2.101','浙江省 杭州市 西湖区','/admin/login',1490151819,0),(47,1,1,'jiuge','201703221155122619','192.168.2.101','浙江省 杭州市 西湖区','/login/dologin',1490154912,0),(48,1,1,'jiuge','201703230811086156','192.168.2.100','浙江省 杭州市 西湖区','/login/dologin',1490227868,0),(49,2,1,'jiuge','201703231121216327','192.168.2.100','浙江省 杭州市 西湖区','/admin/login',1490239281,0),(50,1,1,'jiuge','201703240740525022','192.168.2.100','浙江省 杭州市 西湖区','/login/dologin',1490312452,0),(51,1,1,'jiuge','201703270834331318','192.168.2.100','浙江省 杭州市 西湖区','/login/dologin',1490574873,0),(52,1,1,'jiuge','201703271130537677','192.168.2.100','浙江省 杭州市 西湖区','/login/dologin',1490585453,0),(53,1,1,'jiuge','201703271328458105','192.168.2.100','浙江省 杭州市 西湖区','/login/dologin',1490592525,0),(54,2,1,'jiuge','201703271429242520','192.168.2.100','浙江省 杭州市 西湖区','/admin/login',1490596164,0),(55,1,1,'jiuge','201703291621525104','192.168.2.100','浙江省 杭州市 西湖区','/login/dologin',1490775712,0),(56,1,1,'jiuge','201703300822336904','192.168.2.100','浙江省 杭州市 西湖区','/login/dologin',1490833353,0),(57,1,1,'jiuge','201703301547044166','192.168.2.100','浙江省 杭州市 西湖区','/login/dologin',1490860024,0),(58,2,1,'jiuge','201703301611123202','192.168.2.100','浙江省 杭州市 西湖区','/admin/login',1490861472,0),(59,1,1,'jiuge','201703311124069858','192.168.2.100','浙江省 杭州市 西湖区','/login/dologin',1490930646,0),(60,1,1,'jiuge','201704050926345902','192.168.2.100','浙江省 杭州市 西湖区','/login/dologin',1491355594,0),(61,1,1,'jiuge','201704141413099946','192.168.2.101','浙江省 杭州市 西湖区','/login/dologin',1492150389,0),(62,1,1,'jiuge','201704170832256403','192.168.2.101','浙江省 杭州市 西湖区','/login/dologin',1492389145,0),(63,1,1,'jiuge','201704171003529403','192.168.2.101','浙江省 杭州市 西湖区','/login/dologin',1492394632,0),(64,2,1,'jiuge','201704260836211198','192.168.2.100','浙江省 杭州市 西湖区','/admin/login',1493166981,0),(65,1,25,'jiuge4','201705150904556737','192.168.2.101','浙江省 杭州市 西湖区','/regist/doregist',1494810295,0),(66,1,27,'jiuge6','201705150912158779','192.168.2.101','浙江省 杭州市 西湖区','/regist/doregist',1494810735,0),(67,1,28,'jiuge7','201705150915575483','192.168.2.101','浙江省 杭州市 西湖区','/regist/doregist',1494810957,0),(68,1,29,'jiuge8','201705150918028670','192.168.2.101','浙江省 杭州市 西湖区','/regist/doregist',1494811082,0),(69,1,30,'jiuge9','201705150919481310','192.168.2.101','浙江省 杭州市 西湖区','/regist/doregist',1494811188,0),(70,1,29,'jiuge6','201705151028523082','192.168.2.101','浙江省 杭州市 西湖区','/regist/doregist',1494815332,0),(71,1,30,'jiuge7','201705151029497317','192.168.2.101','浙江省 杭州市 西湖区','/regist/doregist',1494815389,0),(72,1,25,'jiuge4','201705151030517367','192.168.2.101','浙江省 杭州市 西湖区','/regist/doregist',1494815451,0),(73,1,26,'jiuge5','201705151032202153','192.168.2.101','浙江省 杭州市 西湖区','/regist/doregist',1494815540,0);
/*!40000 ALTER TABLE `ba_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ba_role`
--

DROP TABLE IF EXISTS `ba_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ba_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布人adminid',
  `name` varchar(255) NOT NULL COMMENT '角色名称',
  `intro` varchar(255) NOT NULL COMMENT '角色简介',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='系统后台角色表（管理组别）';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ba_role`
--

LOCK TABLES `ba_role` WRITE;
/*!40000 ALTER TABLE `ba_role` DISABLE KEYS */;
INSERT INTO `ba_role` VALUES (1,1,'超级管理员','最高权限，本站创始人',20160405,1472213198),(2,0,'普通管理员','一般管理',1472213596,1481161075);
/*!40000 ALTER TABLE `ba_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ba_role_action`
--

DROP TABLE IF EXISTS `ba_role_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ba_role_action` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '角色ID',
  `action_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '权限ID',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COMMENT='管理组与权限对应表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ba_role_action`
--

LOCK TABLES `ba_role_action` WRITE;
/*!40000 ALTER TABLE `ba_role_action` DISABLE KEYS */;
INSERT INTO `ba_role_action` VALUES (4,1,4,1476935102,0),(5,1,5,1476935102,0),(6,1,8,1476935102,0),(7,1,9,1476935102,0),(8,1,10,1476935102,0),(9,1,11,1476935102,0),(10,1,12,1476935102,0),(11,1,18,1476935102,0),(12,1,24,1476935102,0),(13,1,45,1476935102,0),(14,1,2,1476935172,0),(15,1,1,1476945532,0),(16,1,3,1476946367,0),(17,1,6,1476946367,0),(18,1,7,1476946367,0),(19,1,28,1476946367,0),(20,1,29,1476946367,0),(21,1,30,1476946367,0),(22,1,33,1476946367,0),(23,1,23,1476946367,0),(24,1,25,1476946367,0),(25,1,26,1476946367,0),(26,1,27,1476946367,0),(27,1,36,1476946367,0),(28,1,38,1476946367,0),(29,1,49,1476946367,0),(30,1,21,1476946367,0),(31,1,43,1476946367,0),(32,1,32,1476946367,0),(33,1,35,1476946367,0),(34,1,37,1476946367,0),(35,1,39,1476946367,0),(36,1,40,1476946367,0),(37,1,41,1476946367,0),(38,1,42,1476946368,0),(39,1,13,1476946368,0),(40,1,14,1476946368,0),(41,1,15,1476946368,0),(42,1,17,1476946368,0),(43,1,22,1476946368,0),(44,1,31,1476946368,0),(45,1,34,1476946368,0),(46,1,19,1476946368,0),(47,1,20,1476946368,0),(48,1,44,1476946368,0),(49,1,16,1476946368,0),(50,1,46,1476946368,0),(51,1,47,1476946368,0),(52,1,48,1476946368,0),(53,2,1,1481179052,0),(54,2,10,1481179052,0),(55,2,45,1481179052,0);
/*!40000 ALTER TABLE `ba_role_action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_companys`
--

DROP TABLE IF EXISTS `user_companys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_companys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '公司名称',
  `genre` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '公司的类型，对应users表的isuser：3普通企业，5广告公司，6影视公司，7租赁公司',
  `area` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所在地ID',
  `point` varchar(50) NOT NULL COMMENT '地图坐标，格式 (x,y)',
  `address` varchar(255) NOT NULL COMMENT '详细地址',
  `yyzzid` varchar(255) NOT NULL COMMENT '营业执照注册码',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `areacode` varchar(4) NOT NULL DEFAULT '0' COMMENT '区号',
  `tel` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '座机',
  `qq` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '企业QQ',
  `web` varchar(255) NOT NULL COMMENT '公司官网',
  `fax` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '传真',
  `zipcode` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '邮编',
  `email` varchar(255) NOT NULL COMMENT '企业邮箱',
  `logo` varchar(255) NOT NULL COMMENT '公司logo',
  `skin` varchar(255) NOT NULL DEFAULT '' COMMENT '公司页面皮肤颜色',
  `layout` varchar(255) NOT NULL COMMENT '公司页面布局开关，0关闭，1开启：\r\nppt广告开关，\r\nservice服务开关，news新闻开关，\r\nproduct产品开关，parterner合作伙伴，\r\nintro公司简介，part花絮开关，\r\nteam团队开关，recruit招聘开关，\r\ncontact联系开关，footLink底部链接，',
  `sort` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '排序字段，值越大越靠前，默认10',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='企业表 bs_companys';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_companys`
--

LOCK TABLES `user_companys` WRITE;
/*!40000 ALTER TABLE `user_companys` DISABLE KEYS */;
INSERT INTO `user_companys` VALUES (1,'这是广告公司',3,10,'120.157806,30.187043','杭州市滨江区滨盛路1870号','0123456789012345',1,'0571',88888888,100000,'www.jiuge.com',12345678,311301,'123@456.com','','#323232','a:11:{s:3:\"ppt\";s:1:\"1\";s:7:\"service\";s:1:\"1\";s:4:\"news\";s:1:\"1\";s:7:\"product\";s:1:\"1\";s:9:\"parterner\";s:1:\"1\";s:5:\"intro\";s:1:\"1\";s:4:\"part\";s:1:\"1\";s:4:\"team\";s:1:\"1\";s:7:\"recruit\";s:1:\"1\";s:7:\"contact\";s:1:\"1\";s:8:\"footLink\";s:1:\"1\";}',10,20160428,1473725269),(2,'',0,0,'','','',1,'0',0,0,'',0,0,'','','','',10,1470735629,0);
/*!40000 ALTER TABLE `user_companys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_frield`
--

DROP TABLE IF EXISTS `user_frield`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_frield` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `frield_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '好友id',
  `isauth` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '好友验证：1申请好友，2拒绝好友，3同意好友',
  `remarks` varchar(255) NOT NULL COMMENT '申请备注',
  `remarks2` varchar(255) NOT NULL COMMENT '拒绝理由',
  `del` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '回收站：0不删除，1删除',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `authTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '验证好友的时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户好友表 bs_users_frield';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_frield`
--

LOCK TABLES `user_frield` WRITE;
/*!40000 ALTER TABLE `user_frield` DISABLE KEYS */;
INSERT INTO `user_frield` VALUES (1,1,2,1,'000000000','',0,1481634966,1481685043,0);
/*!40000 ALTER TABLE `user_frield` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_opinions`
--

DROP TABLE IF EXISTS `user_opinions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_opinions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '标题',
  `intro` varchar(500) NOT NULL COMMENT '内容',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '意见状态：1新意见，2处理中，3不满意，4满意',
  `remarks` varchar(255) NOT NULL COMMENT '留言：不满意时必填',
  `isshow` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '在前台列表是否显示：1不显示，2显示，',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户意见表 (bs_opinions)：用户对本站的意见';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_opinions`
--

LOCK TABLES `user_opinions` WRITE;
/*!40000 ALTER TABLE `user_opinions` DISABLE KEYS */;
INSERT INTO `user_opinions` VALUES (1,'意见测试测试','嘎嘎嘎灌灌灌灌灌灌灌灌灌灌\r\n00000000',1,1,'',2,1488167074,1488167291);
/*!40000 ALTER TABLE `user_opinions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_persons`
--

DROP TABLE IF EXISTS `user_persons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_persons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `realname` varchar(255) NOT NULL COMMENT '真实名称',
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '性别：1男，2女',
  `idcard` char(18) NOT NULL COMMENT '身份证号码，18位',
  `idfront` varchar(255) NOT NULL COMMENT '身份证正面照',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='个人表 bs_persons';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_persons`
--

LOCK TABLES `user_persons` WRITE;
/*!40000 ALTER TABLE `user_persons` DISABLE KEYS */;
INSERT INTO `user_persons` VALUES (1,1,'jiuge',1,'123456789012345678','',20160410,0);
/*!40000 ALTER TABLE `user_persons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_voice`
--

DROP TABLE IF EXISTS `user_voice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_voice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '心声标题',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `work` varchar(20) NOT NULL COMMENT '所在职位',
  `intro` varchar(500) NOT NULL COMMENT '心声内容',
  `sort` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '排序字段，值越大越靠前，默认10',
  `isshow` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '在前台页面是否显示：0所有，1不显示，2前台列表显示',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户心声表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_voice`
--

LOCK TABLES `user_voice` WRITE;
/*!40000 ALTER TABLE `user_voice` DISABLE KEYS */;
INSERT INTO `user_voice` VALUES (1,'1111',1,'111','11111111',10,2,1476103976,0),(2,'nghnfgnhfgjmfg',1,'hnfgngfn','hngfnfgnfgtjndfmnn',10,2,1476440415,0),(3,'gnmgfnfgng',1,'fgmngm','ghmghmghm',10,2,1476440608,1488261394);
/*!40000 ALTER TABLE `user_voice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL COMMENT '用户名称',
  `password` varchar(255) NOT NULL COMMENT '登陆密码，hash加密',
  `pwd` varchar(20) NOT NULL COMMENT '原密码',
  `ip` varchar(15) NOT NULL COMMENT '用户注册的电脑ip地址',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `qq` varchar(255) NOT NULL COMMENT 'qq号码',
  `tel` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '电话',
  `mobile` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '手机号码',
  `area` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户所在地区id',
  `address` varchar(255) NOT NULL COMMENT '用户所在具体地址',
  `head` varchar(255) NOT NULL COMMENT '头像图片',
  `spaceTopBg` varchar(255) NOT NULL COMMENT '个人空间顶部背景',
  `zfb` varchar(100) NOT NULL COMMENT '支付宝账号',
  `isauth` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '用户认证：1未认证1 ，2认证失败，2认证成功',
  `emailck` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '邮箱认证：0未认证，1认证失败，2认证成功',
  `isuser` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '会员身份：1普通用户，2个人会员，3普通企业，4设计师，5广告公司，6影视公司，7租赁公司，8设计公司，9配音公司，10广告商，50超级用户',
  `isvip` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否vip：0非VIP，1是VIP',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `lastLogin` int(10) unsigned DEFAULT '0' COMMENT '上次登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='用户表 bs_users';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'jiuge','$2y$10$U93WQ6hOko5F.Jz0S9/F9.G44DfNjEkRx2CJXulXabRI/ICArE94S','123456','','jiuge@qq.com','946493655',63929131,4294967295,20,'滨江区 浦沿街道 联庄一区 29号 几楼','http://www.jiugewenhua.com/uploads/images/2017-03-23/58d378ab35291.png','','946493655@qq.com',3,1,50,0,1470795559,1481702547,1492394632),(2,'jiuge2','$2y$10$X5BdoH0p0n.E3hxCVag/neinTfiHXbMrCHUEEqf8ZpUQGaeOxUUBe','123456','','946493655@qq.com','',0,0,30,'','','','',3,0,50,0,1470795559,0,1489974282),(24,'jiuge3','$2y$10$1PuTTDN/g1XH9BYB2jD3mOh4pPnLwoAomgqf1nz/7suZwAmM4Z6ia','123456','192.168.2.100','','',0,0,0,'','','','',1,0,1,0,1480742412,0,1480742412);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-15 16:59:24
