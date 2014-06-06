DROP TABLE IF EXISTS `players`;
CREATE TABLE `players` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(70) NOT NULL,
    `team` tinyint(4),
    `position` varchar(256),
    `point` int(11),
    `attack_point` int(11),
    `defense_point` int(11),
     PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
