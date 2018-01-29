CREATE DATABASE `news` CHARACTER SET = utf8;

CREATE TABLE `members` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `password` CHAR(150) NOT NULL
);

CREATE TABLE `news` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(300) NOT NULL,
    `entry` TEXT NOT NULL,
    `date` DATETIME NOT NULL,
    `author_id` INT UNSIGNED NOT NULL
);

INSERT INTO `members` (`username`, `email`, `password`) VALUES ("test", "test@example.com",
"$2y$10$YQV7mWV1cGq4pGLP7e/Zue4bRK5DkP6a8WXfULjYOEH3Yk4al7H7a");

INSERT INTO `news` (`title`, `entry`, `date`, `author_id`) VALUES (
    "Encrypt all the things",
    "In the wake of the continued disclosures regarding government mass surveillance,
    the majority of the reform conversation has revolved around the need for increased transparency.
    However, many of these disclosures highlight the ease by which unauthorized actors
    can access large amounts of personal information without any judicial process or oversight.
    It’s time to expand the public discourse about how to properly secure data and defend privacy.",
    "2018-01-26",
    1
);

INSERT INTO `news` (`title`, `entry`, `date`, `author_id`) VALUES (
    "Lorem ipsum dolor sit amet",    
    "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus posuere, lacus eget egestas mollis,
    urna velit egestas est, commodo malesuada tellus mi eu odio. Vestibulum in est non mauris porttitor
    consectetur nec sed erat. Proin dapibus sem non nunc vehicula euismod. Sed volutpat porta eleifend.
    Proin eget elementum mauris. Morbi sit amet ligula vitae risus blandit aliquam non nec nisi.
    Integer sit amet purus tellus.",
    "2018-01-26",
    1
);

CREATE TABLE `news_authors` (
    `author_id` INT UNSIGNED NOT NULL,
    `news_id` INT UNSIGNED NOT NULL,
    
    FOREIGN KEY (`author_id`) REFERENCES `members` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
);