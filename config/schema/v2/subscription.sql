CREATE TABLE IF NOT EXISTS `subscription` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created` DATETIME NOT NULL,
  `price` INT NOT NULL,
  `validated` TINYINT(1) NOT NULL DEFAULT 0,
  `payed` TINYINT(1) NOT NULL DEFAULT 0,
  `code` VARCHAR(8) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `code_UNIQUE` (`code` ASC))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `member` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(255) NOT NULL,
  `lname` VARCHAR(255) NOT NULL,
  `dob` DATETIME NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `pcode` VARCHAR(8) NOT NULL,
  `code` VARCHAR(8) NULL,
  `subscriber` TINYINT(1) NOT NULL DEFAULT 0,
  `participant` TINYINT(1) NOT NULL DEFAULT 0,
  `validated` TINYINT(1) NOT NULL DEFAULT 0,
  `consent` TINYINT(1) NOT NULL DEFAULT 0,
  `private` TINYINT(1) NOT NULL DEFAULT 0,
  `sponsor` TINYINT(1) NOT NULL DEFAULT 0,
  `number` varchar(4) DEFAULT '0000',
  `subscription_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `code_UNIQUE` (`code` ASC),
  INDEX `fk_member_subscription_idx` (`subscription_id` ASC),
  CONSTRAINT `fk_member_subscription`
    FOREIGN KEY (`subscription_id`)
    REFERENCES `subscription` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

