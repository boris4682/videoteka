CREATE TABLE `videohosting`.`video_history_viewed` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `video_id` INT NOT NULL,
    `date_create` DATETIME NOT NULL,
    `date_update` DATETIME NOT NULL,
    `viewing_progress` FLOAT NULL,
    `last_time` INT NULL,
    `is_viewed` BOOLEAN NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`)  REFERENCES `videohosting`.`accounts` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`video_id`)  REFERENCES `videohosting`.`video_elements` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_general_ci;