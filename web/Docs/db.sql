/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.5.37-0ubuntu0.13.10.1 : Database - english_school
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`english_school` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `english_school`;

/*Table structure for table `attendance` */

DROP TABLE IF EXISTS `attendance`;

CREATE TABLE `attendance` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PRESENCE_SIGN` tinyint(1) DEFAULT NULL,
  `lessons_ID` int(11) NOT NULL,
  `person_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `idx_lessons_person` (`lessons_ID`,`person_ID`),
  KEY `fk_room_lessons1` (`lessons_ID`),
  KEY `fk_room_person1` (`person_ID`),
  CONSTRAINT `fk_room_lessons1` FOREIGN KEY (`lessons_ID`) REFERENCES `lessons` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_room_person1` FOREIGN KEY (`person_ID`) REFERENCES `persons` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `attendance` */

insert  into `attendance`(`ID`,`PRESENCE_SIGN`,`lessons_ID`,`person_ID`) values (1,0,39,3),(2,1,39,5),(3,0,40,8),(4,1,41,3),(5,0,41,5),(6,1,42,3),(7,1,42,5),(8,1,43,6),(9,1,43,7);

/*Table structure for table `group_level` */

DROP TABLE IF EXISTS `group_level`;

CREATE TABLE `group_level` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `group_level` */

insert  into `group_level`(`ID`,`NAME`) values (1,'Начинающий'),(2,'Средний'),(3,'Продвинутый');

/*Table structure for table `group_members` */

DROP TABLE IF EXISTS `group_members`;

CREATE TABLE `group_members` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `groups_ID` int(11) NOT NULL,
  `person_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `idx` (`groups_ID`,`person_ID`),
  KEY `fk_group_members_groups1` (`groups_ID`),
  KEY `fk_group_members_person1` (`person_ID`),
  CONSTRAINT `fk_group_members_groups1` FOREIGN KEY (`groups_ID`) REFERENCES `groups` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_group_members_person1` FOREIGN KEY (`person_ID`) REFERENCES `persons` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `group_members` */

insert  into `group_members`(`ID`,`groups_ID`,`person_ID`) values (1,1,3),(2,1,4),(3,1,5),(4,2,6),(5,2,7),(6,3,8);

/*Table structure for table `group_type` */

DROP TABLE IF EXISTS `group_type`;

CREATE TABLE `group_type` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `group_type` */

insert  into `group_type`(`ID`,`NAME`) values (1,'Общая'),(2,'Екзамен');

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CODE` varchar(10) DEFAULT NULL,
  `group_type_ID` int(11) NOT NULL,
  `level_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_groups_Group_type1` (`group_type_ID`),
  KEY `fk_groups_Level1` (`level_ID`),
  CONSTRAINT `fk_groups_Group_type1` FOREIGN KEY (`group_type_ID`) REFERENCES `group_type` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_groups_Level1` FOREIGN KEY (`level_ID`) REFERENCES `group_level` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `groups` */

insert  into `groups`(`ID`,`CODE`,`group_type_ID`,`level_ID`) values (1,'AA-0001',1,1),(2,'AA-0002',1,1),(3,'BB-0001',1,2);

/*Table structure for table `lessons` */

DROP TABLE IF EXISTS `lessons`;

CREATE TABLE `lessons` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LESSON_DATE` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `COMMENT` varchar(500) DEFAULT NULL,
  `DESCRIPTION` varchar(500) DEFAULT NULL,
  `person_ID` int(11) NOT NULL,
  `groups_ID` int(11) NOT NULL,
  `HOURS` decimal(4,2) DEFAULT '0.00',
  PRIMARY KEY (`ID`),
  KEY `fk_lessons_person1` (`person_ID`),
  KEY `fk_lessons_groups1` (`groups_ID`),
  CONSTRAINT `fk_lessons_groups1` FOREIGN KEY (`groups_ID`) REFERENCES `groups` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lessons_person1` FOREIGN KEY (`person_ID`) REFERENCES `persons` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

/*Data for the table `lessons` */

insert  into `lessons`(`ID`,`LESSON_DATE`,`COMMENT`,`DESCRIPTION`,`person_ID`,`groups_ID`,`HOURS`) values (39,'2011-02-14 22:30:00','Кто-то не пришел','Контрольная работа',9,1,'1.00'),(40,'2011-02-15 11:45:00','Один студент в группе, и тот не пришел','первая лекция',3,3,'1.00'),(41,'2011-02-15 07:45:00','Студенты молодцы','Старая лекция о главном',4,1,'1.50'),(42,'2011-02-15 17:15:00','Ученики очень старались','Вечернее аудирование на тему \"Как я провел зиму\"',9,1,'1.00'),(43,'2011-02-16 21:30:00','','Урок 1',9,2,'1.50');

/*Table structure for table `person_type` */

DROP TABLE IF EXISTS `person_type`;

CREATE TABLE `person_type` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) DEFAULT NULL,
  `ROLE` enum('admin','student','teacher') NOT NULL DEFAULT 'student',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `person_type` */

insert  into `person_type`(`ID`,`NAME`,`ROLE`) values (1,'Учитель','teacher'),(2,'Студент','student'),(3,'Администратор','admin');

/*Table structure for table `persons` */

DROP TABLE IF EXISTS `persons`;

CREATE TABLE `persons` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FIRST_NAME` varchar(45) DEFAULT NULL,
  `PATRONYMIC` varchar(45) DEFAULT NULL,
  `LAST_NAME` varchar(45) DEFAULT NULL,
  `person_type_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_person_person_type1` (`person_type_ID`),
  CONSTRAINT `fk_person_person_type1` FOREIGN KEY (`person_type_ID`) REFERENCES `person_type` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `persons` */

