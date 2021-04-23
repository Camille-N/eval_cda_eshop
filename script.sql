CREATE DATABASE IF NOT EXISTS `cda_eshop` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;

CREATE TABLE `user` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `firstName` VARCHAR(255) NOT NULL,
    `lastName` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `encryptedPassword` VARCHAR(255) NOT NULL,
    UNIQUE `user_id_unique` (`id`),
    UNIQUE `user_email_unique` (`email`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `product` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `price` VARCHAR(255) NOT NULL,
    `user_id` INT(11) UNSIGNED NOT NULL,
    UNIQUE `product_id_unique` (`id`),
    FOREIGN KEY (`user_id`) REFERENCES user(`id`)
) ENGINE = InnoDB;

INSERT INTO `product` (title, price, user_id) VALUES 
    ('Livre', '10', 1),
    ('Fleurs', '8', 1),
    ('Ordinateur', '500', 2),
    ('Radiateur', '80', 2);
