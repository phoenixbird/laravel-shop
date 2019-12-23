-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: homestead
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu18.04.1

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
-- Dumping data for table `admin_menu`
--


/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;
INSERT INTO `admin_menu` VALUES (1,0,1,'首页','fa-bar-chart','/',NULL,NULL,'2019-12-04 07:17:25'),(2,0,6,'系统管理','fa-tasks',NULL,NULL,NULL,'2019-12-13 04:16:17'),(3,2,7,'管理员','fa-users','auth/users',NULL,NULL,'2019-12-13 04:16:17'),(4,2,8,'角色','fa-user','auth/roles',NULL,NULL,'2019-12-13 04:16:17'),(5,2,9,'权限','fa-ban','auth/permissions',NULL,NULL,'2019-12-13 04:16:17'),(6,2,10,'菜单','fa-bars','auth/menu',NULL,NULL,'2019-12-13 04:16:17'),(7,2,11,'操作日志','fa-history','auth/logs',NULL,NULL,'2019-12-13 04:16:17'),(8,0,2,'用户管理','fa-users','/users',NULL,'2019-12-04 08:17:29','2019-12-04 09:21:10'),(9,0,3,'商品管理','fa-cubes','/products',NULL,'2019-12-04 09:20:02','2019-12-04 09:21:10'),(10,0,4,'订单管理','fa-rmb','/orders',NULL,'2019-12-10 09:00:16','2019-12-10 09:04:12'),(11,0,5,'优惠券管理','fa-tag','/coupon_codes',NULL,'2019-12-13 04:08:46','2019-12-13 04:16:17');
/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;


--
-- Dumping data for table `admin_permissions`
--


/*!40000 ALTER TABLE `admin_permissions` DISABLE KEYS */;
INSERT INTO `admin_permissions` VALUES (1,'All permission','*','','*',NULL,NULL),(2,'Dashboard','dashboard','GET','/',NULL,NULL),(3,'Login','auth.login','','/auth/login\r\n/auth/logout',NULL,NULL),(4,'User setting','auth.setting','GET,PUT','/auth/setting',NULL,NULL),(5,'Auth management','auth.management','','/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs',NULL,NULL),(6,'用户管理','users','','/users*','2019-12-04 08:26:45','2019-12-04 08:26:45'),(7,'商品管理01','products','','/products*','2019-12-20 13:30:51','2019-12-20 13:30:51'),(8,'优惠券管理02','coupon_codes','','/coupon_codes*','2019-12-20 13:32:25','2019-12-20 13:32:25'),(9,'订单管理03','orders','','/orders*','2019-12-20 13:34:36','2019-12-20 13:35:38');
/*!40000 ALTER TABLE `admin_permissions` ENABLE KEYS */;


--
-- Dumping data for table `admin_role_menu`
--


/*!40000 ALTER TABLE `admin_role_menu` DISABLE KEYS */;
INSERT INTO `admin_role_menu` VALUES (1,2,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_menu` ENABLE KEYS */;


--
-- Dumping data for table `admin_role_permissions`
--


/*!40000 ALTER TABLE `admin_role_permissions` DISABLE KEYS */;
INSERT INTO `admin_role_permissions` VALUES (1,1,NULL,NULL),(2,2,NULL,NULL),(2,3,NULL,NULL),(2,4,NULL,NULL),(2,6,NULL,NULL),(2,7,NULL,NULL),(2,8,NULL,NULL),(2,9,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_permissions` ENABLE KEYS */;


--
-- Dumping data for table `admin_role_users`
--


/*!40000 ALTER TABLE `admin_role_users` DISABLE KEYS */;
INSERT INTO `admin_role_users` VALUES (1,1,NULL,NULL),(2,2,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_users` ENABLE KEYS */;


--
-- Dumping data for table `admin_roles`
--


/*!40000 ALTER TABLE `admin_roles` DISABLE KEYS */;
INSERT INTO `admin_roles` VALUES (1,'Administrator','administrator','2019-12-04 03:53:57','2019-12-04 03:53:57'),(2,'运营','operation','2019-12-04 08:30:11','2019-12-04 08:30:11');
/*!40000 ALTER TABLE `admin_roles` ENABLE KEYS */;


--
-- Dumping data for table `admin_user_permissions`
--


/*!40000 ALTER TABLE `admin_user_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_user_permissions` ENABLE KEYS */;


--
-- Dumping data for table `admin_users`
--


/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` VALUES (1,'admin','$2y$10$pXoM8QSQ/HeZ.wftqpaMfe1HUHXMeBL1w8k8Uz.syW8fdS1TgSGZe','Administrator',NULL,'1lSjbcxo8RKgjEAdHPkcso2r80GOrbZYlUz4xY00qNkUmec4p6lE4F6OMUA1','2019-12-04 03:53:57','2019-12-04 03:53:57'),(2,'operator','$2y$10$/D0PFebgViAcXSQVKgvFm.dj.V9OFu.7bcJUBKtEaYWVBt6G3/DAW','运营者',NULL,'YKrPcXMgIBC0DFtf1Dk3MiZ3FZFQCza2DBDfOc3wi9HXYbL34YSOY5mmFBJp','2019-12-04 08:39:23','2019-12-04 08:39:23');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-20 23:00:04
