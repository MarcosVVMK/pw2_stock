    CREATE
    DATABASE `stock_db`;

-- stock_db.category definition

CREATE TABLE `category`
(
    `id`   int          NOT NULL AUTO_INCREMENT,
    `name` varchar(150) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- stock_db.product definition

CREATE TABLE `product`
(
    `id`           int          NOT NULL AUTO_INCREMENT,
    `name`         varchar(150) NOT NULL,
    `description`    varchar(150) NOT NULL,
    `price`        float        NOT NULL,
    `id_category` int          NOT NULL,
    PRIMARY KEY (`id`),
    KEY            `id_category` (`id_category`),
    CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- stock_db.stock definition

CREATE TABLE `stock`
(
    `id`         int   NOT NULL AUTO_INCREMENT,
    `quantity` float NOT NULL,
    `id_product` int   NOT NULL,
    PRIMARY KEY (`id`),
    KEY          `id_product` (`id_product`),
    CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- stock_db.user definition

CREATE TABLE `user`
(
    `id`    int          NOT NULL AUTO_INCREMENT,
    `name`  varchar(150) NOT NULL,
    `login` varchar(150) NOT NULL,
    `password` varchar(150) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
