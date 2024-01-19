DROP DATABASE IF EXISTS postales;
CREATE DATABASE IF NOT EXISTS postales CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE postales;

CREATE TABLE informacion (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30),
    direccion VARCHAR(50),
    CP INT,
    email VARCHAR(100),
    fecha_nac DATE,
) ENGINE=InnoDB;

INSERT INTO informacion (nombre, direccion, CP, email, fecha_nac) VALUES ("anibal", "calle concha", 28300, "prxss@yahoo.com", "2003/11/07");

