create table admin_tbl(
id tinyint(2) NOT NULL AUTO_INCREMENT KEY,
 name VARCHAR(200) not NULL,
 username VARCHAR(200) not null unique,
 password varchar(200) not null
);