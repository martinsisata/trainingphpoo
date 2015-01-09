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
	//Abre uma Transação
	TTransaction::open('my_livro');

	//define a estrategia de LOG
	TTransaction::setLogger(new TLoggerHTML('C:\Apache24\htdocs\programandoComOO\tmp\arquivo.html'));

	//Escreva Mensagem de LOG
	TTransaction::log("Inserindo Registo Martins Isata");

	//Criar uma instrução INSERT
	$sql = new TSqlInsert;
	$sql -> setEntity(' famosos ');
	$sql -> setRowData(' codigo ', 3);
	$sql -> setRowData(' nome ', 'Martins Isata');

	//Obtêm a conexão activa
	$conn = TTransaction::get();
	$result = $conn -> Query($sql -> getInstruction());

	//Escreve a mensagem
	TTransaction::log($sql -> getInstruction());

	//Definir a Etrstegia de LOG
	TTransaction::setLogger(new TLoggerXML('C:\Apache24\htdocs\trainingphpoo\tmp\Martins.xml'));

	//Escreve a Mensagem de LOG
	TTransaction::log("Inserindo Registo de Nerilia Tavares");

	//Criar uma instrução INSERT
	$sql = new TSqlInsert;
	$sql -> setEntity('famosos');
	$sql -> setRowData(' codigo ', 4);
	$sql -> setRowData(' nome ',' Nerilia Tavares ');

	//Obter a conexão activa
	$conn = TTransaction::get();
	$result = $conn -> Query($sql -> getInstruction());

	//fecha a Transação aplicado todas as operações
	TTransaction::close();
	echo "Log Criado";
}
catch (Exception $e) 
{
	// Exibe a mensagem de erro
	echo $e -> getMessage();
	//desfazer operações realizadas pela transação
	TTransaction::rollback();
}

?>