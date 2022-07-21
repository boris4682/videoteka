CREATE TABLE `videohosting`.`user_groups` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `group_id` INT NOT NULL,
    `date_create` DATETIME NOT NULL,
    `date_update` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`)  REFERENCES `videohosting`.`accounts` (`id`),
    FOREIGN KEY (`group_id`)  REFERENCES `videohosting`.`groups` (`id`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_general_ci;