<?php 
//Inserir função autoload() para carregar classes

function __autoload($classe)
{
	if(file_exists("app.ado/{$classe}.class.php"))
	{
		include_once "app.ado/{$classe}.class.php";
	}
}


/*
Classe AlunoRecord, filha de TRecord
*/


class AlunoRecord extends TRecord
{
	
}

/**
* Classe CursoRecord, filha de TRecord
*persiste um Curso na Base de dados
*/
class CursoRecord extends TRecord
{
	
}

//Inserir novo OObjecto no Banco
try 
{
	//Iniciar a transação com a base de dados 'pg_livro'
	TTransaction::open('pg_livro');
	//Definir o arquiva para log
	TTransaction::setLogger(new TLoggerTXT('/tmp/log1.txt'));

	//armazena esta frase no arquivo de LOG
	TTransaction::log("** Inserido Aluuno");

	//instanciar um novo ALuno
	$daline= new AlunoRecord;
	$daline->nome     = 'Daline Dall Oglio';
	$daline->endereco = 'Rua da Conceição';
	$daline->telefone = '(51) 1111-2222';
	$daline->cidade   = 'Cruzeiro do SUL';
	$daline->store(); //Armazena o Objecto

	//Instancia um novo objecto Aluno
	$martins= new AlunoRecord;
	$martins->nome     = 'Daline Dall Oglio';
	$martins->endereco = 'Rua da jardim do Mar';
	$martins->telefone = '(244) 333-566';
	$martins->cidade   = 'Luanda';
	$martins->store(); //Armazena o Objecto

	//Armazena esta frase no arquivo LOG
	TTransaction::log("**Inserindo Cursos");
	//instancia o novo objecto Curso
	$curso= new CursoRecord;
	$curso->descricao ="Orientação a Objecto com PHP";
	$curso->duracao   = 24;
	$curso->store(); //Armazena o objecto
	
	//instancia o novo objecto Curso
	$curso= new CursoRecord;
	$curso->descricao ="Desenvolvendo em PHP-GTK";
	$curso->duracao   = 32;
	$curso->store(); //Armazena o objecto

	//Finalizar a transação
	TTransaction::close();
	echo "Registos Inseridos com Sucesso <br>\n";

} 
catch (Exception $e) 
{
	//Exibe a mensagem gerada pela exceção
	echo '<br>Erro<br>' . $e->getMessage();
	//Desfaz todas alterações na base de dados
	TTransaction::rollback();
}

 ?>