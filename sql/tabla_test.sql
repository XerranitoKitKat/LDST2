create table test(
id int unsigned not null auto_increment,
email char(100) not null,
f_test1 date,
f_test2 date,
f_descon date,
comentario text(10000),
primary key (id,email)); 