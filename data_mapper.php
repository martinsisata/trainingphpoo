<?php 
/*
*Classe Produto
*Representa o produto a ser vendodo
*/

final class Produto 
{
	private $descricao;
	private $estoque;
	private $preco_custo;

	/*Método Construtor 
	Devine alguns valores inicais 
	@param $descricao = descrição do produto
	@param $estoque = esto que actual
	@param $preco_custo = preço do custo

	*/

	public function __construct ($descricao, $estoque, $preco_custo)
	{
		$this-> descricao   = $descricao;
		$this-> estoque     = $estoque;
		$this-> preco_custo = $preco_custo;
	}

	public function getDescricao()
	{
		return $this-> descricao;
	}
}
 /*
 Class venda
 representa a venda de um produto
*/
final class Venda 
{
	private $id;
	private $itens; //itens da cesta

	/*Método construtor
	instacia uma venda
	$id = identificador
	*/

	function __construct ($id)
	{
		$this->id =$id;
	}

	function getID()
	{
		return $this->id;
	}

	/*Método addItem
	Adicionar um item numa cesta
	$quatidade = quatidade vendida
	$produto = objecto produto
	*/

	public function addItem ($quatidade, Produto $produto)
	{
		$this-> itens [] = array($quatidade, $produto);
	}

	public function getItems ()
	{
		return $this->itens;
	}
}

/*Class VendaMapper
Implementa data mapper para classe venda
*/

final class VendaMapper 
{
	function insert(Venda $venda)
	{
		$id   = $venda->getID();
		$data = date("Y-m-d");

		//Inserir a venda na base de adados
		$sql = "INSERT INTO venda (id,data) values ('$id','$data')";
		echo $sql . "<br>\n";

		//Prepara os itens vendidos
		foreach ($venda-> getItems() as $item) 
		{
			$quatidade  = $item[0];
			$produto    = $item[1];
			$descricao  = $produto->getDescricao();

			//Insere os itens da venda na base de dados
			$sql = "INSERT INTO venda_items (ref_venda,produto,quatidade)".
			     "values ('$id', '$descricao', '$quatidade')";
		    echo $sql . "<br>\n";
		}
	}
}

//Instanciar objecto venda
$venda = new Venda (1000);

//Adiciona alguns produtos;
$venda-> addItem (3, new Produto('Vinho', 10, 15));
$venda-> addItem (2, new Produto('Salame', 20, 20));
$venda-> addItem (2, new Produto('Quaijo', 30, 10));

//Data mapper persistente a venda

VendaMapper::insert($venda);
 ?>