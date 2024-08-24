CREATE DATABASE IF NOT EXISTS `pw2_2024_stock`;

USE `pw2_2024_stock`;

-- stock_db.category definition
CREATE TABLE `category`
(
    `id`   int          NOT NULL AUTO_INCREMENT,
    `name` varchar(150) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- stock_db.product definition
CREATE TABLE `product`
(
    `id`           int          NOT NULL AUTO_INCREMENT,
    `name`         varchar(150) NOT NULL,
    `description`  varchar(150) NOT NULL,
    `price`        float        NOT NULL,
    `id_category`  int          NOT NULL,
    PRIMARY KEY (`id`),
    KEY            `id_category` (`id_category`),
    CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- stock_db.stock definition
CREATE TABLE `stock`
(
    `id`         int   NOT NULL AUTO_INCREMENT,
    `quantity`   float NOT NULL,
    `id_product` int   NOT NULL,
    PRIMARY KEY (`id`),
    KEY          `id_product` (`id_product`),
    CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- stock_db.user definition
CREATE TABLE `user`
(
    `id`       int          NOT NULL AUTO_INCREMENT,
    `name`     varchar(150) NOT NULL,
    `login`    varchar(150) NOT NULL,
    `password` varchar(150) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- stock_db.history definition
CREATE TABLE `transactions`
(
    `id`         int          NOT NULL AUTO_INCREMENT,
    `user_id`    int          NOT NULL,
    `stock_id`   int          NOT NULL,
    `product_id` int          NOT NULL,
    `datetime`   datetime     NOT NULL,
    `action`     enum('Entrada', 'Saída') NOT NULL,
    `quantity`   float        NOT NULL,
    PRIMARY KEY (`id`),
    KEY          `user_id` (`user_id`),
    KEY          `stock_id` (`stock_id`),
    KEY          `product_id` (`product_id`),
    CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
    CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`stock_id`) REFERENCES `stock` (`id`),
    CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
