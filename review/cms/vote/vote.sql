create table cms.`xw_vote_activity_manage`
(
	`id`        int(11) unsigned NOT NULL AUTO_INCREMENT,
	`title` varchar(64) not null default '',
	`thumb`  varchar(128) not null default '' comment '活动横幅',
	`starttime` int(11) default 0,
	`endtime` int(11) default 0,
	`shorturl` char(16) default '',
	`status` tinyint(1) unsigned NOT NULL default 0 comment '0-未发布, 1-发布, 2-过期', 
	`content` text default '' comment'活动介绍' ,
	`extra`  text default '',
	PRIMARY KEY (`id`),
	key (`title`)
)ENGINE=myisam AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;;

--alter table `cms`.`xw_vote_activity_manage` modify  `shorturl` varchar(100) not null default '';

create table  cms.`xw_vote_candidate_manage` 
(
	`id`        int(11) unsigned NOT NULL AUTO_INCREMENT,
	`name`      varchar(64) not null default '',
	`recommender` varchar(512) not null default '' comment '推荐单位',
	`createtime` int(11) not null default 0,
	`thumb`  varchar(128) not null default '' comment '头像',
	`pics` text not null default '', 
	`content` text not null default '',
	`status` tinyint(1) unsigned NOT NULL default 1  comment '0-无效，1-正常, 2-已删除',
	PRIMARY KEY (`id`),
	key(`createtime`)
)ENGINE=myisam AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



create table cms.`xw_vote_activity_candidate_link`
(
	`id`        int(11) unsigned NOT NULL AUTO_INCREMENT,
	`actid`     int(11) unsigned NOT NULL comment '活动id',
	`candid`    int(11) unsigned NOT NULL comment '侯选人id', 
	`candname`  varchar(64) not null  comment '侯选人名字',
	`createtime` int(11) not null default 0,
	`realcount`  int(11) not null default 0 comment '真实投票',  
	`votecount`  int(11) not null default 0 comment '活动候选人投票总数',  
	PRIMARY KEY (`id`),
	key(`actid`, `candid`)
)ENGINE=myisam AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

create table cms.`xw_vote_detail`
(
	`id`        int(11) unsigned NOT NULL AUTO_INCREMENT,
	`actid`    int(11) unsigned NOT NULL,
	`candid`    int(11) unsigned NOT NULL,
	`userid`    varchar(36) not null default '',
	`islogin`   tinyint(1) unsigned NOT NULL default 0 comment '0-未登录，1-登录', 
	`deviceid`  varchar(40) not null default '',
	`useragent` varchar(40) not null default '' comment 'android or iphone',
	`channelid` varchar(40) not null default '' comment 'xw market source, ex 91_xuanwen, appstore',
	`productid` varchar(40) not null default '' comment 'xw version, ex 5.0.0',
	`created`   int(11) not null default '0' comment '投票具体时间',
	`status` TINYINT(4) not null DEFAULT '1' COMMENT '1-有效，2-删除',
	PRIMARY KEY (`id`),
	key(`actid`),
	key(`deviceid`)
)ENGINE=innodb AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


