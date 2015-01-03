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
//Instanciar o select
$sql = new TSqlSelect;
//definir o nome da entidade
$sql -> setEntity(' famosos ');
//Acrescentar coluna a consulta
$sql -> addColumn(' codigo ');
$sql -> addColumn (' nome ');
//Criar criterio de seleção
$criteria = new TCriteria;
//Obter a pessoa de código = 1
$criteria -> add(new TFilter(' codigo ', ' = ',' 2 '));
//Actribuir o citreio de seleção de dados
$sql -> setCriteria($criteria);

try 
{
	//abre a coneção a base my_livro (mysql)
	$conn = TConnection::open('my_livro');

	//executa a instrução
	$result = $conn -> query($sql -> getInstruction());

	if ($result) 
	{
		$row = $result -> fetch(PDO::FETCH_ASSOC);
		//Exibe os dados resultantes
		echo $row ['codigo'].'-'. $row ['nome'] . "<br/&>\n";
	}
	//fecha a Conexão
	$conn = null;
} 
catch (PDOException $e) 
{
	//Exibe a mensagem de erro
	print "Erro!:" . $e -> getMessage() . "<br/>";
	die();
}

try 
{
	//abre a coneção a base pg_livro (postgres)
	$conn = TConnection::open('pg_livro');

	//executa a instrução
	$result = $conn -> query($sql -> getInstrucation());

	if ($result) 
	{
		$row = $result -> fetch(PDO::FETCH_ASSOC);
		//Exibe os dados resultantes
		echo $row ['codigo'].'-'. $row ['nome'] . "<br/&>\n";
	}
	//fecha a Conexão
	$conn = null;
} 
catch (Exception $e) 
{
	//Exibe a mensagem de erro
	print "Erro!:" . $e -> getMessage() . "<br/>";
	die();
}
?>