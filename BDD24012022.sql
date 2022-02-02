-- MySQL Script generated by MySQL Workbench
-- Mon Jan 24 15:32:13 2022
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema menuiz
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema menuiz
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `menuiz` DEFAULT CHARACTER SET latin1 ;
USE `menuiz` ;

-- -----------------------------------------------------
-- Table `menuiz`.`t_d_address_adr`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menuiz`.`t_d_address_adr` ;

CREATE TABLE IF NOT EXISTS `menuiz`.`t_d_address_adr` (
  `ADR_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `ADR_DENOMINATION` VARCHAR(255) NOT NULL,
  `ADR_LINE1` VARCHAR(255) NOT NULL,
  `ADR_LINE2` VARCHAR(255) NULL DEFAULT NULL,
  `ADR_LINE3` VARCHAR(255) NULL DEFAULT NULL,
  `ADR_ZIPCODE` INT(11) NOT NULL,
  `ADR_CITY` VARCHAR(255) NOT NULL,
  `ADR_COUNTRY` VARCHAR(255) NOT NULL,
  `ADR_STATE` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`ADR_ID`))
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = latin1;

CREATE UNIQUE INDEX `ADR_ID_UNIQUE` ON `menuiz`.`t_d_address_adr` (`ADR_ID` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `menuiz`.`t_d_mode_expedition_men`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menuiz`.`t_d_mode_expedition_men` ;

CREATE TABLE IF NOT EXISTS `menuiz`.`t_d_mode_expedition_men` (
  `MEN_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `MEN_DESC` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`MEN_ID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE UNIQUE INDEX `MEN_ID_UNIQUE` ON `menuiz`.`t_d_mode_expedition_men` (`MEN_ID` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `menuiz`.`t_d_mode_payment_mpt`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menuiz`.`t_d_mode_payment_mpt` ;

CREATE TABLE IF NOT EXISTS `menuiz`.`t_d_mode_payment_mpt` (
  `MPT_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `MPT_DESC` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`MPT_ID`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;

CREATE UNIQUE INDEX `MPT_ID_UNIQUE` ON `menuiz`.`t_d_mode_payment_mpt` (`MPT_ID` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `menuiz`.`t_d_order_status_oss`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menuiz`.`t_d_order_status_oss` ;

CREATE TABLE IF NOT EXISTS `menuiz`.`t_d_order_status_oss` (
  `OSS_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `OSS_DESC` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`OSS_ID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE UNIQUE INDEX `OSS_ID_UNIQUE` ON `menuiz`.`t_d_order_status_oss` (`OSS_ID` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `menuiz`.`t_d_orderheader_ohr`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menuiz`.`t_d_orderheader_ohr` ;

CREATE TABLE IF NOT EXISTS `menuiz`.`t_d_orderheader_ohr` (
  `OHR_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `OHR_DATE` DATE NOT NULL,
  `OHR_ORDERNUMBER` VARCHAR(255) NULL DEFAULT NULL,
  `OHR_DELIVERYPHONE` VARCHAR(20) NULL DEFAULT NULL,
  `OHR_TOTALHT` DECIMAL(8,2) NULL DEFAULT NULL,
  `OHR_TOTALTTC` DECIMAL(8,2) NULL DEFAULT NULL,
  `OHR_ID_PAYMODE` INT(11) NOT NULL,
  `OHR_OSS_ID` INT(11) NOT NULL,
  `OHR_ADR_ID_PAYMENT` INT(11) NOT NULL,
  PRIMARY KEY (`OHR_ID`),
  CONSTRAINT `fk_t_d_orderheader_ohr_t_d_mode_payment_mpt1`
    FOREIGN KEY (`OHR_ID_PAYMODE`)
    REFERENCES `menuiz`.`t_d_mode_payment_mpt` (`MPT_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_t_d_orderheader_ohr_t_d_order_status_oss1`
    FOREIGN KEY (`OHR_OSS_ID`)
    REFERENCES `menuiz`.`t_d_order_status_oss` (`OSS_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_t_d_orderheader_ohr_t_d_address_adr1`
    FOREIGN KEY (`OHR_ADR_ID_PAYMENT`)
    REFERENCES `menuiz`.`t_d_address_adr` (`ADR_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE INDEX `fk_t_d_orderheader_ohr_t_d_mode_payment_mpt1_idx` ON `menuiz`.`t_d_orderheader_ohr` (`OHR_ID_PAYMODE` ASC) VISIBLE;

CREATE INDEX `fk_t_d_orderheader_ohr_t_d_order_status_oss1_idx` ON `menuiz`.`t_d_orderheader_ohr` (`OHR_OSS_ID` ASC) VISIBLE;

CREATE INDEX `fk_t_d_orderheader_ohr_t_d_address_adr1_idx` ON `menuiz`.`t_d_orderheader_ohr` (`OHR_ADR_ID_PAYMENT` ASC) VISIBLE;

CREATE UNIQUE INDEX `OHR_ID_UNIQUE` ON `menuiz`.`t_d_orderheader_ohr` (`OHR_ID` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `menuiz`.`t_d_expedition_exp`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menuiz`.`t_d_expedition_exp` ;

CREATE TABLE IF NOT EXISTS `menuiz`.`t_d_expedition_exp` (
  `EXP_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `EXP_DATE` DATE NOT NULL,
  `EXP_STATUS` TINYINT(1) NOT NULL,
  `EXP_QTY` INT(11) NOT NULL,
  `EXP_ADR_ID` INT(11) NOT NULL,
  `EXP_MEN_ID` INT(11) NOT NULL,
  `EXP_OHR_ID` INT(11) NOT NULL,
  PRIMARY KEY (`EXP_ID`),
  CONSTRAINT `fk_t_d_expedition_exp_t_d_address_adr1`
    FOREIGN KEY (`EXP_ADR_ID`)
    REFERENCES `menuiz`.`t_d_address_adr` (`ADR_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_t_d_expedition_exp_t_d_mode_expedition_men1`
    FOREIGN KEY (`EXP_MEN_ID`)
    REFERENCES `menuiz`.`t_d_mode_expedition_men` (`MEN_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_t_d_expedition_exp_t_d_orderheader_ohr1`
    FOREIGN KEY (`EXP_OHR_ID`)
    REFERENCES `menuiz`.`t_d_orderheader_ohr` (`OHR_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE INDEX `fk_t_d_expedition_exp_t_d_address_adr1_idx` ON `menuiz`.`t_d_expedition_exp` (`EXP_ADR_ID` ASC) VISIBLE;

CREATE INDEX `fk_t_d_expedition_exp_t_d_mode_expedition_men1_idx` ON `menuiz`.`t_d_expedition_exp` (`EXP_MEN_ID` ASC) VISIBLE;

CREATE INDEX `fk_t_d_expedition_exp_t_d_orderheader_ohr1_idx` ON `menuiz`.`t_d_expedition_exp` (`EXP_OHR_ID` ASC) VISIBLE;

CREATE UNIQUE INDEX `EXP_ID_UNIQUE` ON `menuiz`.`t_d_expedition_exp` (`EXP_ID` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `menuiz`.`t_d_product_tpy`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menuiz`.`t_d_product_tpy` ;

CREATE TABLE IF NOT EXISTS `menuiz`.`t_d_product_tpy` (
  `PTY_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `PTY_TYPE` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`PTY_ID`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `menuiz`.`t_d_product_prd`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menuiz`.`t_d_product_prd` ;

CREATE TABLE IF NOT EXISTS `menuiz`.`t_d_product_prd` (
  `PRD_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `PRD_REFERENCE` VARCHAR(255) NOT NULL,
  `PRD_SUPPLIER` VARCHAR(255) NOT NULL,
  `PRD_DESIGNATION` VARCHAR(255) NOT NULL,
  `PRD_FAMILY` VARCHAR(255) NOT NULL,
  `PRD_DESCRIPTION` VARCHAR(255) NOT NULL,
  `PRD_GUARANTEE` INT(11) NULL DEFAULT NULL,
  `PRD_OPENTOSELL` TINYINT(1) NOT NULL,
  `PRD_IMAGE_URL` VARCHAR(255) NULL DEFAULT NULL,
  `PRD_TYPE_ID` INT(11) NOT NULL,
  PRIMARY KEY (`PRD_ID`),
  CONSTRAINT `fk_t_d_product_prd_t_d_product_type1`
    FOREIGN KEY (`PRD_TYPE_ID`)
    REFERENCES `menuiz`.`t_d_product_tpy` (`PTY_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 13
DEFAULT CHARACTER SET = latin1;

CREATE INDEX `fk_t_d_product_prd_t_d_product_type1_idx` ON `menuiz`.`t_d_product_prd` (`PRD_TYPE_ID` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `menuiz`.`t_d_orderdetail_odt`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menuiz`.`t_d_orderdetail_odt` ;

CREATE TABLE IF NOT EXISTS `menuiz`.`t_d_orderdetail_odt` (
  `ODT_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `ODT_QTYORDERED` INT(11) NOT NULL,
  `ODT_OHR_ID` INT(11) NOT NULL,
  `ODT_PRD_ID` INT(11) NOT NULL,
  PRIMARY KEY (`ODT_ID`),
  CONSTRAINT `fk_t_d_orderdetail_odt_t_d_orderheader_ohr1`
    FOREIGN KEY (`ODT_OHR_ID`)
    REFERENCES `menuiz`.`t_d_orderheader_ohr` (`OHR_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_t_d_orderdetail_odt_t_d_product_prd1`
    FOREIGN KEY (`ODT_PRD_ID`)
    REFERENCES `menuiz`.`t_d_product_prd` (`PRD_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = latin1;

CREATE INDEX `fk_t_d_orderdetail_odt_t_d_orderheader_ohr1_idx` ON `menuiz`.`t_d_orderdetail_odt` (`ODT_OHR_ID` ASC) VISIBLE;

CREATE INDEX `fk_t_d_orderdetail_odt_t_d_product_prd1_idx` ON `menuiz`.`t_d_orderdetail_odt` (`ODT_PRD_ID` ASC) VISIBLE;

CREATE UNIQUE INDEX `ODT_ID_UNIQUE` ON `menuiz`.`t_d_orderdetail_odt` (`ODT_ID` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `menuiz`.`t_d_productcomposition_pco`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menuiz`.`t_d_productcomposition_pco` ;

CREATE TABLE IF NOT EXISTS `menuiz`.`t_d_productcomposition_pco` (
  `PCO_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `PCO_QUANTITY` INT(11) NULL DEFAULT NULL,
  `PCO_PRD_COMP_ID` INT(11) NOT NULL,
  `PCO_PRD_KIT_ID` INT(11) NOT NULL,
  PRIMARY KEY (`PCO_ID`),
  CONSTRAINT `fk_t_d_productcomposition_pco_t_d_product_prd1`
    FOREIGN KEY (`PCO_PRD_COMP_ID`)
    REFERENCES `menuiz`.`t_d_product_prd` (`PRD_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_t_d_productcomposition_pco_t_d_product_prd2`
    FOREIGN KEY (`PCO_PRD_KIT_ID`)
    REFERENCES `menuiz`.`t_d_product_prd` (`PRD_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = latin1;

CREATE INDEX `fk_t_d_productcomposition_pco_t_d_product_prd1_idx` ON `menuiz`.`t_d_productcomposition_pco` (`PCO_PRD_COMP_ID` ASC) VISIBLE;

CREATE INDEX `fk_t_d_productcomposition_pco_t_d_product_prd2_idx` ON `menuiz`.`t_d_productcomposition_pco` (`PCO_PRD_KIT_ID` ASC) VISIBLE;

CREATE UNIQUE INDEX `PCO_ID_UNIQUE` ON `menuiz`.`t_d_productcomposition_pco` (`PCO_ID` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `menuiz`.`t_d_warehouse_wrh`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menuiz`.`t_d_warehouse_wrh` ;

CREATE TABLE IF NOT EXISTS `menuiz`.`t_d_warehouse_wrh` (
  `WRH_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `WRH_NAME` TEXT NOT NULL,
  `WRH_CAPACITY` INT NULL,
  `WRH_STOCK` INT ZEROFILL NULL,
  PRIMARY KEY (`WRH_ID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE UNIQUE INDEX `WRH_ID_UNIQUE` ON `menuiz`.`t_d_warehouse_wrh` (`WRH_ID` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `menuiz`.`t_d_stockmovement_mvt`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menuiz`.`t_d_stockmovement_mvt` ;

CREATE TABLE IF NOT EXISTS `menuiz`.`t_d_stockmovement_mvt` (
  `MVT_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `MVT_QUANTITY` INT NOT NULL,
  `MVT_DATE` DATE NOT NULL,
  `MVT_CANCELLED` INT(11) NOT NULL,
  `MVT_PRD_ID` INT(11) NOT NULL,
  `MVT_OHR_ID` INT(11) NOT NULL,
  `MVT_EXP_ID` INT(11) NOT NULL,
  `MVT_WRH_ID` INT(11) NOT NULL,
  PRIMARY KEY (`MVT_ID`),
  CONSTRAINT `fk_t_d_stockmovement_mvt_t_d_product_prd1`
    FOREIGN KEY (`MVT_PRD_ID`)
    REFERENCES `menuiz`.`t_d_product_prd` (`PRD_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_t_d_stockmovement_mvt_t_d_orderheader_ohr1`
    FOREIGN KEY (`MVT_OHR_ID`)
    REFERENCES `menuiz`.`t_d_orderheader_ohr` (`OHR_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_t_d_stockmovement_mvt_t_d_expedition_exp1`
    FOREIGN KEY (`MVT_EXP_ID`)
    REFERENCES `menuiz`.`t_d_expedition_exp` (`EXP_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_t_d_stockmovement_mvt_t_d_warehouse_wrh1`
    FOREIGN KEY (`MVT_WRH_ID`)
    REFERENCES `menuiz`.`t_d_warehouse_wrh` (`WRH_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = latin1;

CREATE INDEX `fk_t_d_stockmovement_mvt_t_d_product_prd1_idx` ON `menuiz`.`t_d_stockmovement_mvt` (`MVT_PRD_ID` ASC) VISIBLE;

CREATE INDEX `fk_t_d_stockmovement_mvt_t_d_orderheader_ohr1_idx` ON `menuiz`.`t_d_stockmovement_mvt` (`MVT_OHR_ID` ASC) VISIBLE;

CREATE UNIQUE INDEX `MVT_ID_UNIQUE` ON `menuiz`.`t_d_stockmovement_mvt` (`MVT_ID` ASC) VISIBLE;

CREATE INDEX `fk_t_d_stockmovement_mvt_t_d_expedition_exp1_idx` ON `menuiz`.`t_d_stockmovement_mvt` (`MVT_EXP_ID` ASC) VISIBLE;

CREATE INDEX `fk_t_d_stockmovement_mvt_t_d_warehouse_wrh1_idx` ON `menuiz`.`t_d_stockmovement_mvt` (`MVT_WRH_ID` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `menuiz`.`type_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menuiz`.`type_user` ;

CREATE TABLE IF NOT EXISTS `menuiz`.`type_user` (
  `typ_user_id` INT(11) NOT NULL AUTO_INCREMENT,
  `Typ_type` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`typ_user_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;

CREATE UNIQUE INDEX `typ_user_id_UNIQUE` ON `menuiz`.`type_user` (`typ_user_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `menuiz`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menuiz`.`users` ;

CREATE TABLE IF NOT EXISTS `menuiz`.`users` (
  `user_id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `mail` VARCHAR(50) NOT NULL,
  `user_type_id` INT(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_users_type_user1`
    FOREIGN KEY (`user_type_id`)
    REFERENCES `menuiz`.`type_user` (`typ_user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = latin1;

CREATE INDEX `fk_users_type_user1_idx` ON `menuiz`.`users` (`user_type_id` ASC) VISIBLE;

CREATE UNIQUE INDEX `user_id_UNIQUE` ON `menuiz`.`users` (`user_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `menuiz`.`TYPE_DOSSIER_TDS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menuiz`.`TYPE_DOSSIER_TDS` ;

CREATE TABLE IF NOT EXISTS `menuiz`.`TYPE_DOSSIER_TDS` (
  `TDS_ID` INT NOT NULL AUTO_INCREMENT,
  `TDS_TYPE` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`TDS_ID`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `idtable1_UNIQUE` ON `menuiz`.`TYPE_DOSSIER_TDS` (`TDS_ID` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `menuiz`.`T_D_Dossier_SAV_DSV`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menuiz`.`T_D_Dossier_SAV_DSV` ;

CREATE TABLE IF NOT EXISTS `menuiz`.`T_D_Dossier_SAV_DSV` (
  `DSV_ID` INT NOT NULL AUTO_INCREMENT,
  `DSV_ETAT` TINYINT NOT NULL,
  `DSV_PHOTO` VARCHAR(255) NULL,
  `DSV_COM_DIAG_INITIAL` VARCHAR(255) NULL,
  `DSV_COM_DIAG_TERM` VARCHAR(255) NULL,
  `DSV_TDS_ID` INT NOT NULL,
  `DSV_PRD_ID` INT(11) NOT NULL,
  `DSV_ORH_ID` INT(11) NOT NULL,
  PRIMARY KEY (`DSV_ID`),
  CONSTRAINT `fk_T_D_Dossier_SAV_DSV_TYPE_DOSSIER_TDS1`
    FOREIGN KEY (`DSV_TDS_ID`)
    REFERENCES `menuiz`.`TYPE_DOSSIER_TDS` (`TDS_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_T_D_Dossier_SAV_DSV_t_d_product_prd1`
    FOREIGN KEY (`DSV_PRD_ID`)
    REFERENCES `menuiz`.`t_d_product_prd` (`PRD_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_T_D_Dossier_SAV_DSV_t_d_orderheader_ohr1`
    FOREIGN KEY (`DSV_ORH_ID`)
    REFERENCES `menuiz`.`t_d_orderheader_ohr` (`OHR_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `idT_D_Dossier_SAV_DSV_UNIQUE` ON `menuiz`.`T_D_Dossier_SAV_DSV` (`DSV_ID` ASC) VISIBLE;

CREATE INDEX `fk_T_D_Dossier_SAV_DSV_TYPE_DOSSIER_TDS1_idx` ON `menuiz`.`T_D_Dossier_SAV_DSV` (`DSV_TDS_ID` ASC) VISIBLE;

CREATE INDEX `fk_T_D_Dossier_SAV_DSV_t_d_product_prd1_idx` ON `menuiz`.`T_D_Dossier_SAV_DSV` (`DSV_PRD_ID` ASC) VISIBLE;

CREATE INDEX `fk_T_D_Dossier_SAV_DSV_t_d_orderheader_ohr1_idx` ON `menuiz`.`T_D_Dossier_SAV_DSV` (`DSV_ORH_ID` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `menuiz`.`T_D_SAV_DETAIL_SDT`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menuiz`.`T_D_SAV_DETAIL_SDT` ;

CREATE TABLE IF NOT EXISTS `menuiz`.`T_D_SAV_DETAIL_SDT` (
  `SDT_ID` INT NOT NULL AUTO_INCREMENT,
  `SDT_DSV_ID` INT NOT NULL,
  `SDT_STOCK_COMMANDE` INT NOT NULL,
  PRIMARY KEY (`SDT_ID`),
  CONSTRAINT `fk_T_D_SAV_DETAIL_SDT_T_D_Dossier_SAV_DSV1`
    FOREIGN KEY (`SDT_DSV_ID`)
    REFERENCES `menuiz`.`T_D_Dossier_SAV_DSV` (`DSV_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `idT_D_SAV_DETAIL_SDT_UNIQUE` ON `menuiz`.`T_D_SAV_DETAIL_SDT` (`SDT_ID` ASC) VISIBLE;

CREATE INDEX `fk_T_D_SAV_DETAIL_SDT_T_D_Dossier_SAV_DSV1_idx` ON `menuiz`.`T_D_SAV_DETAIL_SDT` (`SDT_DSV_ID` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `menuiz`.`T_D_HISTORY_SAV_HSV`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menuiz`.`T_D_HISTORY_SAV_HSV` ;

CREATE TABLE IF NOT EXISTS `menuiz`.`T_D_HISTORY_SAV_HSV` (
  `HSV_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `HSV_DSV_ID` INT NOT NULL,
  `DATE` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `HSV_LIBELLE` VARCHAR(255),
  `HSV_USERNAME` VARCHAR(100),
  PRIMARY KEY (`HSV_ID`))
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = latin1;

CREATE UNIQUE INDEX `idT_D_HISTORIQUE_SAV_HSV_UNIQUE` ON `menuiz`.`T_D_HISTORIQUE_SAV_HSV` (`HSV_ETAT_CHANGE` ASC) VISIBLE;

CREATE INDEX `fk_T_D_HISTORIQUE_SAV_HSV_T_D_Dossier_SAV_DSV1_idx` ON `menuiz`.`T_D_HISTORIQUE_SAV_HSV` (`HSV_DSV_ID` ASC) VISIBLE;

CREATE UNIQUE INDEX `HSV_ID_UNIQUE` ON `menuiz`.`T_D_HISTORIQUE_SAV_HSV` (`HSV_ID` ASC) VISIBLE;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


CREATE USER "tech1"@'localhost' IDENTIFIED BY "tech1";
GRANT SELECT, INSERT, UPDATE ON `Menuiz`.* TO "tech1"@'localhost' WITH GRANT OPTION;

CREATE USER "tech2"@'localhost' IDENTIFIED BY "tech2";
GRANT SELECT, INSERT, UPDATE ON `Menuiz`.* TO "tech2"@'localhost' WITH GRANT OPTION;


CREATE USER "tech3"@'localhost' IDENTIFIED BY "tech3";
GRANT SELECT, INSERT, UPDATE ON `Menuiz`.* TO "tech3"@'localhost' WITH GRANT OPTION;

CREATE USER "hot1"@'localhost' IDENTIFIED BY "hot1";
GRANT SELECT, INSERT, UPDATE ON `Menuiz`.* TO "hot1"@'localhost' WITH GRANT OPTION;

CREATE USER "hot2"@'localhost' IDENTIFIED BY "hot2";
GRANT SELECT, INSERT, UPDATE ON `Menuiz`.* TO "hot2"@'localhost' WITH GRANT OPTION;


CREATE USER "hot3"@'localhost' IDENTIFIED BY "hot3";
GRANT SELECT, INSERT, UPDATE ON `Menuiz`.* TO "hot3"@'localhost' WITH GRANT OPTION;

CREATE USER "admin"@'localhost' IDENTIFIED BY "admin";
GRANT ALL PRIVILEGES ON `Menuiz`.* TO "admin"@'localhost' WITH GRANT OPTION;