DROP DATABASE IF EXISTS jaboneria;
CREATE DATABASE IF NOT EXISTS jaboneria CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

use jaboneria;

CREATE TABLE clientes (
    email VARCHAR(50) PRIMARY KEY,
    pass varchar(50),
    nombre VARCHAR(30),
    direccion VARCHAR(40),
    CP INT,
    telefono VARCHAR(12)
) ENGINE = InnoDB;


CREATE TABLE productos (
    producto_ID INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30),
    descripcion TEXT,
    peso INT,
    precio INT,
    imagen VARCHAR(50)
) ENGINE = InnoDB;


CREATE TABLE cesta (
    cesta_ID INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50),
    fecha_creacion DATE,
    FOREIGN KEY (email) REFERENCES clientes(email) ON DELETE NO ACTION
) ENGINE = InnoDB;


CREATE TABLE item_cesta (
    item_cesta_ID INT AUTO_INCREMENT PRIMARY KEY,
    cesta_ID INT,
    producto_ID INT,
    cantidad INT,
    FOREIGN KEY (cesta_ID) REFERENCES cesta(cesta_ID) ON DELETE CASCADE,
    FOREIGN KEY (producto_ID) REFERENCES productos(producto_ID) ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE item_pedido (
    item_pedido_ID INT AUTO_INCREMENT PRIMARY KEY,
    pedido_ID INT,
    producto_ID INT,
    unidades INT,
    FOREIGN KEY (pedido_ID) REFERENCES pedidos(pedido_ID) ON DELETE CASCADE,
    FOREIGN KEY (producto_ID) REFERENCES productos(producto_ID) ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE pedidos (
    pedido_ID INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50),
    fecha_pedido DATE,
    fecha_entrega DATE,
    total_pedido INT,
    entregado BOOLEAN,
    FOREIGN KEY (email) REFERENCES clientes(email) ON DELETE NO ACTION
) ENGINE = InnoDB;



CREATE TABLE administradores (
    ID INT auto_increment primary key,
    usuario varchar(50),
    pass varchar(50)
) ENGINE = InnoDB;