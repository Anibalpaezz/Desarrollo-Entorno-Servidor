drop database if exists cursoscp;
create database cursoscp character set utf8mb4 collate utf8mb4_spanish_ci;
use cursoscp;

create table solicitantes(
    dni varchar(9) primary key,
    apellidos char(50),
    nombre char(30),
    telefono varchar(12),
    correo varchar(50),
    pass varchar(40),
    codigocentro varchar(8) default null,
    coordinadortic boolean,
    grupotic boolean,
    nombregrupo varchar(30) default null,
    pbilin boolean,
    nombrecargo char(30),
    situacion enum('activo', 'inactivo'),
    fechanac date,
    especialidad char(50),
    permisos boolean default false,
    puntos int(3)
) engine=innodb;

use cursoscp;
INSERT INTO solicitantes (dni, apellidos, nombre, telefono, correo, pass, codigocentro, coordinadortic, grupotic, nombregrupo, pbilin, nombrecargo, situacion, fechanac, especialidad, permisos, puntos)
VALUES 
('12345678T', 'Pérez', 'Juan', '654987321', 'juan.perez@email.com', 'hola', 'COD001', true, false, null, true, null, 'activo', '1990-01-15', 'Informática', true, 0);

create table cursos(
    codigo int(6) auto_increment primary key,
    nombre varchar(50),
    abierto boolean,
    numeroplazas int(2),
    numeroSolicitudes int(2),
    plazoinscripcion date
)engine=innodb;

use cursoscp;
INSERT INTO cursos (nombre, abierto, numeroplazas, numeroSolicitudes, plazoinscripcion) VALUES
    ('Matemáticas Básicas', true, 10, 0, '2024-02-01'),
    ('Programación en Java', true, 8, 0, '2024-02-15'),
    ('Diseño Gráfico', true, 10, 0, '2024-03-01'),
    ('Inglés Avanzado', true, 5, 0, '2024-03-15'),
    ('Historia del Arte', true, 10, 0, '2024-04-01'),
    ('PHP', false, 10, 0, '2024-04-01'),
    ('HTML', false, 10, 0, '2024-04-01');

create table solicitudes(
    dni varchar(9),
    codigocurso int(6),
    fechasolicitud date,
    admitido boolean default false,
    primary key (dni, codigocurso),
    Foreign Key (codigocurso) REFERENCES cursos(codigo),
    Foreign Key (dni) REFERENCES solicitantes(dni)
) engine=innodb;

create table usuarios(
    ID int auto_increment primary key,
    nombre varchar(30),
    pass varchar(30),
    permisos boolean default true
)engine=InnoDB;

use cursoscp;
insert into usuarios (nombre, pass, permisos) values ("anibal", "nico", true);
insert into usuarios (nombre, pass, permisos) values ("nico", "nico", false);


drop table solicitudes;
drop table cursos;
drop table solicitantes;
drop table usuarios;