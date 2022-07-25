CREATE TABLE `videohosting`.`manager_groups` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `manager_id` INT NOT NULL,
    `group_id` INT NOT NULL,
    `date_create` DATETIME NOT NULL,
    `date_update` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`manager_id`)  REFERENCES `videohosting`.`accounts` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`group_id`)  REFERENCES `videohosting`.`groups` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_general_ci;