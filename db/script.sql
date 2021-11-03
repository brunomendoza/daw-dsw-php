CREATE DATABASE `commercedb`;

USE commercedb;

CREATE TABLE `customer` (
  `customerid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `firstlastname` varchar(50) NOT NULL,
  `secondlastname` varchar(50) DEFAULT NULL,
  `birthdaydate` date NOT NULL,
  `streetdirection` varchar(150) NOT NULL,
  `streetnumber` int(11) DEFAULT NULL,
  `provincecode` int(11) DEFAULT NULL,
  `cityid` int(11) NOT NULL,
  `provinceid` int(11) NOT NULL,
  `countryid` int(11) NOT NULL,
  `telephone1` int(11) NOT NULL,
  `telephone2` int(11) DEFAULT NULL,
  `insertdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`customerid`),
  UNIQUE KEY `UNIQUE_INDX1` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `commercedb`.`city` (
 `cityid` int NOT NULL,
 `cityname` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
 PRIMARY KEY (`cityid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `commercedb`.`country` (
 `countryid` int NOT NULL,
 `countryname` varchar(100) NOT NULL,
 PRIMARY KEY (`countryid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `commercedb`.`province` (
 `provinceid` int NOT NULL,
 `provincename` varchar(100) NOT NULL,
 PRIMARY KEY (`provinceid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;