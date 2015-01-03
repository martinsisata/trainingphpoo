<?php
/*
Classe  TSqlInstruction
Essa Classe provê os método em comum em todas as instruções
SQL (Insert, Update, Select, Delete)
*/

abstract class TSqlInstruction
{
	protected $sql;      //Armazeanar a instrução SQL
	protected $criteria; //Armazenar o objecto Critéria 
	protected $entity;   //Armazenar o nome da tabela 

/*
Método setEntity()
Define o nome da Tabela manipulada pela Instrução SQL
*/
final public function setEntity ($entity)
{
	$this -> entity = $entity;
}
/*
Método getEntity()
Retorna o nome da Tabela
*/

final public function getEntity ()
{
	return $this -> entity;
}
/*
Métdo setCriteria()
Denine um critério de seleção dos dados através da composição
de um objecto do tipo TCriteria, que oferece uma interface
para definição de critérios
*/

public function setCriteria(TCriteria $criteria)
{
	$this -> criteria = $criteria;
}
/*
Método getInstruction()
Declarando-o com abstract abrigamos sua seleção nas classes filhas,
uma vez que seu comportamento será distinto em cada uma delas, 
configurando polimorfismo
*/

abstract function getInstruction();
}

?>