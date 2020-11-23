créer BDD : 
CREATE SCHEMA `projetphp` ;
CREATE TABLE `projetphp`.`tnews` (
  `idNews` INT NOT NULL AUTO_INCREMENT,
  `heure` TIME NULL,
  `site` VARCHAR(45) NULL,
  `nom` VARCHAR(100) NULL,
  `description` VARCHAR(500) NULL,
  PRIMARY KEY (`idNews`));
