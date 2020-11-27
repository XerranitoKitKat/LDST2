create table personas(
email char(100) not null,
nombre char(50) not null,
apellidos char(100) not null,
DNI char(10) not null,
f_nacimiento date not null,
passwd char(50) not null,
n_telefono char(9),
tipo int unsigned not null);