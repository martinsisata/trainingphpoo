<?php
/*
Classe  TSqlDelete
Esta Classe provê meios para manipulação de uma instrução DELETE
*/

final class TSqlDelete extends TSqlInstruction
{
	public function getInstruction ()
	{
		//Monta a String DELETE
	$this -> sql = "DELETE FROM {$this -> entity}";

	//Retorna a cláusula WHERE do objecto $this -> criteria
	if ($this -> criteria) 
	{
		$expression = $this -> criteria -> dump();
		if ($expression) 
		{
			$this -> sql .= 'WHERE' . $expression; 
		}
	}
	return $this -> sql;
	}
}
?>