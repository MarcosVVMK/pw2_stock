CREATE TABLE category
(
    categoryId int PRIMARY KEY,
    name       VARCHAR(32)
);

CREATE TABLE product
(
    productId   int PRIMARY KEY,
    name        VARCHAR(32),
    description VARCHAR(256),
    FOREIGN KEY (productId) REFERENCES category (categoryId),
    price       DOUBLE

);

CREATE TABLE stock
(
    stockId  int PRIMARY KEY,
    FOREIGN KEY (stockId) REFERENCES product (productId),
    quantity int
);

CREATE TABLE login
(
    loginId int PRIMARY KEY,
    name varchar(32),
    email varchar(32),
    password varchar(16)
);