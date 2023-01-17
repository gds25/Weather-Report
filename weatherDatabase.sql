CREATE DATABASE IF NOT EXISTS weatherDatabase;

USE weatherDatabase;


CREATE TABLE IF NOT EXISTS users (
	ID int NOT NULL UNIQUE AUTO_INCREMENT,
	username varchar(255) NOT NULL UNIQUE,
	password varchar(255) NOT NULL,
	Primary Key (ID)
);

CREATE TABLE IF NOT EXISTS cities (
	ID int NOT NULL UNIQUE AUTO_INCREMENT,
	username varchar(255) NOT NULL,
	city varchar(255) NOT NULL,
	state varchar(255) NOT NULL,
	country varchar(255) NOT NULL,
	Primary Key(ID)
);