insert  into `persons`(`ID`,`FIRST_NAME`,`PATRONYMIC`,`LAST_NAME`,`person_type_ID`) values (1,'Андрей','Семенович','Соранский',1),(2,'Семен','Николаевич','Кузнецов',2),(3,'Игорь','Иванович','Бояраский',2),(4,'Алексей','Денисович','Пушкин',1),(5,'Николай','Игоревич','Сидоров',2),(6,'Олег','Олегович','Погожих',2),(7,'Петр','Андреевич','Стоянов',2),(8,'Василий','Петрович','Соврасов',2),(9,'Алексей','Игоревич','Королев',3),(10,'Антон','Петрович','Шевченко',2),(11,'Ольга','Ивановна','Корчагина',1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LOGIN` varchar(45) DEFAULT NULL,
  `PASSWORD` varchar(45) DEFAULT NULL,
  `person_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_users_person1` (`person_ID`),
  CONSTRAINT `fk_users_person1` FOREIGN KEY (`person_ID`) REFERENCES `persons` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`ID`,`LOGIN`,`PASSWORD`,`person_ID`) values (3,'alex','979f6375da8ef7f329a29feb869df52c',4),(5,'leha','202cb962ac59075b964b07152d234b70',9),(6,'admin','21232f297a57a5a743894a0e4a801fc3',9),(8,'text','d41d8cd98f00b204e9800998ecf8427e',1);

/*Table structure for table `group_member_v` */

DROP TABLE IF EXISTS `group_member_v`;

/*!50001 DROP VIEW IF EXISTS `group_member_v` */;
/*!50001 DROP TABLE IF EXISTS `group_member_v` */;

/*!50001 CREATE TABLE  `group_member_v`(
 `group_code` varchar(10) ,
 `last_naem` varchar(45) ,
 `first_name` varchar(45) ,
 `patronymic` varchar(45) ,
 `NAME` varchar(100) ,
 `groups_ID` int(11) ,
 `ID` int(11) ,
 `person_ID` int(11) 
)*/;

/*Table structure for table `groups_v` */

DROP TABLE IF EXISTS `groups_v`;

/*!50001 DROP VIEW IF EXISTS `groups_v` */;
/*!50001 DROP TABLE IF EXISTS `groups_v` */;

/*!50001 CREATE TABLE  `groups_v`(
 `ID` int(11) ,
 `CODE` varchar(10) ,
 `group_type` varchar(100) ,
 `group_level` varchar(100) ,
 `group_type_id` int(11) ,
 `group_level_id` int(11) 
)*/;

/*Table structure for table `lessons_attendance_v` */

DROP TABLE IF EXISTS `lessons_attendance_v`;

/*!50001 DROP VIEW IF EXISTS `lessons_attendance_v` */;
/*!50001 DROP TABLE IF EXISTS `lessons_attendance_v` */;

/*!50001 CREATE TABLE  `lessons_attendance_v`(
 `ID` int(11) ,
 `IFNULL(a.PRESENCE_SIGN,false)` int(4) ,
 `lesson_id` int(11) ,
 `lesson_date` datetime ,
 `group_code` varchar(10) ,
 `student_id` int(11) ,
 `student` varchar(137) ,
 `teacher_id` int(11) ,
 `teacher` varchar(137) ,
 `group_level_id` int(11) ,
 `group_level` varchar(100) ,
 `group_type_id` int(11) ,
 `group_type` varchar(100) 
)*/;

/*View structure for view group_member_v */

/*!50001 DROP TABLE IF EXISTS `group_member_v` */;
/*!50001 DROP VIEW IF EXISTS `group_member_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `group_member_v` AS select `g`.`CODE` AS `group_code`,`p`.`LAST_NAME` AS `last_naem`,`p`.`FIRST_NAME` AS `first_name`,`p`.`PATRONYMIC` AS `patronymic`,`pt`.`NAME` AS `NAME`,`dm`.`groups_ID` AS `groups_ID`,`dm`.`ID` AS `ID`,`dm`.`person_ID` AS `person_ID` from (((`group_members` `dm` left join `groups` `g` on((`dm`.`groups_ID` = `g`.`ID`))) left join `persons` `p` on((`dm`.`person_ID` = `p`.`ID`))) left join `person_type` `pt` on((`p`.`person_type_ID` = `pt`.`ID`))) order by `g`.`CODE` */;

/*View structure for view groups_v */

/*!50001 DROP TABLE IF EXISTS `groups_v` */;
/*!50001 DROP VIEW IF EXISTS `groups_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `groups_v` AS select `g`.`ID` AS `ID`,`g`.`CODE` AS `CODE`,`gt`.`NAME` AS `group_type`,`gl`.`NAME` AS `group_level`,`g`.`group_type_ID` AS `group_type_id`,`g`.`level_ID` AS `group_level_id` from ((`groups` `g` left join `group_type` `gt` on((`g`.`group_type_ID` = `gt`.`ID`))) left join `group_level` `gl` on((`g`.`level_ID` = `gl`.`ID`))) */;

/*View structure for view lessons_attendance_v */

/*!50001 DROP TABLE IF EXISTS `lessons_attendance_v` */;
/*!50001 DROP VIEW IF EXISTS `lessons_attendance_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lessons_attendance_v` AS select `a`.`ID` AS `ID`,ifnull(`a`.`PRESENCE_SIGN`,0) AS `IFNULL(a.PRESENCE_SIGN,false)`,`l`.`ID` AS `lesson_id`,`l`.`LESSON_DATE` AS `lesson_date`,`g`.`CODE` AS `group_code`,`s`.`ID` AS `student_id`,concat(`s`.`LAST_NAME`,_utf8' ',`s`.`FIRST_NAME`,_utf8' ',`s`.`PATRONYMIC`) AS `student`,`t`.`ID` AS `teacher_id`,concat(`t`.`LAST_NAME`,_utf8' ',`t`.`FIRST_NAME`,_utf8' ',`t`.`PATRONYMIC`) AS `teacher`,`gl`.`ID` AS `group_level_id`,`gl`.`NAME` AS `group_level`,`gt`.`ID` AS `group_type_id`,`gt`.`NAME` AS `group_type` from ((((((`lessons` `l` left join `attendance` `a` on((`l`.`ID` = `a`.`lessons_ID`))) left join `groups` `g` on((`l`.`groups_ID` = `g`.`ID`))) left join `persons` `s` on((`a`.`person_ID` = `s`.`ID`))) left join `persons` `t` on((`l`.`person_ID` = `t`.`ID`))) left join `group_type` `gt` on((`g`.`group_type_ID` = `gt`.`ID`))) left join `group_level` `gl` on((`g`.`level_ID` = `gl`.`ID`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
