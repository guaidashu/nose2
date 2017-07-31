
create database `nose`;

/* 创建协会招新成员记录表 crn */
create table `crn`(
	`id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键自增',
	`name` varchar(10) NOT NULL COMMENT '姓名',
	`phone` varchar(11) NOT NULL COMMENT '电话号码',
	`date` datetime NOT NULL COMMENT '提交时间',
 	`email` varchar(40) NOT NULL COMMENT 'email邮箱',
	`year` int(4) NOT NULL COMMENT '入学年份',
	`status` int(1) NOT NULL DEFAULT 0 COMMENT '用来判断是否入选，1为入选，0为未处理，2为未入选',
	`content` text NOT NULL COMMENT '自我描述',
	PRIMARY KEY(`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

/* 算法入门培训成员记录表 algorithm */
create table `algorithm`(
	`id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键自增',
	`name` varchar(10) NOT NULL COMMENT '姓名',
	`phone` varchar(11) NOT NULL COMMENT '电话号码',
	`date` datetime NOT NULL COMMENT '提交时间',
 	`email` varchar(40) NOT NULL COMMENT 'email邮箱',
	`subject` varchar(40) NOT NULL COMMENT '专业',
	PRIMARY KEY(`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

/* 用户表user */
create table `user`(
	`id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户主键',
	`name` varchar(16) NOT NULL COMMENT '姓名',
	`password` text NOT NULL COMMENT '密码',
	`phone` varchar(11) NOT NULL COMMENT '手机号码',
	`date` datetime NOT NULL COMMENT '注册日期',
	`email` varchar(40) NOT NULL COMMENT '邮箱',
	`type` int(1) NOT NULL COMMENT '用户识别，超级用户为3，管理员2，普通用户1',
	`qq_openid` text NOT NULL COMMENT 'qq_openid qq返回的唯一用户标识',
	PRIMARY KEY(`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
