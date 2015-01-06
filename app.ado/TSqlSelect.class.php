<?php
/*
Classe  TSqlSelect
Esta Classe provê meios para manipulação de uma itrução SELECT
*/

final class TSqlSelect extends TSqlInstruction
{
	private $columns; //Array  de colunas a seram restornadas

	/*
	Método addColumn
	Adciona uma coluna a ser retornada pelo SELECT
	*/
	public function addColumn($column)
	{
		// Adicionar a coluna na array
		$this -> columns [] = $column;
	}
	/*
	Método getInstruction()
	Retorna a instrução SQL em String
	*/
	public function getInstruction()
	{
		//Montar a instrução SQl
		$this -> sql = ' SELECT ';

		//Monta a string com os nomes das colunas
		$this -> sql .= implode(',', $this -> columns);

		//Adicionar na Cláusula FROM o nome da tabela
		$this -> sql .= ' FROM ' . $this -> entity;

		// Obter a Cláusula WHERE do Objecto Criteria
		if ($this -> criteria) 
		{
			$expression = $this -> criteria -> dump();
			if ($expression) 
			{
				$this -> sql .= ' WHERE ' . $expression;
			}
			//Obter as propriedades do criterio
			$order  = $this -> criteria -> getProperty(' order ');
			$limit  = $this -> criteria -> getProperty(' limit ');
			$offset = $this -> criteria -> getProperty(' offset ');

			//Obter ordenação do select
			if ($order) 
			{
				$this -> sql .= ' ORDER BY ' . $order;
			}
			if ($limit) 
			{
				$this -> sql .= ' LIMIT ' . $limit;
			}
			if ($offset) 
			{
				$this -> sql .= ' OFFSER ' . $offset;
			}
		}
		return $this -> sql;
	}
}

?>