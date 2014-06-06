DROP TABLE IF EXISTS `teams`;
CREATE TABLE `teams` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `team1` int(11) DEFAULT 0,
    `team2` int(11) DEFAULT 0,
    `team3` int(11) DEFAULT 0,
    `team4` int(11) DEFAULT 0,
     PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `teams` (team1, team2, team3, team4) VALUES (0, 0, 0, 0);
