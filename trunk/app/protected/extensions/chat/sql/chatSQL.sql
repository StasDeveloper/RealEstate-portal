CREATE TABLE IF NOT EXISTS `tbl_chat` (
  `id_chat` int(11) NOT NULL AUTO_INCREMENT,
  `chat_user_id` int(11) DEFAULT NULL,
  `collocutor_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `chat_message` text,
  `chat_created` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_chat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;