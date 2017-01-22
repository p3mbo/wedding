
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- enquiry
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `enquiry`;

CREATE TABLE `enquiry`
(
    `entity_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(35),
    `name` VARCHAR(255),
    `partner_name` VARCHAR(255),
    `email` VARCHAR(255),
    `telephone` VARCHAR(255),
    `mobile` VARCHAR(255),
    `address` TEXT,
    `day_guests` int(11) unsigned DEFAULT 0,
    `evening_guests` int(11) unsigned DEFAULT 0,
    `year` VARCHAR(255),
    `budget` DECIMAL(10,2),
    `heard` VARCHAR(255),
    `comment` VARCHAR(255),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`entity_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- enquiry_comment
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `enquiry_comment`;

CREATE TABLE `enquiry_comment`
(
    `entity_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `enquiry_id` int(11) unsigned,
    `staff_id` int(11) unsigned,
    `created_at` DATETIME,
    PRIMARY KEY (`entity_id`),
    INDEX `enquiry_id` (`enquiry_id`),
    CONSTRAINT `enquiry_comment_ibfk_1`
        FOREIGN KEY (`enquiry_id`)
        REFERENCES `enquiry` (`entity_id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
