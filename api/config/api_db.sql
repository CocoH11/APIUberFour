CREATE TABLE IF NOT EXISTS `dishes` (
    `idDish` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `price` DECIMAL(5, 2) NOT NULL,
    `calories` INT(11) NOT NULL,
    `proteins` INT(11) NOT NULL,
    `carbs` INT(11) NOT NULL,
    PRIMARY KEY (`idDish`)
    ) ENGINE=INNODB CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `clients` (
    `idClient` INT(11) NOT NULL AUTO_INCREMENT,
    `firstName` VARCHAR(50) NOT NULL,
    `lastName` VARCHAR(50) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `dateOfBirth` DATE NOT NULL,
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
    PRIMARY KEY (`idOrder`, `idDish`),
    CONSTRAINT `fk_orders_line_orders` FOREIGN KEY (`idOrder`) REFERENCES `orders`(`idOrder`),
    CONSTRAINT `fk_orders_line_dishes` FOREIGN KEY (`idDish`) REFERENCES `dishes`(`idDish`)
) ENGINE=INNODB CHARSET=utf8;

INSERT INTO `dishes` (`idDish`, `name`, `price`, `calories`, `proteins`, `carbs`) VALUES
(1, 'Lasagne', 45, 336, 3, 5),
(2, 'Pizza', 6, 290, 47, 30),
(3, 'Merguez Nutella', 30, 4500, 2, 90);

INSERT INTO `clients` (`idClient`, `firstName`, `lastName`, `email`, `dateOfBirth`) VALUES
(1, 'jean', 'jean', 'jean@jeanmail.com', '12-12-12'),
(2, 'jack', 'sparrow', 'jackSpa@blackPearl.com', '11-11-11'),
(3, 'dori', 'jaioublier', 'dori@gsaisplus.com', '06-06-06');