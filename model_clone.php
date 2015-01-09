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

//Instanciar objecto AAALuno
$martins = new AlunoRecord;
//denir algumas propriedades
$martins->nome 		= 'Martins Isata'; 
$martins->endereco	= 'Rua A'; 
$martins->telefone 	= '(925) 584-253'; 
$martins->cidade 	= 'Luanda';

//Clona o objecto $martins
$nerilia = clone $martins; 
//Alterar algumas propriedades
$nerilia->nome     ='Nerilia Tavares';
$nerilia->telefone ='(921) 701-479';

try 
{
	//Inicia transação com o banco 'my_livro'
	TTransaction::open('my_livro');
	//Define o aqruivo LOG
	TTransaction::setLogger (new TloggerTXT('C:\Apache24\htdocs\trainingphpoo\tmp\log4.text'));
    //Armazenar o objecto martins
	TTransaction::log("**Persistindo o Aluno \$martins");
	$martins->store();
	//Armazena o objecto $nerilia
	TTransaction::log("**Persistir o aluno \$nerilia");
	$nerilia->store();

	//finaliza a transação
	TTransaction::close();

	echo "Clonagem realizada com sucesso<br>\n";
	
	 
} catch (Exception $e)//Em caso de exceção

{
	//Exiba a mesagem gerada pela exceção
	echo '<br><br><b>Erro</b><br><br>' . $e->getMessage();
	//Desfazer todas alterações no banco de dados
	TTransaction::rollback();
	
}


 ?>