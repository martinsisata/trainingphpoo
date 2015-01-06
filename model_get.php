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

//Obter objecto do banco de dados

try 
{
	//Inicia a tranasação com o banco 'my_livro'
	TTransaction::open('my_livro');
	//define o arquivo para log
	TTransaction::setLogger (new TloggerTXT('/tmp/log2.text'));

	//Exibe algumas mensagens na tela
	echo "Ontendo alunos<br>\n";
	echo "===============<br>\n";

	//Obtém o aluno de ID 1
	$aluno = new AlunoRecord(1);
	echo 'Nome     : '.$aluno->nome     ."<br>\n";
	echo 'Endereço : '.$aluno->endereco ."<br>\n";

	//Otém o aluno de ID 2
	$aluno = New AlunoRecord (2);
	echo 'Nome     : '.$aluno->nome     ."<br>\n";
	echo 'Endereço : '.$aluno->endereco ."<br>\n";

	//Obtém alguns cursos
	echo "<br>\n";
	echo "Obtendo cursos<br>\n";
	echo "==============<br>\n";

	//Obtém curso de ID 1
	$curso = new CursoRecord(1);
	echo 'Curso  : ' .$curso->descricao  . "<br>\n";

	//Finaliza a transação
	TTransaction::close();
	
} catch (Exception $e)//Em caso de exceção

{
	//Exiba a mesagem gerada pela exceção
	echo '<br><br><b>Erro</b><br><br>' . $e->getMessage();
	//Desfazer todas alterações no banco de dados
	TTransaction::rollback();
	
}


 ?>