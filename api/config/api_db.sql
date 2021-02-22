DROP TABLE IF EXISTS `orders_lines`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `clients`;
DROP TABLE IF EXISTS `dishes`;

CREATE TABLE IF NOT EXISTS `dishes` (
    `idDish` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `price` DECIMAL(5, 2) NOT NULL,
    `calories` INT(11) NOT NULL,
    `proteins` INT(11) NOT NULL,
    `carbs` INT(11) NOT NULL,
    `imageURL` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`idDish`)
) ENGINE=INNODB CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `clients` (
    `idClient` INT(11) NOT NULL AUTO_INCREMENT,
    `firstName` VARCHAR(50) NOT NULL,
    `lastName` VARCHAR(50) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `dateOfBirth` DATE NOT NULL,
    `imageURL` VARCHAR(100) NOT NULL,
    `extraNapkins` BOOLEAN NOT NULL,
    `frequentRefill` BOOLEAN NOT NULL,
    PRIMARY KEY (`idClient`)
) ENGINE=INNODB CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `orders` (
    `idOrder` INT(11) NOT NULL AUTO_INCREMENT,
    `dateOrder` DATE NOT NULL,
    `totalPrice` DECIMAL(5, 2) NOT NULL,
    `idClient` INT(11) NOT NULL,
    PRIMARY KEY (`idOrder`),
    CONSTRAINT `fk_orders_clients` FOREIGN KEY (`idClient`) REFERENCES `clients` (`idClient`)
) ENGINE=INNODB CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `orders_lines` (
    `idOrder` INT(11) NOT NULL,
    `idDish` INT(11) NOT NULL,
    `quantity` INT(11) NOT NULL,
    PRIMARY KEY (`idOrder`, `idDish`),
    CONSTRAINT `fk_orders_line_orders` FOREIGN KEY (`idOrder`) REFERENCES `orders`(`idOrder`),
    CONSTRAINT `fk_orders_line_dishes` FOREIGN KEY (`idDish`) REFERENCES `dishes`(`idDish`)
) ENGINE=INNODB CHARSET=utf8;

INSERT INTO `dishes` (`idDish`, `name`, `description`, `price`, `calories`, `proteins`, `carbs`, `imageURL`) VALUES
(1, 'Lasagne', 'description Lasagne', 45, 336, 3, 5, 'http://localhost:8000/files/pictures/lasagne.jpg'),
(2, 'Pizza', 'description Pizza', 6, 290, 47, 30, 'http://localhost:8000/files/pictures/pizza.jpeg'),
(3, 'Merguez Nutella', 'description Merguez Nutella', 30, 4500, 2, 90, 'http://localhost:8000/files/pictures/merguez_nutella.jpg');

INSERT INTO `clients` (`idClient`, `firstName`, `lastName`, `email`, `dateOfBirth`, `imageURL`, `extraNapkins`, `frequentRefill`) VALUES
(1, 'jean', 'jean', 'jean@jeanmail.com', '12-12-12', 'no image', TRUE, TRUE),
(2, 'jack', 'sparrow', 'jackSpa@blackPearl.com', '11-11-11', 'http://localhost:8000/files/pictures/jack_sparrow.jpg', TRUE, FALSE),
(3, 'dori', 'jaioublier', 'dori@gsaisplus.com', '06-06-06', 'http://localhost:8000/files/pictures/dori_jaioublier.jpg', FALSE, FALSE);

INSERT INTO `orders` (`idOrder`, `dateOrder`, `totalPrice`, `idClient`) VALUES
(1, '11-11-11', 15.00, 1),
(2, '11-11-11', 16.00, 1);

INSERT INTO `orders_lines` (`idOrder`, `idDish`) VALUES
(1, 1, 1),
(1, 2, 1),
(2, 2, 1),
(2, 3, 1);