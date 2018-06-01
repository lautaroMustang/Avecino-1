DROP DATABASE IF EXISTS pepe;
CREATE SCHEMA pepe ;
USE pepe;
DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
  `id` INT NOT NULL AUTO_INCREMENT,
  `userName` VARCHAR(50) NULL,
  `email` VARCHAR(50) NULL,
  `password` VARCHAR(45) NULL,
  `name` VARCHAR(50) NULL,
  `image` VARCHAR(120) NULL,
  PRIMARY KEY (`id`));
INSERT INTO `pepe`.`usuarios` (`userName`, `email`, `password`, `name`,`image`) VALUES ('a', 'a@a.com', 'a', 'a','a');
