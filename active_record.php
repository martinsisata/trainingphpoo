<?php
/*
class Produto
Implementa Active Record
*/

class Produto
{
	private $data;

	function __get ($prop)
	{
		return $this -> data [$prop];
	}

	function __set ($prop, $value)
	{
		$this -> data [$prop] = $value;
	}
	/*
	Método insert
	Armazena  o objecto na tabela de drodutos 
	*/

	function insert ()
	{
		//Criar instrução insert
		$sql = "INSERT INTO Produtos (id, descricao,estoque, preco_custo)".
		            "VALUES ('{$this->id}', '{$this->descricao}'".
		            "       '{$this->estoque}','{$this->preco_custo}')";
		//Instanciar objecto PDO
		$conn = new PDO ('sqlite:produtos.db');
		$conn-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
		//Executar instrução 
		$conn -> exec($sql);
		unset($conn);

	}
	/* Método Actualizar
	Alterar os dados do objecto na tabela Produtos
	*/

	function update ()
	{
		//Criar a instrução SQL
		$sql = "UPDATE produtos set".
				"descricao ='{$this -> descricao}'".
				"estoque ='{$this -> estoque}'".
				"preco_custo ='{$this -> preco_custo}'".
				"WHERE id  ='{$this -> id}'";
		//Instanciar o Objecto PDO
		$conn = new PDO ('sqlite:produtos.db');
		$conn-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
		//Executar o comando 
		$conn = exec($sql);
		unset($conn);
	}

	//Método apagar
	function delete ()
	{
		$sql = "DELETE produtos WHERE id ='{$this ->id}'";

		$conn = new PDO ('sqlite:produtos.db');
		$conn-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
		//Executar o comando 
		$conn = exec($sql);
		unset($conn);
	}
	/*
	*Método registarCompra
	Regista uma conrta, Actualiza o custo e incrementa o estoque
	$unidade = unidades adquiridas
	$preco_custo = novo preco de custo
	*/

	public function registarCompra($unidades,$preco_custo)
	{
		$this-> preco_custo = $preco_custo;
		$this-> estoque += $unidades;
	}
	/*
	Método RegistarVenda
	Regista uma bbvenda e decrementa o estoque
	$unidades = unidades vendidas
	*/

	public function resgistraVenda ($unidades)
	{
		$this-> estoqu -= $unidades;
	}
	/*
	Método calcularPrecoVenda 
	Retorna o preco da venda baseado em uma margem de 30% sobre o custo
	*/
	public  function calcularPrecoVenda ()
	{
		return $this-> preco_custo * 1.3;
	}

}

//Instaciar Objecto produto

$vinho = new Produto;
$vinho-> id 		=1;
$vinho-> descricao  ='Vinho Cabernet';
$vinho-> estoque    =10;
$vinho-> preco_custo=10;
$vinho-> insert();

$vinho-> resgistraVenda(5);
echo 'estoque:    ' . $vinho-> estoque. "<br>\n";
echo 'preco_custo:' . $vinho-> preco_custo. "<br>\n";
echo 'preco_venda:    ' . $vinho-> calcularPrecoVenda(). "<br>\n";

$vinho-> registarCompra(10,20);
$vinho-> update();
echo 'estoque:    '. $vinho-> estoque."<br>\n";
echo 'preco_custo:    '. $vinho-> preco_custo."<br>\n";
echo 'preco_venda:    '. $vinho-> calcularPrecoVenda."<br>\n";

?>