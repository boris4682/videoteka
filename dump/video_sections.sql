CREATE TABLE `videohosting`.`video_sections` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(500) NOT NULL,
    `date_create` DATETIME NOT NULL,
    `date_update` DATETIME NOT NULL,
    `active` BOOLEAN NOT NULL,
    `sort` INT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_general_ci;