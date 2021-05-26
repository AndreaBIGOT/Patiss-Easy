-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `patisseasy`;
CREATE DATABASE `patisseasy` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `patisseasy`;

DROP TABLE IF EXISTS `astuce`;
CREATE TABLE `astuce` (
  `idAstuce` int(11) NOT NULL AUTO_INCREMENT,
  `astuce` text NOT NULL,
  PRIMARY KEY (`idAstuce`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `astuce` (`idAstuce`, `astuce`) VALUES
(1,	'Première astuce!');

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE `categorie` (
  `idCateg` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` varchar(50) NOT NULL,
  PRIMARY KEY (`idCateg`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `categorie` (`idCateg`, `categorie`) VALUES
(1,	'Cakes'),
(2,	'Macarons'),
(3,	'Easy');

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210426095137',	'2021-04-26 09:52:14',	616);

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE `ingredient` (
  `idIng` int(11) NOT NULL AUTO_INCREMENT,
  `ingredient` varchar(50) NOT NULL,
  PRIMARY KEY (`idIng`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO `ingredient` (`idIng`, `ingredient`) VALUES
(1,	'Œufs '),
(2,	'Chocolat noir'),
(3,	'Chocolat blanc'),
(4,	'Chocolat au lait'),
(5,	'Lait'),
(6,	'Farine'),
(7,	'Beurre'),
(8,	'Huile neutre'),
(9,	'Sucre'),
(10,	'Crème liquide');

DROP TABLE IF EXISTS `ingredient_lieu`;
CREATE TABLE `ingredient_lieu` (
  `idIng` int(11) NOT NULL,
  `idLieu` int(11) NOT NULL,
  PRIMARY KEY (`idIng`,`idLieu`),
  KEY `IDX_7106CDCF5CAA23C7` (`idLieu`),
  CONSTRAINT `ingredient_lieu_ibfk_1` FOREIGN KEY (`idIng`) REFERENCES `ingredient` (`idIng`),
  CONSTRAINT `ingredient_lieu_ibfk_2` FOREIGN KEY (`idLieu`) REFERENCES `lieu` (`idLieu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lieu`;
CREATE TABLE `lieu` (
  `idLieu` int(11) NOT NULL AUTO_INCREMENT,
  `magasin` varchar(70) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `cp` int(11) NOT NULL,
  PRIMARY KEY (`idLieu`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `lieu` (`idLieu`, `magasin`, `ville`, `cp`) VALUES
(1,	'Auchan',	'Saint-Pierre',	97410),
(2,	'Carrefour',	'Saint-Joseph',	97480);

DROP TABLE IF EXISTS `preparation`;
CREATE TABLE `preparation` (
  `idPreparation` int(11) NOT NULL AUTO_INCREMENT,
  `etape` text,
  `idRecette` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPreparation`),
  KEY `idRecette` (`idRecette`),
  CONSTRAINT `preparation_ibfk_1` FOREIGN KEY (`idRecette`) REFERENCES `recette` (`idRecette`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `preparation` (`idPreparation`, `etape`, `idRecette`) VALUES
(1,	'1/ Faites fondre le chocolat.\r\n2/ Séparez les blancs des jaunes et montez les blancs en neige.\r\n3/ Une fois le chocolat refroidi, mélangez-le avec les jaunes. ',	1),
(2,	'1/ Mélangez le sucre glace avec la poudre d\'amande. \r\n2/ Fouettez en meringue les blancs d\'oeufs.',	2),
(3,	'Fondre le chocolat. \r\nAjouter la farine. \r\nIncorporez les blancs à la maryse.',	29),
(4,	'public function __toString()\r\n    {\r\n        return $this->categorie;\r\n    }public function __toString()\r\n    {\r\n        return $this->categorie;\r\n    }public function __toString()\r\n    {\r\n        return $this->categorie;\r\n    }',	30);

DROP TABLE IF EXISTS `recette`;
CREATE TABLE `recette` (
  `idRecette` int(11) NOT NULL AUTO_INCREMENT,
  `recette` varchar(50) NOT NULL,
  `descriptionRecette` text NOT NULL,
  `datePublication` datetime NOT NULL,
  `petitePhrase` text,
  PRIMARY KEY (`idRecette`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

INSERT INTO `recette` (`idRecette`, `recette`, `descriptionRecette`, `datePublication`, `petitePhrase`) VALUES
(1,	'Gâteau chocolat banane',	'Ce gâteau est hyper moelleux. \r\n',	'2012-12-12 22:20:23',	'Gâteau parfait pour le gouter!'),
(2,	'Macarons',	'Recette inratable!!!!!!',	'2023-08-21 20:23:00',	'Recette pour petits et grands!'),
(3,	'aqzsedrfgh',	'zsqedrftgyhfdsrfgvfcdsedrfgvcdsfv',	'2021-04-27 07:11:17',	'df'),
(4,	'categ',	'categ',	'2021-04-27 07:31:12',	'categ'),
(29,	'Préparation',	'PréparationPréparationPréparationPréparation',	'2021-05-26 05:06:07',	'PréparationPréparation'),
(30,	'unité',	'unitéunitéunité',	'2021-05-26 06:55:17',	'unitéunité');

DROP TABLE IF EXISTS `recette_astuce`;
CREATE TABLE `recette_astuce` (
  `idRecette` int(11) NOT NULL,
  `idAstuce` int(11) NOT NULL,
  PRIMARY KEY (`idRecette`,`idAstuce`),
  KEY `IDX_10E715796A667F1A` (`idAstuce`),
  CONSTRAINT `recette_astuce_ibfk_3` FOREIGN KEY (`idRecette`) REFERENCES `recette` (`idRecette`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `recette_astuce_ibfk_4` FOREIGN KEY (`idAstuce`) REFERENCES `astuce` (`idAstuce`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `recette_astuce` (`idRecette`, `idAstuce`) VALUES
(1,	1),
(29,	1),
(30,	1);

DROP TABLE IF EXISTS `recette_categ`;
CREATE TABLE `recette_categ` (
  `idRecette` int(11) NOT NULL,
  `idCateg` int(11) NOT NULL,
  PRIMARY KEY (`idRecette`,`idCateg`),
  KEY `IDX_FF7A49E5144A826E` (`idCateg`),
  CONSTRAINT `recette_categ_ibfk_3` FOREIGN KEY (`idRecette`) REFERENCES `recette` (`idRecette`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `recette_categ_ibfk_4` FOREIGN KEY (`idCateg`) REFERENCES `categorie` (`idCateg`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `recette_categ` (`idRecette`, `idCateg`) VALUES
(1,	1),
(29,	1),
(30,	1),
(2,	2),
(1,	3),
(29,	3);

DROP TABLE IF EXISTS `recette_ingredient`;
CREATE TABLE `recette_ingredient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idRecette` int(11) NOT NULL,
  `idIng` int(11) NOT NULL,
  `quantite` float NOT NULL,
  `unite` varchar(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_17C041A9B1A786E8` (`idIng`),
  KEY `idRecette` (`idRecette`),
  CONSTRAINT `recette_ingredient_ibfk_3` FOREIGN KEY (`idIng`) REFERENCES `ingredient` (`idIng`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `recette_ingredient_ibfk_4` FOREIGN KEY (`idRecette`) REFERENCES `recette` (`idRecette`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

INSERT INTO `recette_ingredient` (`id`, `idRecette`, `idIng`, `quantite`, `unite`) VALUES
(1,	1,	2,	1150,	'g'),
(2,	1,	7,	150,	'g'),
(3,	2,	1,	1.5,	'l'),
(4,	2,	6,	60,	'g'),
(30,	29,	7,	200,	'g'),
(31,	29,	9,	100,	'g'),
(32,	30,	6,	200,	'g');

DELIMITER ;;

CREATE TRIGGER `before_insert_quantite` BEFORE INSERT ON `recette_ingredient` FOR EACH ROW
BEGIN
    IF (NEW.quantite < 0) THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT="Veuillez entrer une quantité supérieur à 0.";
    END IF;
END;;

DELIMITER ;

DROP TABLE IF EXISTS `recette_theme`;
CREATE TABLE `recette_theme` (
  `idRecette` int(11) NOT NULL,
  `idTheme` int(11) NOT NULL,
  PRIMARY KEY (`idRecette`,`idTheme`),
  KEY `IDX_6B816F9E80B1A415` (`idTheme`),
  CONSTRAINT `recette_theme_ibfk_2` FOREIGN KEY (`idTheme`) REFERENCES `theme` (`idTheme`),
  CONSTRAINT `recette_theme_ibfk_3` FOREIGN KEY (`idRecette`) REFERENCES `recette` (`idRecette`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `recette_theme` (`idRecette`, `idTheme`) VALUES
(1,	1),
(29,	1),
(30,	1),
(2,	2);

DROP TABLE IF EXISTS `recette_ustensile`;
CREATE TABLE `recette_ustensile` (
  `idRecette` int(11) NOT NULL,
  `idUstensile` int(11) NOT NULL,
  PRIMARY KEY (`idRecette`,`idUstensile`),
  KEY `IDX_613487D52E08C24D` (`idUstensile`),
  CONSTRAINT `recette_ustensile_ibfk_3` FOREIGN KEY (`idRecette`) REFERENCES `recette` (`idRecette`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `recette_ustensile_ibfk_4` FOREIGN KEY (`idUstensile`) REFERENCES `ustensile` (`idUstensile`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `recette_ustensile` (`idRecette`, `idUstensile`) VALUES
(2,	1),
(29,	1),
(30,	1),
(1,	2),
(29,	2),
(30,	2);

DROP TABLE IF EXISTS `theme`;
CREATE TABLE `theme` (
  `idTheme` int(11) NOT NULL AUTO_INCREMENT,
  `theme` varchar(50) NOT NULL,
  PRIMARY KEY (`idTheme`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `theme` (`idTheme`, `theme`) VALUES
(1,	'Anniversaire'),
(2,	'Noël');

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`id`, `email`, `username`, `password`) VALUES
(3,	'aedzd@as.de',	'andréa',	'$2y$13$LBTjHX9vbAxU9N.iL1q.peK6yCC3.xahLH5fnt6Css.bnBAQUCQja'),
(4,	'andrea@andrea.re',	'andrea',	'$2y$13$wOEKSVsIEZ1/.OhDAknnCe/XfBqjFFmOSsOMepI8dSdnQ34RH6ph2'),
(5,	'andrea.bigot974@gmail.com',	'andréa',	'$2y$13$2WVvKFHziSwQL2k0PQ.udu./VBCSQg2JP8n7RO6hdm9lnLjb8x23e');

DROP TABLE IF EXISTS `ustensile`;
CREATE TABLE `ustensile` (
  `idUstensile` int(11) NOT NULL AUTO_INCREMENT,
  `ustensile` varchar(50) NOT NULL,
  PRIMARY KEY (`idUstensile`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `ustensile` (`idUstensile`, `ustensile`) VALUES
(1,	'Robot'),
(2,	'Fouet');

-- 2021-05-26 07:35:37
