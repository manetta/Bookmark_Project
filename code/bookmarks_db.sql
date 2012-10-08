drop DATABASE if exists bookmarks;
create DATABASE bookmarks character set utf8 collate utf8_bin;
use bookmarks;

create table `users`
(
	`username` char(20) not null default '',
	`password` char(40) not null default '',
	`email` char(25) not null default '',
	`user_type` enum('A','U') not null,
	UNIQUE(`username`),
	PRIMARY KEY(`username`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table `bookmark`
(
	`bookmark_id` int not null auto_increment,
	`title` char(100) default '',
	`url` text not null,
	`description` text default '',
	`views` int(10) default '0',
	`modified` timestamp default current_timestamp,
	`user_id` char(20) not null,
	`clean` enum('yes','no') not null default 'yes',
	PRIMARY KEY(`bookmark_id`),
	CONSTRAINT `bookmarkcnst`
	FOREIGN KEY(`user_id`) 
	REFERENCES `users`(`username`)
	ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table `tags`
(
	`tag_id` int not null auto_increment,
	`bkmark_id` int not null,
	`tag` char(100) default '',
	PRIMARY KEY(`tag_id`,`bkmark_id`),
	CONSTRAINT `tagcnst`
	FOREIGN KEY(`bkmark_id`)
	REFERENCES `bookmark`(`bookmark_id`)
	ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
	

create table marks
(
	`mark_id` int not null auto_increment,
	`mark` tinyint default '0',
	`id_user` char(20) not null,
	`id_bkmark` int not null,
	PRIMARY KEY(`mark_id`),
	CONSTRAINT `markcnst`
	FOREIGN KEY(`id_user`)
	REFERENCES `users`(`username`)
	ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT `markcnstr`
	FOREIGN KEY(`id_bkmark`)
	REFERENCES `bookmark`(`bookmark_id`)
	ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table comments
(
	`commnt_id` int not null auto_increment,
	`comment` mediumtext default '',
	`person_id` char(20) not null,
	`bookmrk_id` int not null,
	`modified` timestamp default current_timestamp,
	`comment_number` int not null,
	`clean` enum('yes','no') not null default 'yes',
	PRIMARY KEY(`commnt_id`),
	CONSTRAINT `cmmcnst`
	FOREIGN KEY(`person_id`)
	REFERENCES `users`(`username`)
	ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT `commcnstr`
	FOREIGN KEY(`bookmrk_id`)
	REFERENCES `bookmark`(`bookmark_id`)
	ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;





create table contents_bkm
(
	`content_id` int not null auto_increment,
	`id_person` char(20) not null,
	`id_bookmrk` int not null,
	PRIMARY KEY(`content_id`),
	CONSTRAINT `cntcnst`
	FOREIGN KEY(`id_person`)
	REFERENCES `users`(`username`)
	ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT `cntcnstr`
	FOREIGN KEY(`id_bookmrk`)
	REFERENCES `bookmark`(`bookmark_id`)
	ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table contents_cmnt
(
	`contentcm_id` int not null auto_increment,
	`id_prsn` char(20) not null,
	`id_cmnt` int not null,
	PRIMARY KEY(`contentcm_id`),
	CONSTRAINT `cntcmcnst`
	FOREIGN KEY(`id_prsn`)
	REFERENCES `users`(`username`)
	ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT `cntcmcnstr`
	FOREIGN KEY(`id_cmnt`)
	REFERENCES `comments`(`commnt_id`)
	ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table `AutoComplete`
(
	`id` int(6) NOT NULL auto_increment,
	`val` varchar(250) NOT NULL default '',
	PRIMARY KEY(`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;




GRANT SELECT,INSERT,UPDATE,DELETE
ON bookmarks.*
TO dbauthor@localhost identified by 'password';

flush privileges;









