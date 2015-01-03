<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>

</body>
</html>
<?php
/*
Class Pessoa
933537330
*/
class Pessoa
{
	private $nome;      //Nome da Pessoa
	private $cidadeID;  //ID da cidade

	/*
	Método construtor
	Instancia o objecto, define alguns atributos
	*/

	function __construct ($nome, $cidadeID)
	{
		$this -> nome     = $nome;
		$this -> cidadeID = $cidadeID;
	}
	/*Método __get
	intercepta a obtenção de propriedades
	*/
	function __get ($propriedade)
	{
		if ($propriedade == 'cidade') 
		{
			return new Cidade($this -> cidadeID);
		}
	}

}

/*
Class cidade
*/

class Cidade
{
	private $id;
	private $nome;

	/*
	Método construtor instancia o objecto
	*/

	function __construct($id)
	{
		$data [1] = 'Porto Alegre';
		$data [2] = 'São Paulo';
		$data [3] = 'Rio de Janneiro';
		$data [4] = 'Belo Horizonnte';
		//Atribui os id
		$this -> id = $id;

		//Define o Seu nome
		$this -> setNome($data[$id]);
	}
		/*
		Método setNome()
		define o nome da cidade
		*/
	function setNome ($nome)
	{
		$this -> nome = $nome;
	}

	function getNome ()
	{
		return $this -> nome;
	}
}

//Intanciar dois Objectos Pessoa
$maria = new Pessoa('Maria Franca Isata', 1);
$martins = new Pessoa('Martins Isata',2);

//Exibir o nome da cidade de cada Pessoa
echo $maria -> cidade -> getNome() . "<br>\n";
echo $martins -> cidade -> getNome() . "<br>\n";
//Exibir o Atributo cidade
print_r($maria -> cidade);
?>