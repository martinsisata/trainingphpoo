<?php
/*
Função autoload()
Carrega uma class quando ele é necessária, ou seja, quando ela
é instanciada pela primeira vez
*/
function __autoload($classe)
{
	if (file_exists("app.ado/{$classe}.class.php")) {
		include_once "app.ado/{$classe}.class.php";
	}
}

//Criar critéria de seleção e dados
$criteria = new TCriteria;
$criteria -> add(new TFilter('id', '=', '3'));

//Criar Instrução DELETE
$sql = new TSqlDelete;

//definir o nome da entidade
$sql -> setEntity ('aluno');

// Definir Critério de  seleção de dado
$sql -> setCriteria ($criteria);

//Processar a intrução SQL
echo $sql-> getInstruction();
echo "<br>\n";

?>