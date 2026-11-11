DROP DATABASE IF EXISTS bdRiaTour_AdonaiRodriguez_C27;
CREATE DATABASE bdRiaTour_AdonaiRodriguez_C27
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE bdRiaTour_AdonaiRodriguez_C27;

CREATE TABLE `boat` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `capacity` INT NOT NULL,
  `is_available` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (id),
  UNIQUE KEY uq_boat_name (name),
  CONSTRAINT chk_boat_capacity CHECK (capacity > 0)
) ENGINE=InnoDB;

CREATE TABLE `route` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `desc` VARCHAR(255) NULL,
  `duration_min` INT NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT chk_route_duration CHECK (duration_min > 0),
  CONSTRAINT chk_route_price CHECK (price > 0)
) ENGINE=InnoDB;

CREATE TABLE `client` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uq_client_email (email)
) ENGINE=InnoDB;

CREATE TABLE `tour` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `boat_id` INT NOT NULL,
  `route_id` INT NOT NULL,
  `starts_at` DATETIME NOT NULL,
  `status` ENUM('disponivel','esgotado','cancelado') NOT NULL DEFAULT 'disponivel',
  PRIMARY KEY (id),
  UNIQUE KEY uq_tour_boat_time (boat_id, starts_at),
  CONSTRAINT fk_tour_boat FOREIGN KEY (boat_id) REFERENCES boat(id) 
    ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT fk_tour_route FOREIGN KEY (route_id) REFERENCES route(id) 
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE booking (
  `id` INT NOT NULL AUTO_INCREMENT,
  `client_id` INT NOT NULL,
  `tour_id` INT NOT NULL,
  `passengers` INT NOT NULL,
  `booked_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` ENUM('pendente','confirmada','cancelada') NOT NULL DEFAULT 'pendente',
  PRIMARY KEY (id),
  CONSTRAINT chk_booking_passengers CHECK (passengers > 0),
  CONSTRAINT fk_booking_client FOREIGN KEY (client_id) REFERENCES client(id) 
    ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT fk_booking_tour FOREIGN KEY (tour_id) REFERENCES tour(id) 
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;
