create table asignaturas(
codigo int unsigned not null auto_increment primary key,
aula char(50) not null,
lab char(50),
profesor char(100) not null,
n_matriculados int unsigned,
curso int unsigned,
img_a varchar(500),
img_l varchar(500));