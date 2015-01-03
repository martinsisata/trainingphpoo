<?php
/*Classe TExpression
classe abrtrada para gerar expressões

*/

abstract class TExpression {
	// Operador lógico 
	const AND_OPERATOR = 'AND';
	const OR_OPERATOR  = 'OR';

	//Marque o Método dump como obrigatório
	abstract public function dump();
}

?>