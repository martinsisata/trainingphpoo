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

//Exclui objectos no banco de dados 

try 
{
	//Inicia transação com o banco 'my_livro'
	TTransaction::open('my_livro');
	//Define o aqruivo LOG
	TTransaction::setLogger (new TloggerTXT('C:\Apache24\htdocs\trainingphpoo\tmp\log5.text'));

	TTransaction::log("**Apafando da primeira forma");
	//Instacia registo de Aluno
	$record = new AlunoRecord(1);
	//Obtém o aluno ID 1
	$aluno = $record->load(1);
	$aluno->delete();

	//Armazena esta frase no arquivo de LOG
	TTransaction::log("**Apagando da segunda forma");
	//Instacia o modelo
	$modelo = new AlunoRecord(2);

	 //Finalza a transação
	 TTransaction::close();
	 //Exibe mensagem de sucesso
	 echo "Exclusão realizada com sucesso";
	 
} catch (Exception $e)//Em caso de exceção

{
	//Exiba a mesagem gerada pela exceção
	echo '<br><br><b>Erro</b><br><br>' . $e->getMessage();
	//Desfazer todas alterações no banco de dados
	TTransaction::rollback();
	
}


 ?>