<?php
/*
class ProdutoGateway
Implementa o Table Date Gateway como Data Transfer Object
*/

class ProdutoGateway {

	/* Método Insert
	insere dados na tabela de Produtos
	*/

	function insert (Produto $object)
	{
		//Criar intrução SQL
$sql = "INSERT INTO produtos (id, descricao, estoque, preco_custo)VALUES ({$object->id}, {$object->descricao},{$object->estoque}, {$object->preco_custo})";		//Instanciar o Objecto PDO
		$conn = new PDO ('sqlite:produtos.db');
		$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$conn -> exec($sql);
		unset($conn);
	}
	/*
	Método update
	Altera os daos na tabela de Produtos
	*/

	function update(Produto $object)
	{
		//Criar a instrução
		$sql = "UPDATE produtos set".
			   " descricao = '$object -> descricao'".
			   " estoque   = '$object -> estoque'".
			   " preco_custo = '$object -> preco_custo'".
			   " WHERE id = '$object -> id'";
	    //Instanciar o objecto PDO
	    $conn = new PDO('Sqlite:produtos.db');
	    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	    //Executar instrução SQL
	    $conn -> exec($sql);
	    unset($conn);
	}
	/*
	Método getObject
	Busca um registro da tabela de produtos
	*/
	function getObject($id)
	{
		//Criar SQL de SELECT
		$sql = "SELECT * FROM produtos WHERE id='$id'";
		//iniciar o PDO
		$conn = new PDO('Sqlite:produtos.db');
		$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		//Executar consulta SQL
		$result = $conn-> query($sql);
		$data = $result -> fetch(PDO::FETCH_ASSOC);
		unset($conn);
		return $data;
	}


}
class Produto 
{
	public $id;
	public $descricao;
	public $estoque;
	public $preco_custo;
}
//Instanciar o Objecto ProdutoGateway
$gateway = new ProdutoGateway;

$vinho = new Produto;
$vinho -> id 		  = 1;
$vinho -> descricao   = 'Vinho';
$vinho -> estoque     = 10;
$vinho -> preco_custo =15;

//insert o objecto no banco de dados
$gateway -> insert($vinho);

//Exibe o objecto de código 1
print_r($gateway -> getObject(1));

$vinho -> descricao = 'Vinho Cabernet';
//Actualiza o objecto no banco de daos
$gateway -> update($vinho);

//Exibe o objecto de código 1
print_r($gateway -> getObject(1));
?>