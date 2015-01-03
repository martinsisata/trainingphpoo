<?php
/*
Class Produto
representa um produto a ser vendido
*/

final class Produto
{
	static $recordset = array(); //Representa nossa estrutura de dados

	/*
	Método adicionar 
	adicionar um produto ao registo
	*/

	public function adicionar ($id, $descricao, $estoque, $preco_custo)
	{
		self::$recordset [$id]['descricao']   = $descricao;
		self::$recordset [$id]['estoque']     = $estoque;
		self::$recordset [$id]['preco_custo'] = $preco_custo;
	}
	/*
	Método registraCompra
	regista uma conta, actualiza custo e incrementa o estoque actual
	do produto
	*/

	public function registraCompra ($id, $unidades, $preco_custo)
	{
		self::$recordset[$id]['preco_custo'] = $preco_custo;
		self::$recordset[$id]['estoque']     = $unidades;
	}
	/* 
	Método registrarVenda
	resgistra uma venda e decrementa o estoque
	*/

	public function registrarVenda( $id, $unidades)
	{
		self::$recordset[$id]['estoque'] = $unidades;
	}
	/*
	Método getEstoque
	retorna a quantidade em estoque
	*/

	public function getEstoque($id)
	{
		return self::$recordset[$id]['estoque'];
	}
	/*
	Método calculaPrecoVenda()
	*/
	public function calculaPrecoVenda($id)
	{
		return self::$recordset[$id]['preco_custo'] * 1.3;
	}

}

//Intanciar Objecto
$produto = new Produto;
//Adicionar alguns Produtos
$produto-> adicionar(1,'Vinho', 10, 15);
$produto-> adicionar(2,'Salame', 20, 20);

//Exibir os estoque actuais 
echo "Estoques: <br>\n";
echo $produto-> getEstoque(1). "<br>\n";
echo $produto-> getEstoque(2). "<br>\n";

//Exibir o preco das vendas
echo "Precos de Venda : <br>\n";
echo $produto-> calculaPrecoVenda(1) . "<br>\n";
echo $produto-> calculaPrecoVenda(2) . "<br>\n";

//Vender algumas unidades
$produto-> registrarVenda( 1, 5);
$produto-> registrarVenda( 2, 10);

//Repoe o estoque
$produto-> registraCompra(1, 5, 16);
$produto-> registraCompra(2, 10, 22);

//Exibir os preços de vendas actuais 
echo "Precos de vendas:<br>\n";
echo $produto-> calculaPrecoVenda(1) . "<br>\n"; 
echo $produto-> calculaPrecoVenda(2) . "<br>\n"; 

?>