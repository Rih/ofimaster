SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `ofimaste_code` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `ofimaste_code` ;

-- -----------------------------------------------------
-- Table `ofimaste_code`.`catalog`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ofimaste_code`.`catalog` (
  `idcatalog` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(200) NULL ,
  `title` VARCHAR(45) NULL ,
  `size` INT NULL ,
  PRIMARY KEY (`idcatalog`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ofimaste_code`.`account`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ofimaste_code`.`account` (
  `idaccount` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `salt` VARCHAR(45) NOT NULL ,
  `usertype` INT NOT NULL ,
  `token` VARCHAR(45) NULL ,
  `enabled` VARCHAR(45) NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`idaccount`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ofimaste_code`.`family`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ofimaste_code`.`family` (
  `idfamily` INT NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idfamily`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ofimaste_code`.`category`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ofimaste_code`.`category` (
  `idcategory` INT NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `idfamily_fk` INT NOT NULL ,
  PRIMARY KEY (`idcategory`) ,
  INDEX `fk_category_family1_idx` (`idfamily_fk` ASC) ,
  CONSTRAINT `fk_category_family1`
    FOREIGN KEY (`idfamily_fk` )
    REFERENCES `ofimaste_code`.`family` (`idfamily` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ofimaste_code`.`subcategory`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ofimaste_code`.`subcategory` (
  `idsubcategory` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `idcategory` INT NOT NULL ,
  PRIMARY KEY (`idsubcategory`) ,
  INDEX `fk_subcategory_category1_idx` (`idcategory` ASC) ,
  CONSTRAINT `fk_subcategory_category1`
    FOREIGN KEY (`idcategory` )
    REFERENCES `ofimaste_code`.`category` (`idcategory` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ofimaste_code`.`product`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ofimaste_code`.`product` (
  `idproduct` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  `mark` VARCHAR(45) NULL ,
  `idcatalog_fk` INT NOT NULL ,
  `idcategory_fk` INT NOT NULL ,
  `idsubcategory_fk` INT NULL COMMENT ' /* comment truncated */ /*Validar category - subcategory
desde la App Web*/' ,
  PRIMARY KEY (`idproduct`) ,
  INDEX `fk_product_catalog_idx` (`idcatalog_fk` ASC) ,
  INDEX `fk_product_category1_idx` (`idcategory_fk` ASC) ,
  INDEX `fk_product_subcategory1_idx` (`idsubcategory_fk` ASC) ,
  CONSTRAINT `fk_product_catalog`
    FOREIGN KEY (`idcatalog_fk` )
    REFERENCES `ofimaste_code`.`catalog` (`idcatalog` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_category1`
    FOREIGN KEY (`idcategory_fk` )
    REFERENCES `ofimaste_code`.`category` (`idcategory` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_subcategory1`
    FOREIGN KEY (`idsubcategory_fk` )
    REFERENCES `ofimaste_code`.`subcategory` (`idsubcategory` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ofimaste_code`.`company`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ofimaste_code`.`company` (
  `idcompany` INT NOT NULL AUTO_INCREMENT ,
  `business_name` VARCHAR(30) NULL COMMENT ' /* comment truncated */ /*business_name = razon social*/' ,
  `RUT` VARCHAR(15) NULL ,
  `company_name` VARCHAR(30) NULL COMMENT ' /* comment truncated */ /*company_name = nombre fantasia*/' ,
  `line_of_business` VARCHAR(70) NULL COMMENT ' /* comment truncated */ /*line_of_business = giro*/' ,
  `contact_mail` VARCHAR(20) NULL ,
  `comments` VARCHAR(250) NULL ,
  `name_legal_rep` VARCHAR(45) NULL ,
  `RUT_legal_rep` VARCHAR(15) NULL ,
  `address_legal_rep` VARCHAR(80) NULL ,
  `comments_legal_rep` VARCHAR(250) NULL ,
  `idaccount_fk` INT NOT NULL ,
  PRIMARY KEY (`idcompany`, `idaccount_fk`) ,
  INDEX `fk_company_account1_idx` (`idaccount_fk` ASC) ,
  CONSTRAINT `fk_company_account1`
    FOREIGN KEY (`idaccount_fk` )
    REFERENCES `ofimaste_code`.`account` (`idaccount` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `ofimaste_code` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
