<?php
	
			include("config.php");
			mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
			mysql_select_db($config["DB_NAME"]);
			

echo "admin details inserted details<br/>";
mysql_query("CREATE TABLE IF NOT EXISTS `admin_details` (
  `name` varchar(40) NOT NULL,
  `email_id` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `mobilenumber` bigint(20) NOT NULL,
  `address` text NOT NULL,
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`group_id`),
  UNIQUE KEY `email_id` (`email_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ");

?>
<?php
echo "admin details inserted details";
mysql_query("CREATE TABLE IF NOT EXISTS `class_detail` (
  `name` varchar(40) NOT NULL,
  `sections` int(11) NOT NULL,
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ");

?>
<?php
echo "admin details inserted details";
mysql_query("CREATE TABLE IF NOT EXISTS `final_class_sub_teacher` (
  `group_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `index` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`sub_id`,`class_id`,`section`),
  UNIQUE KEY `index` (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=751");

?>
<?php
echo "admin details inserted details";
mysql_query("CREATE TABLE IF NOT EXISTS `labs` (
  `name` varchar(40) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`lab_id`,`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16");

?>
<?php
echo "admin details inserted details";
mysql_query("CREATE TABLE IF NOT EXISTS `practical_combination` (
  `group_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `week_frequency` int(11) NOT NULL,
  `set` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`group_id`,`sub_id`,`class_id`),
  KEY `set` (`set`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9");

?>
<?php
echo "admin details inserted details";
mysql_query("CREATE TABLE IF NOT EXISTS `practical_details` (
  `sub_id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`sub_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

?>
<?php
echo "admin details inserted details";
mysql_query("CREATE TABLE IF NOT EXISTS `school_detail` (
  `name` varchar(40) NOT NULL,
  `address` text NOT NULL,
  `phonenumber` bigint(11) NOT NULL,
  `frequency` int(11) NOT NULL,
  `number_lectures` int(11) NOT NULL,
  `break_time` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

?>
<?php
echo "admin details inserted details";
mysql_query("CREATE TABLE IF NOT EXISTS `sub_class_teach` (
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `key` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62");

?>
<?php
echo "admin details inserted details";
mysql_query("CREATE TABLE IF NOT EXISTS `sub_detail` (
  `name` varchar(40) NOT NULL,
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `sub_load` int(11) NOT NULL,
  `sub_type` varchar(40) NOT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23");

?>
<?php
echo "admin details inserted details";
mysql_query("CREATE TABLE IF NOT EXISTS `teacher_detail` (
  `name` varchar(40) NOT NULL,
  `email_id` varchar(40) NOT NULL,
  `type_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `phonenumber` bigint(20) NOT NULL,
  `experience` int(11) NOT NULL,
  `password` varchar(40) NOT NULL,
  `group_id` int(11) NOT NULL,
  `login_type` varchar(40) NOT NULL,
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45");

?>
<?php
echo "admin details inserted details";
mysql_query("CREATE TABLE IF NOT EXISTS `teacher_load` (
  `teacher_id` int(11) NOT NULL,
  `load` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

?>
<?php
echo "admin details inserted details";
mysql_query("CREATE TABLE IF NOT EXISTS `type_details` (
  `type` varchar(40) NOT NULL,
  `week_max` int(11) NOT NULL,
  `day_max` int(11) NOT NULL,
  `cont` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10");

?>
