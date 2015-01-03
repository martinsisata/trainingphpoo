<?php
/*
Class ProdutoGateway
implementa a Table Data Gateway
*/

class ProdutoGateway
{
	/*Método Insert 
	Inserir dados na tabela produtos
	*/
	function insert($id, $descricao, $estoque, $preco_custo)
	{
		//Criar instrução SQL de insert
		$sql = "insert INTO produtos(id, descricao, estoque, preco_custo) 
			    VALUES ('$id', '$descricao','$estoque','$preco_custo')";

			    //Instancia objecto PDO
			    $conn = new PDO('sqlite:produtos.db');
			    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			    //Executar a instrução
			    $conn -> exec($sql);
			    unset($conn);
	}
		/*
	Método update()
	actualiza registro da tabela de produtos 
	*/
	function update($id, $descricao, $estoque, $preco_custo)
	{
		//Criar a instrução update
		$sql = "UPDATE produtos set descricao='$descricao'," .
		       "estoque = '$estoque', preco_custo = '$preco_custo'" .
		       "WHERE id = '$id'";
		//Instanciar o objecto PDO
		$conn = new PDO('sqlite:produtos.db');
		$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		//Executar a instrução
		$conn -> exec($sql);
		unset($conn);

	}
	/*
	Método delete()
	elimina registro da tabela de produtos 
	*/
	function delete($id)
	{
		//Criar a intrução sql DELETE
		$sql = "DELETE FROM produtos where id = '$id'";
		//Instanciar o PDO
		$conn = new PDO('sqlite:produtos.db');
		$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		//Executa a instrução sql 
		$conn -> exec($sql);
		unset($conn);
	}

	/*
	Método getObject()
	busca registro da tabela de produtos 
	*/

	function getObject($id)
	{
		//Criar o SQL de SELECT
		$sql = "SELECT * from produtos where id = '$id'";
		//Instanciar objecto PDP
		$conn = new PDP('sqlite:produtos.db');
		$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
		//Executar a instrução SQL
		$result = $conn -> query($sql);
		$data = $result -> fetch (PDO::FETCH_ASSOC);
		unset($conn);
		return $data;
	}	

	function getObjects()
	{
		//Criar o SQL de SELECT
		$sql = "SELECT * from produtos";
		//Instanciar objecto PDP
		$conn = new PDO('sqlite:produtos.db');
		$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
		//Executar a instrução SQL
		$result = $conn -> query($sql);
		$data = $result -> fetchAll (PDO::FETCH_ASSOC);
		unset($conn);
		return $data;
	}
}

//Instanciar Objecto ProdutoGateway
$gateway = new ProdutoGateway;

//Inisciar alguns Registos na tabela
$gateway -> insert(1, 'Vinho', 10, 10);
$gateway -> insert(2, 'Salame', 20, 20);
$gateway -> insert(3, 'Queijo', 30, 30);

//Efectuar algumas Alterações
$gateway -> update(1, 'Vinho', 20, 20);
$gateway -> update(2, 'Salame', 40, 40);

//Exluir o produto 3
$gateway->delete(3);

//Exibir novamente os registos
echo "Lista de Produtos<br>\n";
print_r($gateway -> getObjects());

?>