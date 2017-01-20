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
INSERT INTO `ba_action` VALUES (1,'首页','','App\\Http\\Controllers\\Admin','Home','home','index','am-cf',0,0,2,20160109,0),(2,'权限管理','','App\\Http\\Controllers\\Admin','Action','action','index','am-cf',0,0,2,20160109,0),(3,'操作管理','','App\\Http\\Controllers\\Admin','Action','action','index','am-cf',2,0,2,20160110,20160112),(4,'资料审核','','App\\Http\\Controllers\\Admin','Action','action','index','am-cf',0,0,2,0,20160110),(5,'供求管理','企业，设计师的','App\\Http\\Controllers\\Admin','Goods','goods','index','am-cf',0,0,2,0,20160409),(6,'角色管理','','App\\Http\\Controllers\\Admin','Role','role','index','am-cf',2,0,2,0,20160112),(7,'管理员管理','','App\\Http\\Controllers\\Admin','Admin','admin','index','am-cf',2,0,2,20160112,20160112),(8,'在线创作','','App\\Http\\Controllers\\Admin','Product','action','index','am-cf',0,0,2,20160112,20160216),(9,'系统管理','','App\\Http\\Controllers\\Admin','Action','action','index','am-cf',0,0,2,20160112,0),(10,'话题管理','','App\\Http\\Controllers\\Admin','Action','action','index','am-cf',0,0,2,20160112,0),(11,'企业功能管理','','App\\Http\\Controllers\\Admin','ComInfo','cominfo','index','am-cf',0,0,2,20160112,20160426),(12,'基本管理','','App\\Http\\Controllers\\Admin','Action','action','index','am-cf',0,0,2,20160112,20160404),(13,'消息管理','','App\\Http\\Controllers\\Admin','Message','message','index','am-cf',12,0,2,20160112,0),(14,'链接管理','','App\\Http\\Controllers\\Admin','Link','link','index','am-cf',12,0,2,20160112,0),(15,'心声管理','','App\\Http\\Controllers\\Admin','UserVoice','uservoice','index','am-cf',12,0,2,20160112,20160409),(16,'创作定制','','App\\Http\\Controllers\\Admin','OrderVideo','orderVideo','index','am-cf',45,0,1,20160113,1476606406),(17,'图片管理','','App\\Http\\Controllers\\Admin','Pic','pic','index','am-cf',12,0,1,20160113,20160411),(18,'广告管理','','App\\Http\\Controllers\\Admin','Ad','ad','index','am-cf',0,0,2,20160215,0),(19,'广告管理','','App\\Http\\Controllers\\Admin','Ad','ad','index','am-cf',18,0,2,20160215,0),(20,'广告位管理','','App\\Http\\Controllers\\Admin','AdPlace','place','index','am-cf',18,0,2,20160215,0),(21,'在线动画','','App\\Http\\Controllers\\Admin','Product','product','index','',8,0,2,20160216,1476606253),(22,'视频管理','','App\\Http\\Controllers\\Admin','Video','video','index','',12,0,1,20160216,1475741829),(23,'视频作品','制作公司，设计师的','App\\Http\\Controllers\\Admin','Goods','goods','index','',5,0,2,20160216,20160409),(24,'账务管理','','App\\Http\\Controllers\\Admin','Wallet','wallet','index','',0,0,2,20160216,1476178848),(25,'租赁管理','','App\\Http\\Controllers\\Admin','Rent','rent','index','',5,0,2,20160216,0),(26,'娱乐管理','','App\\Http\\Controllers\\Admin','Entertain','entertain','index','',5,0,2,20160216,0),(27,'设计管理','','App\\Http\\Controllers\\Admin','Design','design','index','',5,0,2,20160217,0),(28,'用户权限','','App\\Http\\Controllers\\Admin','Auths','auth','index','',2,0,1,20160217,1476845834),(29,'功能权限','','App\\Http\\Controllers\\Admin','Auths','auth','index','',2,0,2,20160217,1476948045),(30,'前台功能','','App\\Http\\Controllers\\Admin','Menus','menus','index','',2,0,2,20160229,1476861647),(31,'意见管理','','App\\Http\\Controllers\\Admin','Opinions','opinions','index','',9,0,2,20160404,1482739723),(32,'用户日志','','App\\Http\\Controllers\\Admin','Userlog','userlog','index','',9,0,2,20160407,20160411),(33,'会员管理','','App\\Http\\Controllers\\Admin','User','user','index','',4,0,2,20160411,0),(34,'地区管理','','App\\Http\\Controllers\\Admin','Area','area','index','',12,0,2,20160411,0),(35,'系统首页','','App\\Http\\Controllers\\Admin','Home','home','index','',1,0,2,20160415,1476954935),(36,'创意管理','','App\\Http\\Controllers\\Admin','Idea','idea','index','',5,0,2,20160416,0),(37,'话题列表','','App\\Http\\Controllers\\Admin','Talk','talk','index','',10,0,2,20160417,0),(38,'人员管理','','App\\Http\\Controllers\\Admin','Staff','staff','index','',5,0,2,20160423,0),(39,'企业模块','','App\\Http\\Controllers\\Admin','ComModule','commodule','index','',11,0,2,20160426,20160426),(40,'企业主体','','App\\Http\\Controllers\\Admin','ComMain','commain','index','',11,0,2,20160426,0),(41,'企业功能','','App\\Http\\Controllers\\Admin','ComFunc','comfunc','index','',11,0,2,20160426,0),(42,'访问管理','','App\\Http\\Controllers\\Admin','Visitlog','visit','index','',11,0,2,20160501,0),(43,'效果动画','','App\\Http\\Controllers\\Admin','ProductVideo','provideo','index','',8,0,2,20160502,1476606298),(44,'会员钱包','','App\\Http\\Controllers\\Admin','Wallet','wallet','index','',24,0,2,20160511,1476187152),(45,'订单管理','','App\\Http\\Controllers\\Admin','Order','order','index','',0,0,2,20160524,0),(46,'订单管理','','App\\Http\\Controllers\\Admin','Order','order','index','',45,0,2,20160524,0),(47,'售后服务','','App\\Http\\Controllers\\Admin','OrderFirm','orderfirm','index','',45,0,1,20160524,0),(48,'创作订单','','App\\Http\\Controllers\\Admin','OrderCreate','ordercre','index','',45,4,2,20160524,0),(49,'分镜管理','','App\\Http\\Controllers\\Admin','StoryBoard','storyboard','index','',5,0,2,20160524,20160524);
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
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员id',
  `uname` varchar(100) NOT NULL COMMENT '用户名称',
  `genre` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1用户记录，2管理员记录',
  `serial` varchar(20) NOT NULL COMMENT '序号，唯一标识',
  `ip` varchar(15) NOT NULL COMMENT 'ip地址',
  `ipaddress` varchar(100) NOT NULL COMMENT '管理员IP所在地',
  `action` varchar(100) NOT NULL COMMENT '访问的方法',
  `loginTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登陆时间',
  `logoutTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '退出时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8 COMMENT='管理员日志表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ba_log`
--

LOCK TABLES `ba_log` WRITE;
/*!40000 ALTER TABLE `ba_log` DISABLE KEYS */;
INSERT INTO `ba_log` VALUES (1,1,'jiuge',1,'20160908075940137','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1473292780,0),(2,1,'jiuge',1,'201609100906318268','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1473469591,0),(3,1,'jiuge',1,'201609101339029262','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1473485942,0),(4,1,'jiuge',1,'201609110851236265','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1473555083,0),(5,1,'jiuge',1,'201609120752378324','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1473637957,0),(6,1,'jiuge',1,'20160912135742704','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1473659862,0),(7,1,'jiuge',1,'201609121405091197','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1473660309,0),(8,1,'jiuge',1,'201609130751197676','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1473724279,0),(9,1,'jiuge',2,'20160913170458395','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1473757498,0),(10,1,'jiuge',2,'2016091409015949','192.168.2.101','浙江省 杭州市 滨江区','/admin/login',1473814919,0),(11,1,'jiuge',2,'201609150820596747','192.168.2.101','浙江省 杭州市 滨江区','/admin/login',1473898859,0),(12,1,'jiuge',2,'201609151505435076','192.168.2.101','浙江省 杭州市 滨江区','/admin/login',1473923143,0),(13,1,'jiuge',1,'201609151740117655','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1473932411,0),(14,1,'jiuge',1,'201609160853344212','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1473987214,1473992233),(15,2,'jiuge2',1,'201609161017314217','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1473992251,0),(16,1,'jiuge',1,'201609161738121898','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1474018692,0),(17,1,'jiuge',1,'201609191007557056','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1474250875,0),(18,1,'jiuge',1,'201609191759138230','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1474279153,0),(19,1,'jiuge',1,'20160920070913436','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1474326553,1474352679),(20,1,'jiuge',2,'201609200909427023','192.168.2.101','浙江省 杭州市 滨江区','/admin/login',1474333782,0),(21,1,'jiuge',2,'201609211100499646','192.168.2.101','浙江省 杭州市 滨江区','/admin/login',1474426849,0),(22,1,'jiuge',2,'201609220743138043','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1474501393,0),(23,1,'jiuge',1,'201609221736199194','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1474536979,0),(24,1,'jiuge',2,'201609230805417001','192.168.2.101','浙江省 杭州市 滨江区','/admin/login',1474589141,0),(25,1,'jiuge',2,'201609231340524843','192.168.2.111','浙江省 杭州市 滨江区','/admin/login',1474609252,0),(26,1,'jiuge',2,'201609232010071968','192.168.2.111','浙江省 杭州市 滨江区','/admin/login',1474632607,0),(27,1,'jiuge',2,'201609240817297850','192.168.2.101','浙江省 杭州市 滨江区','/admin/login',1474676249,0),(28,1,'jiuge',2,'201609250939037501','192.168.2.101','浙江省 杭州市 滨江区','/admin/login',1474767543,0),(29,1,'jiuge',2,'20160926075745465','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1474847865,0),(30,1,'jiuge',2,'201609270809444425','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1474934984,0),(31,1,'jiuge',1,'201609280755351702','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1475020535,0),(32,1,'jiuge',1,'201609290800268044','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1475107226,0),(33,1,'jiuge',1,'201610031445229872','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1475477122,0),(34,1,'jiuge',1,'201610041334405374','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1475559280,0),(35,1,'jiuge',1,'201610050916365410','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1475630196,0),(36,1,'jiuge',2,'201610052134316436','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1475674471,0),(37,1,'jiuge',2,'201610060945564572','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1475718356,0),(38,1,'jiuge',2,'201610070806469392','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1475798806,0),(39,1,'jiuge',1,'201610071145423919','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1475811942,0),(40,1,'jiuge',1,'201610100921332998','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1476062493,0),(41,1,'jiuge',1,'201610101448322604','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1476082112,0),(42,1,'jiuge',1,'201610102042582810','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1476103378,0),(43,1,'jiuge',1,'201610111603305622','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1476173010,1476173647),(44,1,'jiuge',1,'201610111619557356','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1476173995,0),(45,1,'jiuge',2,'20161011173509162','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1476178509,0),(46,1,'jiuge',1,'201610121120363879','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1476242436,0),(47,1,'jiuge',2,'201610121405201768','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1476252320,0),(48,1,'jiuge',1,'20161014181759165','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1476440279,0),(49,1,'jiuge',2,'201610141826039532','192.168.2.101','浙江省 杭州市 滨江区','/admin/login',1476440763,0),(50,1,'jiuge',1,'201610160855544222','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1476579354,0),(51,1,'jiuge',2,'201610161615116184','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1476605711,0),(52,1,'jiuge',2,'201610170845039963','192.168.2.101','浙江省 杭州市 滨江区','/admin/login',1476665103,0),(53,1,'jiuge',1,'201610171151245960','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1476676284,0),(54,1,'jiuge',1,'201610171442432201','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1476686563,0),(55,1,'jiuge',2,'201610171442461730','192.168.2.101','浙江省 杭州市 滨江区','/admin/login',1476686566,0),(56,1,'jiuge',1,'201610180939282936','192.168.2.102','浙江省 杭州市 滨江区','/login/dologin',1476754768,0),(57,1,'jiuge',2,'201610181051527859','192.168.2.102','浙江省 杭州市 滨江区','/admin/login',1476759112,0),(58,1,'jiuge',2,'201610181439027907','192.168.2.102','浙江省 杭州市 滨江区','/admin/login',1476772742,0),(59,1,'jiuge',2,'201610191055553757','192.168.2.102','浙江省 杭州市 滨江区','/admin/login',1476845755,0),(60,1,'jiuge',2,'201610191433408995','192.168.2.102','浙江省 杭州市 滨江区','/admin/login',1476858820,0),(61,1,'jiuge',2,'201610200810319930','192.168.2.102','浙江省 杭州市 滨江区','/admin/login',1476922231,1476936505),(62,1,'jiuge',2,'201610201208327956','192.168.2.102','浙江省 杭州市 滨江区','/admin/login',1476936512,1476936584),(63,1,'jiuge',2,'201610201209458430','192.168.2.102','浙江省 杭州市 滨江区','/admin/login',1476936585,1476936614),(64,1,'jiuge',2,'201610201210156927','192.168.2.102','浙江省 杭州市 滨江区','/admin/login',1476936615,0),(65,2,'jiuge2',1,'201611071411059067','192.168.2.102','浙江省 杭州市 滨江区','/login/dologin',1478499065,1478499468),(66,1,'jiuge',1,'201611071418043904','192.168.2.102','浙江省 杭州市 滨江区','/login/dologin',1478499484,0),(67,1,'jiuge',2,'201611092008328291','192.168.2.102','浙江省 杭州市 滨江区','/admin/login',1478693312,0),(68,1,'jiuge',2,'201611100916442558','192.168.2.102','浙江省 杭州市 滨江区','/admin/login',1478740604,0),(69,1,'jiuge',1,'201611102007533127','192.168.2.102','浙江省 杭州市 滨江区','/login/dologin',1478779673,0),(70,1,'jiuge',1,'201611110926025709','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1478827562,0),(71,1,'jiuge',1,'201611111853501017','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1478861630,0),(72,1,'jiuge',1,'201611121021011613','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1478917261,0),(73,1,'jiuge',1,'201611122020373523','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1478953237,0),(74,1,'jiuge',1,'201611131639074','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1479026347,0),(75,1,'jiuge',2,'201611131926578756','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1479036417,0),(76,1,'jiuge',1,'201611141618004605','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1479111480,0),(77,1,'jiuge',1,'201611151021221201','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1479176482,0),(78,1,'jiuge',1,'201611160950479883','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1479261047,0),(79,1,'jiuge',1,'201611170909356082','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1479344975,0),(80,1,'jiuge',1,'201611171615465151','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1479370546,0),(81,1,'jiuge',1,'201611180841271581','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1479429687,0),(82,1,'jiuge',2,'201611180901395067','192.168.2.101','浙江省 杭州市 滨江区','/admin/login',1479430899,0),(83,1,'jiuge',1,'20161122203954583','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1479818394,0),(84,1,'jiuge',1,'201611231607558134','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1479888475,0),(85,1,'jiuge',1,'201611240850339604','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1479948633,1479950107),(86,1,'jiuge',2,'201611240851031985','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1479948663,0),(87,1,'jiuge',1,'201611240915232932','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1479950123,1479950369),(88,1,'jiuge',1,'201611240923048849','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1479950584,0),(89,6,'jiuge4',1,'201612021628162626','192.168.2.101','浙江省 杭州市 滨江区','/api/v1/user/doregist',1480667296,0),(90,7,'jiuge4',1,'201612021629243932','192.168.2.101','浙江省 杭州市 滨江区','/api/v1/user/doregist',1480667364,0),(91,8,'jiuge3',1,'201612021633241279','192.168.2.101','浙江省 杭州市 滨江区','/api/v1/user/doregist',1480667604,0),(92,9,'jiuge3',1,'201612031130175881','192.168.2.100','浙江省 杭州市 滨江区','/api/v1/user/doregist',1480735817,0),(93,24,'jiuge3',1,'201612031320125386','192.168.2.100','浙江省 杭州市 滨江区','/regist/doregist',1480742412,0),(94,1,'jiuge',1,'201612031935024491','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1480764902,0),(95,1,'jiuge',2,'201612071034134899','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1481078053,0),(96,1,'jiuge',2,'201612071408432918','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1481090923,0),(97,1,'jiuge',2,'201612080837411187','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1481157461,0),(98,1,'jiuge',2,'201612081411071505','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1481177467,0),(99,1,'jiuge',2,'201612090850114960','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1481244611,0),(100,1,'jiuge',2,'201612091352049974','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1481262724,0),(101,1,'jiuge',1,'201612101145227467','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481341522,0),(102,1,'jiuge',1,'201612101413433241','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481350423,0),(103,1,'jiuge',1,'201612102049575412','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481374197,0),(104,1,'jiuge',1,'20161211114650321','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481428010,0),(105,1,'jiuge',1,'201612111620066488','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481444406,0),(106,1,'jiuge',1,'201612121642441352','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481532164,0),(107,1,'jiuge',1,'201612130853417692','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481590421,0),(108,1,'jiuge',1,'201612131403494171','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481609029,0),(109,1,'jiuge',1,'20161214095256947','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1481680376,0),(110,1,'jiuge',1,'201612141920413849','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1481714441,0),(111,1,'jiuge',1,'201612141921551707','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1481714515,0),(112,1,'jiuge',1,'201612141932363614','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1481715156,0),(113,1,'jiuge',1,'201612150926599270','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481765219,0),(114,1,'jiuge',1,'201612151602538594','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481788973,0),(115,1,'jiuge',1,'201612151700507471','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481792450,0),(116,1,'jiuge',1,'201612151705057812','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481792705,0),(117,2,'jiuge2',1,'201612151849348427','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481798974,0),(118,2,'jiuge2',1,'201612151852519109','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481799171,0),(119,1,'jiuge',1,'201612151952162646','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481802736,0),(120,1,'jiuge',1,'201612152041503853','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481805710,0),(121,1,'jiuge',1,'20161215205601943','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481806561,0),(122,1,'jiuge',1,'20161215210612803','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481807172,0),(123,1,'jiuge',1,'201612152113193191','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481807599,0),(124,1,'jiuge',1,'201612152117066425','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481807826,0),(125,1,'jiuge',1,'201612152117567668','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481807876,0),(126,1,'jiuge',1,'20161215212735462','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481808455,0),(127,1,'jiuge',1,'201612161635256446','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481877325,0),(128,1,'jiuge',1,'201612161636285888','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481877388,0),(129,1,'jiuge',1,'201612161645451264','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1481877945,0),(130,1,'jiuge',1,'20161221142622775','192.168.2.100','浙江省 杭州市 滨江区','/regist/doregist',1482301582,0),(131,1,'jiuge',1,'201612261500328006','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1482735632,0),(132,1,'jiuge',2,'201612261531134623','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1482737473,0),(133,1,'jiuge',2,'201612271525188858','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1482823518,0),(134,1,'jiuge',2,'201612272012572147','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1482840777,0),(135,1,'jiuge',2,'201612280939541455','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1482889194,0),(136,1,'jiuge',2,'2016122909312944','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1482975089,0),(137,1,'jiuge',2,'201612301012063413','192.168.2.100','浙江省 杭州市 滨江区','/admin/login',1483063926,0),(138,1,'jiuge',1,'201612301441525226','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1483080112,0),(139,1,'jiuge',1,'201612301520469202','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1483082446,0),(140,1,'jiuge',1,'201612301927332440','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1483097253,0),(141,1,'jiuge',1,'201701041427246691','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1483511244,0),(142,1,'jiuge',1,'20170104150437996','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1483513477,0),(143,1,'jiuge',1,'201701041533032890','192.168.2.101','浙江省 杭州市 滨江区','/login/dologin',1483515183,0),(144,1,'jiuge',1,'201701050911002955','192.168.2.100','浙江省 杭州市 滨江区','/login/dologin',1483578660,0),(145,1,'jiuge',2,'201701061034479051','192.168.2.101','浙江省 杭州市 滨江区','/admin/login',1483670087,1483670326),(146,1,'jiuge',2,'201701061039033960','192.168.2.101','浙江省 杭州市 滨江区','/admin/login',1483670343,0),(147,1,'jiuge',2,'201701061046232306','192.168.2.101','浙江省 杭州市 滨江区','/admin/login',1483670783,0),(148,1,'jiuge',2,'201701060735467172','192.168.2.101','浙江省 杭州市 滨江区','/admin/dologin',1483688146,1483689388),(149,1,'jiuge',2,'201701060801223652','192.168.2.101','浙江省 杭州市 滨江区','/admin/dologin',1483689682,0),(150,1,'jiuge',2,'201701070116471926','192.168.2.100','浙江省 杭州市 滨江区','/admin/dologin',1483751807,0),(151,1,'jiuge',2,'201701070120319364','192.168.2.100','浙江省 杭州市 滨江区','/admin/dologin',1483752031,0),(152,1,'jiuge',2,'201701070200263402','192.168.2.100','浙江省 杭州市 滨江区','/admin/dologin',1483754426,0),(153,1,'jiuge',2,'201701070606345476','192.168.2.100','浙江省 杭州市 滨江区','/admin/dologin',1483769194,0),(154,1,'jiuge',2,'201701070643474847','192.168.2.100','浙江省 杭州市 滨江区','/admin/dologin',1483771427,0),(155,1,'jiuge',2,'201701100327383570','192.168.2.100','浙江省 杭州市 滨江区','/admin/dologin',1484018858,0),(156,1,'jiuge',2,'2017011101382317','192.168.2.101','浙江省 杭州市 滨江区','/admin/dologin',1484098703,1484098712),(157,1,'jiuge',2,'201701110138415495','192.168.2.101','浙江省 杭州市 滨江区','/admin/dologin',1484098721,1484098724),(158,1,'jiuge',2,'201701110138527954','192.168.2.101','浙江省 杭州市 滨江区','/admin/dologin',1484098732,0),(159,1,'jiuge',2,'201701120113355053','192.168.2.101','浙江省 杭州市 滨江区','/admin/dologin',1484183615,1484183620),(160,1,'jiuge',2,'201701120113426239','192.168.2.101','浙江省 杭州市 滨江区','/admin/dologin',1484183622,0),(161,1,'jiuge',2,'201701130109349101','192.168.2.100','浙江省 杭州市 滨江区','/admin/dologin',1484269774,0),(162,1,'jiuge',2,'201701140243131199','192.168.2.101','浙江省 杭州市 滨江区','/admin/dologin',1484361793,0),(163,1,'jiuge',2,'201701141124446470','192.168.2.101','浙江省 杭州市 滨江区','/admin/dologin',1484393084,0),(164,1,'jiuge',2,'201701150321298945','192.168.2.101','浙江省 杭州市 滨江区','/admin/dologin',1484450489,0),(165,1,'jiuge',2,'2017011706102064','192.168.2.101','浙江省 杭州市 滨江区','/admin/dologin',1484633420,0),(166,1,'jiuge',2,'201701180137136296','192.168.2.101','浙江省 杭州市 滨江区','/admin/dologin',1484703433,1484710508),(167,1,'jiuge',2,'201701180335105399','192.168.2.101','浙江省 杭州市 滨江区','/admin/dologin',1484710510,0),(168,1,'jiuge',2,'20170119033752730','192.168.2.101','浙江省 杭州市 滨江区','/admin/dologin',1484797072,0),(169,1,'jiuge',2,'20170120032450811','192.168.2.100','浙江省 杭州市 滨江区','/admin/dologin',1484882690,0);
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
-- Table structure for table `bs_frield`
--

DROP TABLE IF EXISTS `bs_frield`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_frield` (
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
-- Dumping data for table `bs_frield`
--

LOCK TABLES `bs_frield` WRITE;
/*!40000 ALTER TABLE `bs_frield` DISABLE KEYS */;
INSERT INTO `bs_frield` VALUES (1,1,2,1,'000000000','',0,1481634966,1481685043,0);
/*!40000 ALTER TABLE `bs_frield` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_gold`
--

DROP TABLE IF EXISTS `bs_gold`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_gold` (
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
-- Dumping data for table `bs_gold`
--

LOCK TABLES `bs_gold` WRITE;
/*!40000 ALTER TABLE `bs_gold` DISABLE KEYS */;
INSERT INTO `bs_gold` VALUES (1,1,1,1,1482742007,0);
/*!40000 ALTER TABLE `bs_gold` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_opinions`
--

DROP TABLE IF EXISTS `bs_opinions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_opinions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '标题',
  `intro` varchar(2000) NOT NULL COMMENT '内容',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '意见状态：1新意见，2处理中，3不满意，4满意',
  `remarks` varchar(255) NOT NULL COMMENT '留言：不满意时必填',
  `isshow` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '在前台列表是否显示：1不显示，2显示，',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户意见表 (bs_opinions)：用户对本站的意见';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_opinions`
--

LOCK TABLES `bs_opinions` WRITE;
/*!40000 ALTER TABLE `bs_opinions` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_opinions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_sign`
--

DROP TABLE IF EXISTS `bs_sign`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_sign` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `reward` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '签到奖励，1--10随机',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户签到表 bs_user_sign';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_sign`
--

LOCK TABLES `bs_sign` WRITE;
/*!40000 ALTER TABLE `bs_sign` DISABLE KEYS */;
INSERT INTO `bs_sign` VALUES (1,1,3,1472121253,0),(2,1,2,1472173411,0);
/*!40000 ALTER TABLE `bs_sign` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_tip`
--

DROP TABLE IF EXISTS `bs_tip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_tip` (
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
-- Dumping data for table `bs_tip`
--

LOCK TABLES `bs_tip` WRITE;
/*!40000 ALTER TABLE `bs_tip` DISABLE KEYS */;
INSERT INTO `bs_tip` VALUES (1,1,1,200,1476175074,1476178328);
/*!40000 ALTER TABLE `bs_tip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_voices`
--

DROP TABLE IF EXISTS `bs_voices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_voices` (
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
-- Dumping data for table `bs_voices`
--

LOCK TABLES `bs_voices` WRITE;
/*!40000 ALTER TABLE `bs_voices` DISABLE KEYS */;
INSERT INTO `bs_voices` VALUES (1,'1111',1,'111','11111111',10,2,1476103976,0),(2,'nghnfgnhfgjmfg',1,'hnfgngfn','hngfnfgnfgtjndfmnn',10,2,1476440415,0),(3,'gnmgfnfgng',1,'fgmngm','ghmghmghm',10,2,1476440608,0);
/*!40000 ALTER TABLE `bs_voices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_wallet`
--

DROP TABLE IF EXISTS `bs_wallet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_wallet` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `sign` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '签到总数',
  `gold` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '金币总数，单位个：\r\n用户建议随机奖励1-5；\r\n成功的建议随机奖励10-20；',
  `tip` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '红包总数，单位元',
  `weal` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '福利，单位元：\r\n30签到兑换1元福利；\r\n10金币兑换1元福利；1红包兑换1元福利',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户钱袋(福利)表 bs_user_wallet';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_wallet`
--

LOCK TABLES `bs_wallet` WRITE;
/*!40000 ALTER TABLE `bs_wallet` DISABLE KEYS */;
INSERT INTO `bs_wallet` VALUES (1,1,5,6,200,0,1476063026,1482980941);
/*!40000 ALTER TABLE `bs_wallet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companys`
--

DROP TABLE IF EXISTS `companys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companys` (
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
  `sort` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '排序字段，值越大越靠前，默认10',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='企业表 bs_companys';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companys`
--

LOCK TABLES `companys` WRITE;
/*!40000 ALTER TABLE `companys` DISABLE KEYS */;
INSERT INTO `companys` VALUES (1,'这是广告公司',3,10,'120.157806,30.187043','杭州市滨江区滨盛路1870号','0123456789012345',1,'0571',88888888,100000,'www.jiuge.com',12345678,311301,'123@456.com',10,20160428,1473725269),(2,'',0,0,'','','',1,'0',0,0,'',0,0,'',10,1470735629,0);
/*!40000 ALTER TABLE `companys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persons`
--

DROP TABLE IF EXISTS `persons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persons` (
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
-- Dumping data for table `persons`
--

LOCK TABLES `persons` WRITE;
/*!40000 ALTER TABLE `persons` DISABLE KEYS */;
INSERT INTO `persons` VALUES (1,1,'jiuge',1,'123456789012345678','',20160410,0);
/*!40000 ALTER TABLE `persons` ENABLE KEYS */;
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
  `head` varchar(255) NOT NULL DEFAULT '' COMMENT '头像图片',
  `zfb` varchar(100) NOT NULL COMMENT '支付宝账号',
  `isauth` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '用户认证：1未认证1 ，2认证失败，2认证成功',
  `emailck` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '邮箱认证：0未认证，1认证失败，2认证成功',
  `isuser` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '会员身份：1普通用户，2个人会员，3普通企业，4设计师，5广告公司，6影视公司，7租赁公司，50超级用户',
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
INSERT INTO `users` VALUES (1,'jiuge','$2y$10$U93WQ6hOko5F.Jz0S9/F9.G44DfNjEkRx2CJXulXabRI/ICArE94S','123456','','jiuge@qq.com','946493655',63929131,4294967295,20,'滨江区 浦沿街道 联庄一区 29号 几楼','1','946493655@qq.com',3,1,50,0,1470795559,1481702547,1483578660),(2,'jiuge2','$2y$10$X5BdoH0p0n.E3hxCVag/neinTfiHXbMrCHUEEqf8ZpUQGaeOxUUBe','123456','','946493655@qq.com','',0,0,30,'','2','',3,0,50,0,1470795559,0,1481799171),(24,'jiuge3','$2y$10$1PuTTDN/g1XH9BYB2jD3mOh4pPnLwoAomgqf1nz/7suZwAmM4Z6ia','123456','192.168.2.100','','',0,0,0,'','0','',1,0,1,0,1480742412,0,1480742412);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_params`
--

DROP TABLE IF EXISTS `users_params`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_params` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `limit` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '列表每页记录数，默认10条',
  `foot_switch` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '在线创作的底部链接开关：0关闭，1开启',
  `lecloud` varchar(255) NOT NULL COMMENT '乐视云账户',
  `lepwd` varchar(255) NOT NULL COMMENT '乐视云密码',
  `leplay` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否自动播放：0手动播放，1自动播放',
  `paycode` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '支付二维码',
  `per_top_bg_img` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '个人空间顶部背景图，pic_id',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户参数表 bs_users_params';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_params`
--

LOCK TABLES `users_params` WRITE;
/*!40000 ALTER TABLE `users_params` DISABLE KEYS */;
INSERT INTO `users_params` VALUES (1,1,15,1,'946493655@qq.com','zwx4074553864',0,0,1,20160406,1481699150);
/*!40000 ALTER TABLE `users_params` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-20 15:33:22
