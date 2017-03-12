
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
    `lost_at` DATETIME,
    `promoted_at` DATETIME,
    `contacted_at` DATETIME,
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
    `comment` TEXT,
    `created_at` DATETIME,
    PRIMARY KEY (`entity_id`),
    INDEX `enquiry_id` (`enquiry_id`),
    INDEX `staff_id` (`staff_id`),
    CONSTRAINT `enquiry_comment_ibfk_1`
        FOREIGN KEY (`enquiry_id`)
        REFERENCES `enquiry` (`entity_id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT `enquiry_comment_ibfk_2`
        FOREIGN KEY (`staff_id`)
        REFERENCES `staff` (`entity_id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- quote
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `quote`;

CREATE TABLE `quote`
(
    `entity_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `enquiry_id` int(11) unsigned,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`entity_id`),
    INDEX `enquiry_id` (`enquiry_id`),
    CONSTRAINT `quote_ibfk_1`
        FOREIGN KEY (`enquiry_id`)
        REFERENCES `enquiry` (`entity_id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- quote_item
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `quote_item`;

CREATE TABLE `quote_item`
(
    `entity_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `quote_item_group_item_id` int(11) unsigned,
    `qty` INTEGER,
    `notes` TEXT,
    `price` DECIMAL(10,2),
    PRIMARY KEY (`entity_id`),
    INDEX `quote_item_group_item_id` (`quote_item_group_item_id`),
    CONSTRAINT `quote_item_ibfk_1`
        FOREIGN KEY (`quote_item_group_item_id`)
        REFERENCES `quote_item_group_item` (`entity_id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- quote_item_group
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `quote_item_group`;

CREATE TABLE `quote_item_group`
(
    `entity_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `archived_at` DATETIME,
    PRIMARY KEY (`entity_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- quote_item_group_item
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `quote_item_group_item`;

CREATE TABLE `quote_item_group_item`
(
    `entity_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `quote_item_group_id` int(11) unsigned,
    `name` VARCHAR(255),
    `suggested_price` DECIMAL(10,2),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `archived_at` DATETIME,
    PRIMARY KEY (`entity_id`),
    INDEX `quote_item_group_id` (`quote_item_group_id`),
    CONSTRAINT `quote_item_group_item_ibfk_1`
        FOREIGN KEY (`quote_item_group_id`)
        REFERENCES `quote_item_group` (`entity_id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- staff
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `staff`;

CREATE TABLE `staff`
(
    `entity_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `email` VARCHAR(255),
    `password` VARCHAR(255),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `archived_at` DATETIME,
    PRIMARY KEY (`entity_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- viewing
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `viewing`;

CREATE TABLE `viewing`
(
    `entity_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `enquiry_id` int(11) unsigned,
    `viewing_at` DATETIME,
    `assigned_to` int(11) unsigned,
    `noshow_at` DATETIME,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`entity_id`),
    INDEX `enquiry_id` (`enquiry_id`),
    INDEX `assigned_to` (`assigned_to`),
    CONSTRAINT `viewing_ibfk_1`
        FOREIGN KEY (`enquiry_id`)
        REFERENCES `enquiry` (`entity_id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT `viewing_ibfk_2`
        FOREIGN KEY (`assigned_to`)
        REFERENCES `staff` (`entity_id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
