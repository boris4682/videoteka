CREATE TABLE `videohosting`.`video_history_viewed` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `video_id` INT NOT NULL,
    `date_create` DATETIME NOT NULL,
    `date_update` DATETIME NOT NULL,
    `is_viewed` BOOLEAN NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`)  REFERENCES `videohosting`.`accounts` (`id`),
    FOREIGN KEY (`video_id`)  REFERENCES `videohosting`.`video_elements` (`id`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_general_ci;