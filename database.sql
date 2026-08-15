-- LapLegend Database Schema
-- Local Development Database
-- Compatible with MySQL / MariaDB

CREATE DATABASE IF NOT EXISTS `lap_legends_k`
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;

USE `lap_legends_k`;

-- --------------------------------------------------------
-- Table: admins
-- --------------------------------------------------------

CREATE TABLE `admins` (
    `admin_id` INT(11) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`admin_id`),
    UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------
-- Table: users
-- --------------------------------------------------------

CREATE TABLE `users` (
    `user_id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`user_id`),
    UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------
-- Table: races
-- --------------------------------------------------------

CREATE TABLE `races` (
    `race_id` INT(11) NOT NULL AUTO_INCREMENT,
    `race_name` VARCHAR(150) NOT NULL,
    `location` VARCHAR(100) NOT NULL,
    `race_date` DATE NOT NULL,
    `ticket_price` DECIMAL(10,2) NOT NULL,
    `image` VARCHAR(255) DEFAULT 'default.jpg',
    PRIMARY KEY (`race_id`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------
-- Table: gallery
-- --------------------------------------------------------

CREATE TABLE `gallery` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(100) NOT NULL,
    `image` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------
-- Table: bookings
-- --------------------------------------------------------

CREATE TABLE `bookings` (
    `booking_id` INT(11) NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) NOT NULL,
    `race_id` INT(11) NOT NULL,
    `quantity` INT(11) NOT NULL,
    `total_price` DECIMAL(10,2) NOT NULL,
    `booking_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`booking_id`),
    KEY `user_id` (`user_id`),
    KEY `race_id` (`race_id`),

    CONSTRAINT `bookings_ibfk_1`
        FOREIGN KEY (`user_id`)
        REFERENCES `users` (`user_id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT `bookings_ibfk_2`
        FOREIGN KEY (`race_id`)
        REFERENCES `races` (`race_id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE

) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;