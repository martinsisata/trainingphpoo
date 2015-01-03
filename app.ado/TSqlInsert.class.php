<?php
/*
Classe  TSqlInsert
Esta Classe provê meios para manipulação de uma itrução INSERT
*/
final class TSqlInsert extends TSqlInstruction
{
	private $columnValues;
	/*
	Método setRowData()
	Atribui valor a determinadas colunas no banco de dados que serão inseridas
	*/
	public function setRowData ($column,$value)
	{
		//Verifica se um dado escalar (String, intiger,....)
		if (is_scalar($value)) 
		{
			if (is_string($value) and (!empty($value))) 
			{
				//Adiciona \ em aspas
				$value = addslashes($value);
				//Caso seja string
				$this -> columnValues [$column] = "'$value'"; 
			}
			else if (is_bool($value)) 
			{
				//Caso seja Booleano 
				$this -> columnValues[$column] = $value ? 'TRUE' : 'FALSE';
			}
			else if ($value =='') 
			{
				//Caso seja outro tipo de dado
				$this -> columnValues [$column] = $value;
			}
			else
			{
				//caso seja NULL
				$this -> columnValues [$column] = "	NULL";
			}
		}
	}
	/*
	Método setCriteria()
	Não exixte no contexto desta Classe, lo, irá lançar um erro ser for executada
	*/

	public function setCriteria (TCriteria $criteria)
	{
		//Lança o erro
		throw new Exception("Cannot call setCriteria from". __CLASS__);
	}

	/*
	Método getInstruction()
	Retorna a instrução de INSERT em forma de String
	*/

	public function getInstruction()
	{
		$this -> sql = "INSERT INTO {$this -> entity}(";
			//Mota uma String contendo o nome das colunas 
		$columns = implode(',', array_keys($this -> columnValues));
		   //Moanta uma String contendo os valores
		$values = implode(',', array_values($this -> columnValues));
		$this -> sql .= $columns .')';
		$this -> sql .= "values({$values})";
		return $this -> sql;
	}
}

?>