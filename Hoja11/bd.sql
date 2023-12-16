drop database inmobiliaria;
drop table noticias;
drop table categorias;
drop table usuarios;

use inmobiliaria;
select * from noticias;

create database inmobiliaria character set utf8mb4 collate utf8mb4_spanish_ci;

use inmobiliaria;
use inmobiliaria;
create table categorias(
    nombre varchar(50) primary key,
    descripcion text
)engine=innodb;

use inmobiliaria;
insert into categorias (nombre) values ('Promociones');
insert into categorias (nombre) values ('Ofertas');
insert into categorias (nombre) values ('Costas');


use inmobiliaria;
create table usuarios(
    ID int auto_increment primary key,
    nombre varchar(50) not null,
    contraseña varchar(20) not null,
    permisos boolean
)engine=innodb;

use inmobiliaria;
insert into usuarios (nombre, contraseña, permisos) values ('anibal', 'nico', true);
insert into usuarios (nombre, contraseña, permisos) values ('nico', 'nico', false);
insert into usuarios (nombre, contraseña, permisos) values ('carmen', 'nico', false);

create table noticias(
    ID int(5) auto_increment not null primary key,
    Titulo varchar(100) not null default '',
    Texto text not null,
    Categoria varchar(50) default 'Promociones',
    Fecha date not null default '2003-11-07',
    Imagen varchar(100) default null,
    constraint fk_cat foreign key (Categoria) references categorias(nombre)
)engine=InnoDB;

use inmobiliaria;
insert into noticias (Titulo, Texto, Fecha) values ('Nueva promocion en Nervion', '145 viviendas de lujo en urbanizacion ajardinada situadas en un entorno privilegiado', '2007-02-04');
insert into noticias (Titulo, Texto, Categoria, Fecha) values ('Ultimas viviendas junto al rio', 'Apartamentos de 1 y 2 dormitorios, con fantasticas vistas. Excelentes condiciones de financiacion', 'Ofertas','2007-02-05');
insert into noticias (Titulo, Texto, Categoria, Fecha, Imagen) values ('Apartamentos en el Puerto de Sta Maria', 'En la playa de Valdegrana, en primera linea de playa. Pisos reformados y completamente amueblados', 'Costas', '2007-02-06', 'apartamento8.jpg');
insert into noticias (Titulo, Texto, Fecha) values ('Casa reformada en el barrio de la Juderia', 'Dos plantas y atico, 5 habitaciones patio interior, amplio garaje. Situada en una calle tranquila y a un paso del centro historico', '2004-02-07');
insert into noticias (Titulo, Texto, Categoria, Fecha, Imagen) values ('Promocion en Costa Ballena', 'Con vistas al campo de golf, magnificas calidades, entorno ajardinado con piscina y servicio de vigilancia', 'Costas', '2007-02-09', 'apartamento9.jpg');

CREATE TABLE votos(
    ID INT(3) unsigned NOT NULL auto_increment PRIMARY KEY,
    votos1 INT(10) unsigned NOT NULL default '0',
    votos2 INT(10) unsigned NOT NULL default '0'
)engine=innodb;
INSERT INTO votos VALUES (1, 49, 12);


