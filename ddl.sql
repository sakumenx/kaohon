-- --------------------------------------------------------

--
-- テーブルの構造 `comment_tbl`
--

CREATE TABLE IF NOT EXISTS `comment_tbl` (
  `message_id` bigint(20) default NULL,
  `user_id` bigint(20) default NULL,
  `comment` text,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  KEY `message_id` (`message_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `friend_request_tbl`
--

CREATE TABLE IF NOT EXISTS `friend_request_tbl` (
  `user_id` bigint(20) default NULL,
  `friend_id` bigint(20) default NULL,
  `message` text,
  KEY `user_id` (`user_id`),
  KEY `friend_id` (`friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `friend_tbl`
--

CREATE TABLE IF NOT EXISTS `friend_tbl` (
  `user_id` bigint(20) default NULL,
  `friend_id` bigint(20) default NULL,
  KEY `user_id` (`user_id`),
  KEY `friend_id` (`friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `good_tbl`
--

CREATE TABLE IF NOT EXISTS `good_tbl` (
  `message_id` bigint(20) default NULL,
  `user_id` bigint(20) default NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  KEY `message_id` (`message_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `message_tbl`
--

CREATE TABLE IF NOT EXISTS `message_tbl` (
  `message_id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) default NULL,
  `message` text,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`message_id`),
  KEY `user_id` (`user_id`),
  KEY `message_id` (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `user_tbl`
--

CREATE TABLE IF NOT EXISTS `user_tbl` (
  `user_id` bigint(20) NOT NULL auto_increment,
  `user_name` varchar(20) default NULL,
  `mail_address` varchar(50) default NULL,
  `password` varchar(50) default NULL,
  `family_name` varchar(20) default NULL,
  `first_name` varchar(20) default NULL,
  `description` text,
  `image` blob,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- テーブルの制約 `comment_tbl`
--
ALTER TABLE `comment_tbl`
  ADD CONSTRAINT `comment_tbl_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `message_tbl` (`message_id`),
  ADD CONSTRAINT `comment_tbl_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`);

--
-- テーブルの制約 `friend_request_tbl`
--
ALTER TABLE `friend_request_tbl`
  ADD CONSTRAINT `friend_request_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`),
  ADD CONSTRAINT `friend_request_tbl_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `user_tbl` (`user_id`);

--
-- テーブルの制約 `friend_tbl`
--
ALTER TABLE `friend_tbl`
  ADD CONSTRAINT `friend_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`),
  ADD CONSTRAINT `friend_tbl_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `user_tbl` (`user_id`);

--
-- テーブルの制約 `good_tbl`
--
ALTER TABLE `good_tbl`
  ADD CONSTRAINT `good_tbl_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `message_tbl` (`message_id`),
  ADD CONSTRAINT `good_tbl_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`);

--
-- テーブルの制約 `message_tbl`
--
ALTER TABLE `message_tbl`
  ADD CONSTRAINT `message_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`);
