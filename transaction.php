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

try 
{
	//Abre uma transação
	TTransaction::open('my_livro');

	//Criar uma instacia de INSERT
	$sql = new TSqlInsert;

	//definir o nome da entidade
	$sql -> setEntity(' famoso ');

	//Atribuir o valor de cada Coluna
	$sql -> setRowData(' codigo ', 8);
	$sql -> setRowData (' nome ', ' Galileu ');

	//Obter Conexão activa
	$conn = TTransaction::get();

	//Executar instrução SQL
	$result = $conn -> Query($sql -> getInstruction());

	//Criar uma Instrução UPDATE
	$sql = new TSqlUpdate;
	$sql -> setEntity (' famoso ');
	$sql -> setRowData (' nome ',' Galileu Galileu ');

	//Atribuir Criteria de Seleção de dados
	$Criteria = new TCriteria;
	$Criteria -> add(new TFilter(' codigo ', ' = ',' 8 '));

	//Atribuir criterio de seleção de dados
	$sql -> setCriteria($Criteria);

	//Obter conexão activa
	$conn = TTransaction::get();

	//Executar a Instrição
	$result = $conn -> Query($sql -> getInstruction());
	TTransaction::close();

} 
catch (Exception $e) 
{
	//Exibe a mensagem de erro
	echo $e -> getMessage();

	//Dezfaz operações realizadas durante a transação
	TTransaction::rollback();
}


?>