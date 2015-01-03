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
$criteria -> add(new TFilter('id', '=', '2'));

//Criar Instrução Update
$sql = new TSqlUpdate;

//definir o nome da entidade
$sql -> setEntity ('aluno');

//Atribuir o valor de cada coluna
$sql -> setRowData ('nome', 'Martins Isata');
$sql -> setRowData ('fone', '925567890');
$sql -> setRowData ('Nascimento', '26-06-1989');

// Definir Critério de  seleção de dado
$sql -> setCriteria ($criteria);

//Processar a intrução SQL
echo $sql-> getInstruction();
echo "<br>\n";

?>