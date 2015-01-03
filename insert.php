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
//definir lOCALE do siistema para definir pontos decimais
//PS: no windows, usar "Englesh"

setlocale(LC_NUMERIC, 'POSIX');

//Criar intancia INSERT

$sql = new TSqlInsert;
//definir o nome da entidade
$sql -> setEntity ('aluno');
//Atribuir o valor de cada coluna
$sql -> setRowData ('Id', 4);
$sql -> setRowData ('Nome', 'Martins Isata');
$sql -> setRowData ('Fone', '925567890');
$sql -> setRowData ('Nascimento', '26-06-1989');
$sql -> setRowData ('sexo', 'M');
$sql -> setRowData ('Serie', '3');
$sql -> setRowData ('Mensalidade', 280.40);
echo $sql-> getInstruction();
echo "<br>\n";

?>