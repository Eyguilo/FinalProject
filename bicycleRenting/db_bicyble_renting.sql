DROP DATABASE IF EXISTS db_bicycle_renting;
CREATE DATABASE db_bicycle_renting;
USE db_bicycle_renting;

CREATE TABLE T_Clients (
  id_client INT(5) PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  last_name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  phone VARCHAR(255) NOT NULL,
  address VARCHAR(255)
);

CREATE TABLE T_Users (
  id_user INT(5) PRIMARY KEY AUTO_INCREMENT,
  name_user VARCHAR(255) NOT NULL,
  key_user VARCHAR(255) NOT NULL,
  profile VARCHAR(255) NOT NULL,
  id_client INT NOT NULL,
  FOREIGN KEY (id_client) REFERENCES T_Clients (id_client)
);

CREATE TABLE T_Bicycles (
  id_bicycle INT(5) PRIMARY KEY AUTO_INCREMENT,
  brand VARCHAR(255) NOT NULL,
  model VARCHAR(255) NOT NULL,
  size VARCHAR(255) NOT NULL,
  color VARCHAR(255),
  rental_price_hour DECIMAL(6,2) NOT NULL
);

CREATE TABLE T_Bicycle_categories (
  id_bicycle_category INT(5) PRIMARY KEY AUTO_INCREMENT,
  name_category VARCHAR(255) NOT NULL,
  description VARCHAR(255) NOT NULL
);

CREATE TABLE T_Bicycles_by_category (
  id_bicycle_by_category INT(5) PRIMARY KEY AUTO_INCREMENT,
  id_bicycle INT(5) NOT NULL,
  id_bicycle_category INT(5) NOT NULL,
  FOREIGN KEY (id_bicycle) REFERENCES T_Bicycles (id_bicycle),
  FOREIGN KEY (id_bicycle_category) REFERENCES T_Bicycle_categories (id_bicycle_category)
);

CREATE TABLE T_Reservations (
  id_reservation INT(5) PRIMARY KEY AUTO_INCREMENT,
  id_client INT(5) NOT NULL,
  id_user INT(5) NOT NULL,
  start_date DATETIME NOT NULL,
  end_date DATETIME NOT NULL,
  total_price DECIMAL(6,2) NOT NULL,
  FOREIGN KEY (id_client) REFERENCES T_Clients (id_client),
  FOREIGN KEY (id_user) REFERENCES T_Users (id_user)
);

CREATE TABLE T_Bicycles_by_reservation (
  id_bicycle_by_reservation INT(5) PRIMARY KEY AUTO_INCREMENT,
  id_reservation INT(5) NOT NULL,
  id_bicycle_by_category INT(5) NOT NULL,
  FOREIGN KEY (id_reservation) REFERENCES T_Reservations (id_reservation),
  FOREIGN KEY (id_bicycle_by_category) REFERENCES T_Bicycles_by_category (id_bicycle_by_category)
);

CREATE TABLE T_Invoices (
  id_invoice INT PRIMARY KEY AUTO_INCREMENT,
  id_reservation INT NOT NULL,
  issue_date DATETIME NOT NULL,
  total_price DECIMAL(6,2) NOT NULL,
  FOREIGN KEY (id_reservation) REFERENCES T_Reservations (id_reservation)
);