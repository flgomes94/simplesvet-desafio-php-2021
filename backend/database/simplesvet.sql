--
-- Script was generated by Devart dbForge Studio 2020 for MySQL, Version 9.0.470.0
-- Product home page: http://www.devart.com/dbforge/mysql/studio
-- Script date 08/06/2021 21:17:21
-- Server version: 5.6.51
-- Client version: 4.1
--

-- 
-- Disable foreign keys
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Set SQL mode
-- 
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

CREATE DATABASE simplesvet
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Set default database
--
USE simplesvet;

--
-- Drop table `animais`
--
DROP TABLE IF EXISTS animais;

--
-- Drop table `contatos`
--
DROP TABLE IF EXISTS contatos;

--
-- Drop table `pessoas`
--
DROP TABLE IF EXISTS pessoas;

--
-- Drop table `racas`
--
DROP TABLE IF EXISTS racas;

--
-- Drop table `especies`
--
DROP TABLE IF EXISTS especies;

--
-- Set default database
--
USE simplesvet;

--
-- Create table `especies`
--
CREATE TABLE especies (
  id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Create table `racas`
--
CREATE TABLE racas (
  id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  especie_id INT(11) UNSIGNED NOT NULL,
  nome VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Create foreign key
--
ALTER TABLE racas
ADD CONSTRAINT FK_racas_especies_id FOREIGN KEY (especie_id)
REFERENCES especies (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Create table `pessoas`
--
CREATE TABLE pessoas (
  id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Create table `contatos`
--
CREATE TABLE contatos (
  id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  pessoa_id INT(11) UNSIGNED NOT NULL,
  tipo ENUM ('celular', 'fixo', 'email') NOT NULL,
  contato VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Create foreign key
--
ALTER TABLE contatos
ADD CONSTRAINT FK_contatos_pessoas_id FOREIGN KEY (pessoa_id)
REFERENCES pessoas (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Create table `animais`
--
CREATE TABLE animais (
  id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  pessoa_id INT(11) UNSIGNED NOT NULL,
  especie_id INT(11) UNSIGNED NOT NULL,
  raca_id INT(11) UNSIGNED NOT NULL,
  nome VARCHAR(255) NOT NULL,
  nascimento DATE DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Create foreign key
--
ALTER TABLE animais
ADD CONSTRAINT FK_animais_especies_id FOREIGN KEY (especie_id)
REFERENCES especies (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Create foreign key
--
ALTER TABLE animais
ADD CONSTRAINT FK_animais_pessoas_id FOREIGN KEY (pessoa_id)
REFERENCES pessoas (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Create foreign key
--
ALTER TABLE animais
ADD CONSTRAINT FK_animais_racas_id FOREIGN KEY (raca_id)
REFERENCES racas (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Dumping data for table especies
--
-- Table simplesvet.especies does not contain any data (it is empty)

-- 
-- Dumping data for table racas
--
-- Table simplesvet.racas does not contain any data (it is empty)

-- 
-- Dumping data for table pessoas
--
-- Table simplesvet.pessoas does not contain any data (it is empty)

-- 
-- Dumping data for table contatos
--
-- Table simplesvet.contatos does not contain any data (it is empty)

-- 
-- Dumping data for table animais
--
-- Table simplesvet.animais does not contain any data (it is empty)

-- 
-- Restore previous SQL mode
-- 
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Enable foreign keys
-- 
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;