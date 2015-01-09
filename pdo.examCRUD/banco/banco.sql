create database pdo;
	use pdo;
	create table usuario
		(
			idUsuario int primary key auto_increment,
			nome varchar(50),
			email varchar(50),
			criadoEm varchar(50)
		);
	insert into usuario (nome, email, criadoEm) values ("Martins", "martinsisata@gmail.com", NOW());