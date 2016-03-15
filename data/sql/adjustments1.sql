ALTER TABLE `record` CHANGE `filename` `filename` VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;

ALTER TABLE `record` DROP FOREIGN KEY `record_ibfk_1` ;