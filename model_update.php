<?php 
//inserir função __autoload() para carregar as classes
include_once 'autoLoad.php';
/**
 * Class AlunoRecord, filha de TRecord
 *Persiste um Aluno no banco de dados
 */


class AlunoRecord extends TRecord { }


/**
 * Classe CursoRecord, filha de TRecord
 *Persiste um Curso no banco de dados
 */


class CursoRecord extends TRecord { }

//Alteraa objectos no banco de dados 

try 
{
	//Inicia transação com o banco 'my_livro'
	TTransaction::open('my_livro');
	//Define o aqruivo LOG
	TTransaction::setLogger (new TloggerTXT('C:\Apache24\htdocs\trainingphpoo\tmp\log3.text'));

	TTransaction::log("**Obterendo o aluno 1");
	//Instacia registo de Aluno
	$record = new AlunoRecord;
	//Obtém o aluno ID 1
	$aluno = $record->load(1);
	if ($aluno) //Verifica se existe
	 {
	 	//Altera o telefone
	 	$aluno->telefone = '(51) 1111-333';
	 	TTransaction::log("**Persistindo o aluno 1");
	 	$aluno->store();
	 }
	 TTransaction::log("**Obterendo o curso 1");
	 //Instanciar registo de curso
	 $record = new CursoRecord;
	 //Obtém o Curso de ID 1
	 $curso = $record->load(1);

	 if ($curso) 
	 {
	 	//Alterar a duração
	 	$curso->duracao = 28;
	 	TTransaction::log("**Persistindo o aluno 1");
	 	$curso->store();
	 }

	 //Finalza a transação
	 TTransaction::close();
	 //Exibe mensagem de sucesso
	 echo "Registos Alterados com sucesso";
	 
} catch (Exception $e)//Em caso de exceção

{
	//Exiba a mesagem gerada pela exceção
	echo '<br><br><b>Erro</b><br><br>' . $e->getMessage();
	//Desfazer todas alterações no banco de dados
	TTransaction::rollback();
	
}


 ?>