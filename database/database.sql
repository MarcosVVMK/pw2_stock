CREATE TABLE category
(
    id INT NOT NULL AUTO_INCREMENT,
    name       VARCHAR(32)
);

CREATE TABLE product
(
    id INT NOT NULL AUTO_INCREMENT,
    name        VARCHAR(32),
    description VARCHAR(256),
    FOREIGN KEY (id_category) REFERENCES category (id),
    price       DOUBLE

);

CREATE TABLE stock
(
    id INT NOT NULL AUTO_INCREMENT,
    FOREIGN KEY (id) REFERENCES product (id),
    quantity int
);

CREATE TABLE user
(
    id INT NOT NULL AUTO_INCREMENT,
    name varchar(32),
    login varchar(32),
    password varchar(16)
);
