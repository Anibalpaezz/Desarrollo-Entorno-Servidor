create database cursoscp character set utf8mb4 collate utf8mb4_spanish_ci;
use cursoscp;

drop database cursoscp;

create table solicitantes(
    dni varchar(9) primary key,
    apellidos char(40),
    nombre char(20),
    telefono varchar(12),
    correo varchar(50),
    codigocentro varchar(8),
    coordinadortic boolean,
    grupotic boolean,
    nombregrupo varchar(25),
    pbilin boolean,
    cargo boolean,
    nombrecargo char(15),
    situacion enum['activo', 'inactivo'],
    fechanac date,
    especialidad char(50),
    puntos int(3)
)engine=innodb;

drop table solicitantes;

create table cursos(
    codigo int(6) primary key,
    nombre varchar(50),
    abierto boolean,
    numeroplazas int(2),
    plazoinscripcion date
)engine=innodb;

drop table cursos;

create table solicitudes(
    dni varchar(9),
    codigocurso int(6),
    fechasolicitud date,
    admitido boolean
    primary key (dni, codigocurso)
)engine=innodb;

drop table solicitudes;