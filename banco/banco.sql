	ALTER DATABASE my_livro CHARACTER SET utf8 COLLATE utf8_unicode_ci;
	ALTER TABLE curso CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
	create table aluno (
		id int primary key auto_increment, 
		nome varchar(40),
		endereco varchar(40),
		telefone varchar(40),
		cidade varchar(40)
		);
	insert into aluno values (null,"Martins Isata","cazenga","1232","Luanda");
	insert into aluno values (null,"Nerbel Isata","viana","2452","Luanda");
    create table inscricao 
		(
		id serial primary key auto_increment, 
		refAluno int,
		refTurma int,
		nota float,
		frequencia float,
		cancelado boolean,
		concluida boolean
		);
		insert into inscricao (refAluno,refTurma,nota,frequencia, cancelado, concluida) values(3,2,8,75,0,1);
		insert into inscricao (refAluno,refTurma,nota,frequencia, cancelado, concluida) values(2,3,9,80,0,0);
		insert into inscricao (refAluno,refTurma,nota,frequencia, cancelado, concluida) values(3,4,7,75,0,1);
		insert into inscricao (refAluno,refTurma,nota,frequencia, cancelado, concluida) values(4,3,10,90,1,0);

	create table turma 
		(
		id int primary key auto_increment,
		diaSemana int,
		turno char(1),
		professor varchar(40),
		sala varchar(40),
		dataInicio date,
		encerrada boolean,
		refCurso int
		);
		insert into turma values (null,2,'T','Martins Isata','A','2015-03-15',1,1);
		insert into turma values (null,2,'T','Manuel Cambota','B','2015-06-20',1,2);
		insert into turma values (null,2,'T','Antonio Isata','C','2015-08-23',0,1);
		insert into turma values (null,2,'M','Edgar Golcalves','D','2015-01-10',0,1);
	create table curso 
		(
		id int primary key auto_increment, 
		descricao varchar(40),
		duracao int
		);
	insert into curso values (1,"Inglês",360)