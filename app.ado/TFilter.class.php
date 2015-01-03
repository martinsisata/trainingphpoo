<?php
/*
Classe TFilter

Esta classe provê uma interface para definição de filtro de seleção

*/

class TFilter extends TExpression {
	// Declaração das Variáveis
	private $variable;
	private $operator;
	private $value;

/*

Método construct()
para Instanciar um novo filtro

*/

public function __construct ($variable,$operator,$value)
{
	//Armazenar as propriedades
	$this -> variable = $variable;
	$this -> operator = $operator;
	/*Transformar o valor de acordo com certas regras
	Antes de atribuir a propriedade $this -> value tem de transformar
	*/
	$this -> value    = $this ->transform($value);
}
/*
Método transform()
recebe uma variaavel e faz as modificações nencessárias
para ele ser interpretado pelo banco de dado 

*/
private function transform($value)
{
	//Caso seja um array
	if (is_array($value)) {
		//percore os valores
		foreach ($value as $x) {
			// se for um inteiro 
			if (is_integer($x)) {
				$foo [] = $x;
			}
			else if (is_string($x)) {
				// Se for strinque adiciona aspas
				$foo [] = "'$x'";
			}
		}
		// converter a array por string separada por vírgula
		$result = '('. implode(',', $foo) .')';
	}
	// Caso seja uma string
	else if (is_string($value)) {
		//Adicionar aspas
		$result = "'$value'";

	}
	//Caso seja valor null
	else if (is_null($value)) {
		// Armazena NULL
		$result = 'NULL';
	}
	//Caso seja Booleano 
	else if (is_bool($value)) {
		//Armazena TREU OU FALSE
		$result = $value ? 'TRUE' : 'FALSE';
	}
	else {
		$result = $value;
	}
	//Retorna o valor
	return $result;
}
/*
Método dump()
Retorna o filtro em forma de expressão
*/

public function dump()
{
	//Concatena a expressão
	return "{$this -> variable}{$this -> operator}{$this -> value}";
}
}
?>