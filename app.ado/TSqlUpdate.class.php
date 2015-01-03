<?php
/*
Classe  TSqlUpdate
Esta Classe provê meios para manipulação de uma itrução UPDATE
*/
final class TSqlUpdate extends TSqlInstruction
{
	private $columnVlues;
	/*
	Método setRowData()
	Atribui valores a determinadas colunas,
	 na BD que serão modificados
	*/
	public function setRowData ($column,$value)
	{
		//Verifica se un dado escalar (string, integer,....)
		if (is_scalar($value)) 
		{
			if (is_string($value) and (!empty($value))) 
			{
				//Adiciona \ em aspas
				$value = addslashes($value);

				//Caso seja uma string
				$this -> columnVlues [$column] = "'$value'";

			}
			else if (is_bool($value)) 
			{
				//caso seja Booleano
				$this -> columnVlues [$column] = $value ? 'TRUE' : 'FALSE';
			}
			else if ($value !== '') 
			{
				//Caso seja outro tipo
				$this -> columnVlues [$column] = $value;
			}
			else 
			{
				//Caso seja NULL
				$this -> columnVlues [$column] = "NULL";
			}
		}
	}
	/*
	Método getInstruction()
	Restorna a instrução do UPDATE em string
	*/

	public function getInstruction()
	{
		//mostra a string do UPDATE
		$this -> sql = "UPDATE {$this -> entity}";

		//Monta os pares colunas e valores
		if ($this -> columnVlues) 
		{
			foreach ($this -> columnVlues as $column => $value) 
			{
				$set [] = "{$column} = {$value}";
			}
		}
		$this -> sql .='SET' . implode(',', $set);
		//retorna a Cláusula WHERE do Objecto $this -> criteria
		if ($this -> criteria) 
		{
			$this -> sql .= 'WHERE' . $this -> criteria -> dump();
		}
		return $this -> sql;
	}
}

?>