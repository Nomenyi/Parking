DROP DATABASE IF EXISTS PARKING;

CREATE DATABASE IF NOT EXISTS PARKING;

CREATE TABLE Axes(
    AxesId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    AxesName CHAR (1) NOT NULL,
    AxesLength DOUBLE NOT NULL
);

INSERT INTO Axes (AxesName, AxesLength)
VALUES ("A", 25);

INSERT INTO Axes (AxesName, AxesLength)
VALUES ("B", 25);

INSERT INTO Axes (AxesName, AxesLength)
VALUES ("C", 25);