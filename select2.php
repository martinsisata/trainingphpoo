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
$criteria1 = new TCriteria;

//Selecionar todos as meninas que estão na terceira serie
$criteria1 -> add(new TFilter('sexo', '=', 'F'));
$criteria1 -> add (new TFilter('serie', '=', '3'));

// Selecionar dados dos meninos de 4 seria
$criteria2 = new TCriteria;
$criteria2 -> add(new TFilter('sexo','=', 'M'));
$criteria2 -> add(new TFilter ('seria', '=', '4'));

//Agrora juntamos os dois criterios Utilizados
//O operador lógico OR. O resultado tem de conter
//Os dados dos meninos ou das meninas
$criteria = new TCriteria;
$criteria -> add(new $criteria1, TExpression::OR_OPERATOR);
$criteria -> add(new $criteria2, TExpression::OR_OPERATOR);

//Definir o ordenamento da consulta
$criteria -> setProperty ('order', 'nome');

//Criar Instrução SELECT
$sql = new TSqlSelect;

//definir o nome da entidade
$sql -> setEntity ('aluno');

//Acrecentar colunas a consulta
$sql -> addColumn ('*');

// Definir Critério de  seleção de dado
$sql -> setCriteria ($criteria);

//Processar a intrução SQL
echo $sql-> getInstruction();
echo "<br>\n";

?>
