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
$criteria -> add(new TFilter('nome', 'like', 'marua%'));
$criteria -> add (new TFilter('Cidade', 'like', 'luanda$'));

//Definir o intervalo de consulta 
$criteria -> setProperty('offset', 0);
$criteria -> setProperty ('limit', 10);

//Definir o ordenamento da consulta
$criteria -> setProperty ('order', 'nome');

//Criar Instrução SELECT
$sql = new TSqlSelect;

//definir o nome da entidade
$sql -> setEntity ('aluno');

//Acrecentar colunas a consulta
$sql -> addColumn ('nome');
$sql -> addColumn ('fone');

// Definir Critério de  seleção de dado
$sql -> setCriteria ($criteria);

//Processar a intrução SQL
echo $sql-> getInstruction();
echo "<br>\n";

?>