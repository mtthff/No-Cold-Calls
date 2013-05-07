



-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'customer'
-- 
-- ---

DROP TABLE IF EXISTS `customer`;
		
CREATE TABLE `customer` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `organisation` VARCHAR(255) NULL DEFAULT NULL,
  `street` VARCHAR(255) NULL DEFAULT NULL,
  `postcode` INTEGER NULL DEFAULT NULL,
  `city` VARCHAR(255) NULL DEFAULT NULL,
  `phone` VARCHAR(255) NULL DEFAULT NULL,
  `mobil` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'appointment'
-- 
-- ---

DROP TABLE IF EXISTS `appointment`;
		
CREATE TABLE `appointment` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `customer-id` INTEGER NULL DEFAULT NULL,
  `datetime` DATETIME NULL DEFAULT NULL,
  `contact` TIME NULL DEFAULT NULL,
  `phone` VARCHAR(255) NULL DEFAULT NULL,
  `mobil` VARCHAR(255) NULL DEFAULT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `number` INTEGER NULL DEFAULT NULL,
  `listed-date` DATE NULL DEFAULT ''0000-00-00'',
  `contributor-id` INTEGER(255) NULL DEFAULT NULL,
  `type-id` INTEGER NULL DEFAULT NULL,
  `specialized-value` MEDIUMTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'specialized'
-- 
-- ---

DROP TABLE IF EXISTS `specialized`;
		
CREATE TABLE `specialized` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `type-id` INTEGER NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'type'
-- 
-- ---

DROP TABLE IF EXISTS `type`;
		
CREATE TABLE `type` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'contributor'
-- 
-- ---

DROP TABLE IF EXISTS `contributor`;
		
CREATE TABLE `contributor` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `appointment` ADD FOREIGN KEY (customer-id) REFERENCES `customer` (`id`);
ALTER TABLE `appointment` ADD FOREIGN KEY (contributor-id) REFERENCES `contributor` (`id`);
ALTER TABLE `appointment` ADD FOREIGN KEY (type-id) REFERENCES `type` (`id`);
ALTER TABLE `specialized` ADD FOREIGN KEY (type-id) REFERENCES `type` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `customer` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `appointment` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `specialized` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `type` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `contributor` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `customer` (`id`,`organisation`,`street`,`postcode`,`city`,`phone`,`mobil`) VALUES
-- ('','','','','','','');
-- INSERT INTO `appointment` (`id`,`customer-id`,`datetime`,`contact`,`phone`,`mobil`,`email`,`number`,`listed-date`,`contributor-id`,`type-id`,`specialized-value`) VALUES
-- ('','','','','','','','','','','','');
-- INSERT INTO `specialized` (`id`,`name`,`type-id`) VALUES
-- ('','','');
-- INSERT INTO `type` (`id`,`name`) VALUES
-- ('','');
-- INSERT INTO `contributor` (`id`,`name`) VALUES
-- ('','');

