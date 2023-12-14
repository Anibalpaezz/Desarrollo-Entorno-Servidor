create database inmobiliaria character set utf8mb4 collate utf8mb4_spanish_ci;

use inmobiliaria;
drop database inmobiliaria;

create table noticias(
    ID int(5) auto_increment not null primary key,
    Titulo varchar(100) not null default '',
    Texto text not null,
    Categoria enum('Promociones', 'Ofertas', 'Costas') not null default 'Promociones',
    Fecha date not null default '2003-11-07',
    Imagen varchar(100) default null
)engine=InnoDB;

insert into noticias (Titulo, Texto, Fecha) values ('Nueva promocion en Nervion', '145 viviendas de lujo en urbanizacion ajardinada situadas en un entorno privilegiado', '2007-02-04');
insert into noticias (Titulo, Texto, Categoria, Fecha) values ('Ultimas viviendas junto al rio', 'Apartamentos de 1 y 2 dormitorios, con fantasticas vistas. Excelentes condiciones de financiacion', 'Ofertas','2007-02-05');
insert into noticias (Titulo, Texto, Categoria, Fecha, Imagen) values ('Apartamentos en el Puerto de Sta Maria', 'En la playa de Valdegrana, en primera linea de playa. Pisos reformados y completamente amueblados', 'Costas', '2007-02-06', 'apartamento8.jpg');
insert into noticias (Titulo, Texto, Fecha) values ('Casa reformada en el barrio de la Juderia', 'Dos plantas y atico, 5 habitaciones patio interior, amplio garaje. Situada en una calle tranquila y a un paso del centro historico', '2004-02-07');
insert into noticias (Titulo, Texto, Categoria, Fecha, Imagen) values ('Promocion en Costa Ballena', 'Con vistas al campo de golf, magnificas calidades, entorno ajardinado con piscina y servicio de vigilancia', 'Costas', '2007-02-09', 'apartamento9.jpg');


select * from noticias;