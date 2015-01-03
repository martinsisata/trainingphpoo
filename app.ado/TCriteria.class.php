<?php
/*Classe TCriteria
Esta Classe provê uma interface utilizada para definição de critérios
*/

class TCriteria extends TExpression {
	private $expressions; // Armazenar a lista de Expressões
	private $operators;   // Armazenar a lista de Operadores
	private $proprerties; // propriedades do Critério 
/*
Método Construtor
*/
function __construct()
{
	$this -> expressions = array();
	$this -> operators   = array();
}

	/*
	método add(), serve para adicionar critérios
	*/
	public function add(TExpression $expression, $operator = self::AND_OPERATOR)
	{
		//Na primeira vez não precisamos de oprrdor lógico para contornar
		if (empty($this -> expressions)) {
			$operator = NULL;
		}
		// Agrega o resultado de expressão a lista de expressões

		$this -> expressions [] = $expression;
		$this -> operators   [] = $operator;

	}
	/*
	Método dum()
	Retorna a Expressãop Final
	*/
	public function dump()
	{
		//Concatena a Lista de Expressão
		if (is_array($this -> expressions)) 
		{
			if (count($this -> expressions) > 0) 
			{
				$result = '';
				foreach ($this -> expressions as $i => $expression) 
				{
					$operator = $this -> operators [$i];
					//Concatena o Operador com a respectiva expressão
					$result.= $operator.$expression -> dump(). ' ';
				}
				$result = trim($result);
				return "({$result})";
			}
		}
	}
	/*
	Método setProperty
	Define o valor de uma propriedade 

	*/
	public function setProperty ($property, $value)
	{
		if (isset($value)) {
			$this -> proprerties [$property] = $value;
		}
		else
		{
			$this -> proprerties [$property] = NULL;
		}
	}

	/*
	Método getProperty
	Retorna o valor de uma propriedade
	*/

	public function getProperty ($property)
	{
		if (isset($this -> proprerties [$property])) {
			return $this -> proprerties[$property];
		}
	}
}
?>