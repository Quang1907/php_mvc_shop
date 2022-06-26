-- delete UNIQUE
ALTER TABLE
    cart DROP INDEX user_id;

-- add UNIQUE
ALTER TABLE
    `cart`
ADD
    INDEX(`user_id`);

-- cart
CREATE TABLE IF NOT EXISTS cart (
    id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT(10) NOT NULl UNIQUE,
    product_id INT(10) NOT NULL UNIQUE,
    quantity int NOT NULL,
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE = INNODB;

-- users 
CREATE TABLE IF NOT EXISTS users (
    id int (10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL
) ENGINE = INNODB;

-- delivery_address
CREATE TABLE IF NOT EXISTS delivery_address(
    id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT(10) NOT NULL,
    recipient TEXT NOT NULL,
    city TEXT NOT NULL,
    street TEXT NOT NULL,
    streetNumber VARCHAR(50),
    zipCode VARCHAR(50),
    FOREIGN KEY delivery_address(user_id) REFERENCES users(id)
) ENGINE = INNODB